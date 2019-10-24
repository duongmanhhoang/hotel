<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Properties\TranslationRequest;
use App\Repositories\Property\PropertyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    /**
     * @var PropertyRepository
     */
    private $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if (!is_null($keyword)) {
            $properties = $this->propertyRepository->searchByLang('name', $_GET['keyword'], config('common.pagination.default'), session('locale'));
        } else {
            $properties = $this->propertyRepository->paginateByLang(session('locale'), config('common.pagination.default'));

        }

        $data = compact(
            'properties'
        );
        return view('admin.properties.index', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['lang_id'] = $this->baseLang;
        $data['lang_parent_id'] = 0;
        DB::beginTransaction();
        try {
            $property = $this->propertyRepository->create($data);
            DB::commit();
            $request->session()->flash('success', 'Thêm thành công');

            return redirect(route('admin.properties.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = array(
            'name' => [
                'required',
                'max:191',
                'unique' => Rule::unique('properties')->where('lang_id', session('locale'))->ignore($id),
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
        $property = $this->propertyRepository->update($id, $data);

        return response()->json(['messages' => 'success', 'data' => $property], 200);
    }

    public function translation(Request $request, $id)
    {
        $property = $this->propertyRepository->find($id);
        $languages = $this->propertyRepository->getTranslateId($id);

        if (count($languages) == 0) {
            $request->session()->flash('error', 'Đã có đầy đủ các bản dịch');

            return redirect()->back();
        }

        $data = compact(
            'languages',
            'property'
        );

        return view('admin.properties.translation', $data);
    }

    public function storeTranslation(TranslationRequest $request, $id)
    {
        $data = $request->all();
        $data['lang_parent_id'] = $id;
        DB::beginTransaction();
        try {
            $this->propertyRepository->create($data);
            DB::commit();
            $request->session()->flash('success', 'Tạo bản dịch thành công');
            Session::put('locale', $data['lang_id']);

            return redirect(route('admin.properties.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        $delete = $this->propertyRepository->deleteProperty($id);

        if ($delete) {
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Có lỗi xảy ra, xin vui lòng thử lại');
        }

        return redirect()->back();
    }

}
