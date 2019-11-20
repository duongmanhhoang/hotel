<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomName\StoreRequest;
use App\Http\Requests\Admin\RoomName\TranslationRequest;
use App\Http\Requests\Admin\RoomName\UpdateRequest;
use App\Repositories\RoomName\RoomNameRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoomNameController extends Controller
{
    public function __construct(RoomNameRepository $roomNameRepository)
    {
        $this->roomNameRepository = $roomNameRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if (!is_null($keyword)) {
            $roomNames = $this->roomNameRepository->searchByLang('name', $_GET['keyword'], config('common.pagination.default'), session('locale'));
        } else {
            $roomNames = $this->roomNameRepository->paginateByLang(session('locale'), config('common.pagination.default'));

        }
        $data = compact(
            'roomNames'
        );

        return view('admin.roomNames.index', $data);
    }

    public function datatable()
    {
        $roomNames = $this->roomNameRepository->makeDataTable();

        return response()->json(['data' => $roomNames], 200);
    }

    public function create()
    {
        return view('admin.roomNames.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['lang_id'] = $this->baseLang;
        $data['lang_parent_id'] = 0;
        $this->roomNameRepository->create($data);
        $request->session()->flash('success', 'Thêm thành công');
        Session::put('locale', $this->baseLang);

        return redirect(route('admin.roomNames.index'));
    }

    public function edit(Request $request, $id)
    {
        $roomName = $this->roomNameRepository->findOrFail($id);

        if (session('locale') != $this->baseLang) {
            $roomName = $this->roomNameRepository->where('lang_parent_id', '=', $id)->where('lang_id', session('locale'))->first();

            if (!$roomName) {
                $request->session()->flash('error', 'Chưa có bản dịch');
                Session::put('locale');

                return redirect(route('admin.roomNames.edit', $id));
            }
        }

        $data = compact(
            'roomName'
        );


        return view('admin.roomNames.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $this->roomNameRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhập thành công');

        return redirect()->back();
    }

    public function translation(Request $request, $id)
    {
        $roomName = $this->roomNameRepository->find($id);
        $languages = $this->roomNameRepository->getTranslateId($id);

        if (count($languages) == 0) {
            $request->session()->flash('error', 'Đã có đầy đủ các bản dịch');

            return redirect()->back();
        }

        $data = compact(
            'languages',
            'roomName'
        );

        return view('admin.roomNames.translation', $data);
    }

    public function storeTranslation(TranslationRequest $request, $id)
    {
        $data = $request->all();
        $data['lang_parent_id'] = $id;
        $this->roomNameRepository->create($data);
        $request->session()->flash('success', 'Tạo bản dịch thành công');
        Session::put('locale', $data['lang_id']);

        return redirect(route('admin.roomNames.index'));
    }

    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $check = $this->roomNameRepository->deleteRoomName($id);

            if ($check) {
                DB::commit();
                $dataResponse = [
                    'messages' => 'success',
                ];
            } else {
                $dataResponse = [
                    'messages' => 'used',
                ];
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $dataResponse = [
                'messages' => 'error',
                'data' => $e->getMessage(),
            ];
        }

        return response()->json($dataResponse, 200);
    }
}
