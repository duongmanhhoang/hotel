<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Rooms\StoreRequest;
use App\Http\Requests\Admin\Rooms\TranslationRequest;
use App\Http\Requests\Admin\Rooms\UpdateRequest;
use App\Models\ListRoomNumber;
use App\Models\RoomDetail;
use App\Repositories\Library\LibraryRepository;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomDetail\RoomDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function __construct
    (
        LocationRepository $locationRepository,
        RoomRepository $roomRepository,
        RoomDetailRepository $roomDetailRepository,
        PropertyRepository $propertyRepository,
        LibraryRepository $libraryRepository
    )
    {
        $this->locationRepository = $locationRepository;
        $this->roomRepository = $roomRepository;
        $this->roomDetailRepository = $roomDetailRepository;
        $this->propertyRepository = $propertyRepository;
        $this->libraryRepository = $libraryRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request, $location_id)
    {
        $keyword = $request->keyword;
        $location = $this->locationRepository->findOrFail($location_id);
        $rooms = $location->rooms()->orderBy('id', 'desc')->paginate(config('common.pagination.default'));
        $properties = $this->propertyRepository;
        $data = compact(
            'rooms',
            'location',
            'keyword',
            'properties'
        );

        return view('admin.rooms.index', $data);
    }

    public function create($location_id)
    {
        $location = $this->locationRepository->findOrFail($location_id);
        $roomIds = $location->rooms()->pluck('id')->toArray();
        if (sizeof($roomIds) == 0) {
            $roomIds = [0];
        }
        $listRoomsNumber = $location->listRoomsNumber()->pluck('list_room_numbers.room_number')->toArray();
        $data = compact(
            'location',
            'roomIds',
            'listRoomsNumber'
        );

        return view('admin.rooms.create', $data);
    }

    public function store(StoreRequest $request, $location_id)
    {
        $data = $request->except('_token');

        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = uploadImage('rooms', $data['image']);

            }
        
            $this->roomRepository->storeRoom($data, $location_id);
            DB::commit();
            $request->session()->flash('success', 'Thêm thành công');
            Session::put('locale', $this->baseLang);

            return redirect(route('admin.rooms.index', $location_id));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function edit(Request $request, $location_id, $id)
    {
        $location = $this->locationRepository->findOrFail($location_id);
        $room = $this->roomRepository->findOrFail($id);
        $roomDetail = $room->roomDetails()->where('lang_id', \session('locale'))->first();
        if (is_null($roomDetail)) {
            Session::put('locale', $this->baseLang);
            $request->session()->flash('error', 'Chưa có bản dịch ngôn ngữ này');

            return redirect(route('admin.rooms.edit', [$location_id, $id]));
        }
        $roomIds = $location->rooms()->where('id', '!=', $id)->pluck('id')->toArray();
        if (sizeof($roomIds) == 0) {
            $roomIds = [0];
        }
        $listRoomNumber = $room->listRoomNumbers()->pluck('room_number')->toArray();
        $listLocationRoomsNumber = $location->listRoomsNumber()->pluck('list_room_numbers.room_number')->toArray();
        $images = $this->libraryRepository->getImagesByRoom($id);
        $data = compact(
            'location',
            'roomIds',
            'listLocationRoomsNumber',
            'room',
            'roomDetail',
            'listRoomNumber',
            'images'
        );

        return view('admin.rooms.edit', $data);
    }

    public function update(UpdateRequest $request, $location_id, $id)
    {
        $data = $request->except('_token');
        $room = $this->roomRepository->findOrFail($id);
        $roomDetail = $room->roomDetails()->where('lang_id', \session('locale'))->first();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = uploadImage('rooms', $data['image']);
            }
            $this->roomRepository->updateRoom($data, $room, $roomDetail);
            DB::commit();
            $request->session()->flash('success', 'Sửa thành công');

            return redirect(route('admin.rooms.edit', [$location_id, $id]));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteRoomNumber(Request $request, $location_id, $id)
    {
        $room = $this->roomRepository->find($id);
        $roomNumbers = $room->listRoomNumbers;
        $room_number = $request->room_number;
        $result = $this->roomRepository->deleteRoomNumber($roomNumbers, $room_number, $id);

        if ($result) {
            return response()->json(['messages' => 'success'], 200);
        }

        return response()->json(['messages' => 'error'], 200);
    }

    public function translation(Request $request, $location_id, $id)
    {
        $languages = $this->roomDetailRepository->getTranslateId($id);
        if (count($languages) == 0) {
            $request->session()->flash('error', 'Đã có đủ các bản dịch');

            return redirect()->back();
        }

        $origin = $this->roomDetailRepository->findOrFail($id);
        $data = compact(
            'languages',
            'origin',
            'location_id'
        );

        return view('admin.rooms.translation', $data);
    }

    public function storeTranslation(TranslationRequest $request, $location_id, $id)
    {
        $data = $request->except('_token');
        $data['lang_parent_id'] = $id;
        $this->roomDetailRepository->create($data);
        $request->session()->flash('success', 'Tạo bản dịch thành công');
        Session::put('locale', $data['lang_id']);

        return redirect(route('admin.rooms.index', $location_id));
    }

    public function delete(Request $request, $location_id, $id)
    {
        $checkInvoice = $this->roomRepository->checkInvoiceRoom($id);

        if (!$checkInvoice) {
            $request->session()->flash('error', 'Phòng này đang được sử dụng');

            return redirect()->back();
        }

        $action = $this->roomDetailRepository->deleteRoom($id);

        if ($action) {
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Có lỗi xảy ra');
        }
        return redirect()->back();
    }

    public function showOriginal($location_id, $id)
    {
        Session::put('locale', config('common.languages.default'));

        return redirect(route('admin.rooms.edit', [$location_id, $id]));
    }

    public function addProperties(Request $request, $location_id)
    {
        $data = $request->all();
        $room = $this->roomRepository->find($data['room_id']);
        $property = $this->propertyRepository->find($data['id']);
        if (is_null($room) || is_null($property)) {
            return response()->json(['messages' => 'errors'], 200);
        }
        $data['property_name'] = $property->name;
        $room->properties()->attach($data['id']);

        return response()->json(['messages' => 'success', 'data' => $data], 200);
    }

    public function deleteProperties(Request $request)
    {
        $data = $request->all();
        $room = $this->roomRepository->find($data['room_id']);
        $property = $this->propertyRepository->find($data['id']);
        if (is_null($room) || is_null($property)) {
            return response()->json(['messages' => 'errors'], 200);
        }
        $data['property_name'] = $property->name;
        $room->properties()->detach($data['id']);

        return response()->json(['messages' => 'success', 'data' => $data], 200);
    }

    public function uploadImage(Request $request, $id)
    {
        $this->libraryRepository->uploadImage($request, $id);
        $request->session()->flash('image_active');
    }

    public function destroyImage(Request $request)
    {
        $this->libraryRepository->destroyImage($request);
        $request->session()->flash('image_active');
    }

    public function deleteImage(Request $request, $id)
    {
        $this->libraryRepository->deleteImage($id);
        $request->session()->flash('image_active');

        return redirect()->back();
    }

}
