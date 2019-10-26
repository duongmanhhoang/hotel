<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomName\StoreRequest;
use App\Http\Requests\Admin\RoomName\TranslationRequest;
use App\Repositories\RoomName\RoomNameRepository;
use Illuminate\Http\Request;
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

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['lang_id'] = $this->baseLang;
        $data['lang_parent_id'] = 0;
        $this->roomNameRepository->create($data);
        $request->session()->flash('success', 'Thêm thành công');
        Session::put('locale', $this->baseLang);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = array(
            'name' => [
                'required',
                'max:191',
                'unique' => Rule::unique('room_names')->where('lang_id', session('locale'))->ignore($id),
            ],
        );
        $messages = array(
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vui lòng không nhập quá' . ' :max ' . 'ký tự',
            'name.unique' => 'Tên này đã được sử dụng',
        );
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {

            return response()->json(['messages' => 'error', 'errors' => $validator->messages()], 200);
        }
        $roomName = $this->roomNameRepository->update($id, $data);

        return response()->json(['messages' => 'success', 'data' => $roomName], 200);
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
        $check = $this->roomNameRepository->deleteRoomName($id);
        if (!$check) {
            $request->session()->flash('error', 'Tên phòng này đang được sử dụng');

            return redirect()->back();
        }
        $request->session()->flash('success', 'Xóa thành công');

        return redirect()->back();


    }
}
