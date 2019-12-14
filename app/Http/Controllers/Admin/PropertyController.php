<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Properties\StoreRequest;
use App\Http\Requests\Admin\Properties\TranslationRequest;
use App\Http\Requests\Admin\Properties\UpdateRequest;
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

    public function datatable()
    {
        $properties = $this->propertyRepository->makeDataTable();

        return response()->json(['data' => $properties], 200);
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $data['lang_id'] = $this->baseLang;
        $data['lang_parent_id'] = 0;
        DB::beginTransaction();
        try {
            if ($request->image) {
                $data['image'] = uploadImage('properties', $data['image']);
            }

            $this->propertyRepository->create($data);
            DB::commit();
            $request->session()->flash('success', 'Thêm thành công');

            return redirect(route('admin.properties.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        if ($request->image) {
            $data['image'] = uploadImage('properties', $data['image']);
        }
        $this->propertyRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhập thành công');

        return redirect()->back();
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
        $origin = $this->propertyRepository->find($id);
        $data['image'] = $origin->image;
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
            $dataResponse = [
                'messages' => 'success'
            ];
        } else {
            $dataResponse = [
                'messages' => 'error'
            ];
        }

        return response()->json(['data' => $dataResponse], 200);
    }

    public function getByRoom($room_id)
    {
        $data = $this->propertyRepository->getByRoom($room_id);

        return response()->json($data, 200);
    }

    public function edit(Request $request, $id)
    {
        if (\session('locale') == $this->baseLang) {
            $property = $this->propertyRepository->findOrFail($id);
        } else {
            $property = $this->propertyRepository->where('lang_parent_id','=', $id)->first();

            if (!$property) {
                $request->session()->flash('error', 'Chưa có bản dịch');
                Session::put('locale', $this->baseLang);

                return redirect()->back();
            }
        }

        return view('admin.properties.edit', compact('property'));

    }

}
