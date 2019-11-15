<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Rooms\SearchRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Library\LibraryRepository;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomName\RoomNameRepository;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    private $roomRepository;
    private $locationRepository;
    private $propertyRepository;
    private $baseLang;
    private $roomNameRepository;
    private $serviceRepository;
    private $categoryRepository;
    private $commentRepository;
    private $libraryRepository;

    public function __construct(
        RoomRepository $roomRepository,
        LocationRepository $locationRepository,
        PropertyRepository $propertyRepository,
        RoomNameRepository $roomNameRepository,
        ServiceRepository $serviceRepository,
        CategoryRepository $categoryRepository,
        CommentRepository $commentRepository,
        LibraryRepository $libraryRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->locationRepository = $locationRepository;
        $this->propertyRepository = $propertyRepository;
        $this->roomNameRepository = $roomNameRepository;
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
        $this->libraryRepository = $libraryRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index($location_id)
    {
        $location = $this->locationRepository->findOrFail($location_id);
        $rooms = $this->roomRepository
            ->where('location_id', '=', $location_id)
            ->with([
                'roomName',
                'roomDetails' => function ($q) {
                    $q->where('lang_id', session('locale'));
                },
                'properties'
            ])
            ->whereHas('roomDetails', function ($q) {
                $q->where('lang_id', session('locale'));
            })->paginate(config('common.pagination.default'));
        if (session('locale') != $this->baseLang) {
            foreach ($rooms as $room) {
                $roomNameId = $room->roomName->id;
                $name = $this->roomNameRepository->where('lang_parent_id', '=', $roomNameId)->first();
                if ($name) {
                    $room->name = $name->name;
                }
            }
        }
        $propertyRepository = $this->propertyRepository;
        $data = compact(
            'rooms',
            'location',
            'propertyRepository'
        );

        return view('client.rooms.index', $data);
    }

    public function detail(Request $request, $location_id, $id)
    {
        $location = $this->locationRepository->find($location_id);
        $room = $this->roomRepository->findOrFail($id);
        $room->load(['properties']);
        if (session('locale') == $this->baseLang) {
            $name = $room->roomName->name;
        } else {
            $nameId = $room->roomName->id;
            $roomName = $this->roomNameRepository->where('lang_parent_id', '=', $nameId)->first();
            if ($roomName) {
                $name = $roomName->name;
            } else {
                $name = '';
            }
        }
        $roomDetail = $room->roomDetails->where('lang_id', session('locale'))->first();
        if (!$roomDetail) {
            $request->session()->flash('error', 'Chưa có bản dịch của phòng này');
            Session::put('locale', $this->baseLang);

            return redirect(route('rooms.detail', [$location_id, $id]));
        }

        $stars = round((int)$room->rating);
        $whiteStars = 5 - (int)$room->rating;
        if (\session('locale') == $this->baseLang) {
            $properties = $room->properties;
        } else {
            $propertyIds = $room->properties->pluck('id')->toArray();
            $properties = $this->propertyRepository->whereIn('lang_parent_id', $propertyIds)->where('lang_id', \session('locale'))->get();
        }
        $categoriesService = $this->categoryRepository->where('type', '=', Category::SERVICE)
            ->where('lang_id', \session('locale'))->get();
        $categoriesService->load(['services', 'parentTranslate']);
        $comments = $this->commentRepository->getCommentsByRoom($id);
        $user = Auth::user();
        $showEmail = false;
        if ($user) {
            if ($user->role_id == config('common.roles.super_admin') || $user->role_id == config('common.roles.admin')) {
                $showEmail = true;
            }
        }

        $images = $this->libraryRepository->getImagesByRoom($id);

        $data = compact(
            'location_id',
            'room',
            'roomDetail',
            'stars',
            'whiteStars',
            'properties',
            'name',
            'categoriesService',
            'comments',
            'showEmail',
            'location',
            'images'
        );

        return view('client.rooms.detail', $data);
    }

    public function comment(Request $request, $location_id, $id)
    {
        $data = $request->all();
        $rules = $this->commentRepository->makeRules();
        $messages = $this->commentRepository->messages();
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $dataResponse = [
                'messages' => 'validation_fail',
                'data' => $validator->messages(),
            ];
        } else {
            DB::beginTransaction();
            try {
                $data = $this->commentRepository->storeData($data, $id);
                DB::commit();

                $dataResponse = [
                    'messages' => 'success',
                    'data' => $data,
                ];
            } catch (\Exception $exception) {
                DB::rollBack();

                $dataResponse = [
                    'messages' => 'error',
                    'data' => $exception->getMessage(),
                ];
            }

        }

        return response()->json($dataResponse, 200);
    }

    public function search(SearchRequest $request)
    {
        $rooms = $this->roomRepository->searchRooms($request);

        if ($rooms) {
            if (session('locale') != $this->baseLang) {
                foreach ($rooms as $room) {
                    $roomNameId = $room->roomName->id;
                    $name = $this->roomNameRepository->where('lang_parent_id', '=', $roomNameId)->first();
                    if ($name) {
                        $room->name = $name->name;
                    }
                }
                $propertyRepository = $this->propertyRepository;
            }

        } else {
            $request->session()->flash('error', 'Không có phòng phù hợp');

            return redirect()->back();
        }

        $data = compact(
            'rooms',
            'location',
            'propertyRepository'
        );

        return view('client.rooms.search', $data);
    }
}
