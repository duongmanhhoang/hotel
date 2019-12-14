<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceCategories\StoreRequest;
use App\Http\Requests\Admin\ServiceCategories\TranslationRequest;
use App\Http\Requests\Admin\ServiceCategories\UpdateRequest;
use App\Models\Category;
use App\Models\Service;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Unit\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    private $serviceRepository;
    private $categoryRepository;
    private $unitRepository;
    private $baseLang;

    public function __construct(ServiceRepository $serviceRepository, CategoryRepository $categoryRepository, UnitRepository $unitRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->unitRepository = $unitRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function createCategory()
    {
        return view('admin.services.categories.create');
    }

    public function storeCategory(StoreRequest $request)
    {
        $this->categoryRepository->storeServiceCategory($request->name);
        $request->session()->flash('success', 'Lưu thành công');

        return redirect(route('admin.services.categories.index'));
    }

    public function categories()
    {
        return view('admin.services.categories.index');
    }

    public function categoriesData()
    {
        $categories = $this->categoryRepository->makeServiceCategoryData();

        return response()->json(['data' => $categories], 200);
    }

    public function editCategory(Request $request, $id)
    {
        if (session('locale') == $this->baseLang) {
            $category = $this->categoryRepository->findOrFail($id);
        } else {
            $category = $this->categoryRepository->where('lang_parent_id', '=', $id)->where('lang_id', session('locale'))->first();
            if (!$category) {
                $request->session()->flash('error', 'Chưa có bản dịch');
                Session::put('locale');

                return redirect(route('admin.services.categories.edit', $id));
            }
        }


        return view('admin.services.categories.edit', compact('category'));
    }

    public function updateCategory(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $this->categoryRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhập thành công');

        return redirect()->back();
    }

    public function translationCategory(Request $request, $id)
    {
        $languages = $this->categoryRepository->getTranslateId($id);

        if (!$languages) {
            $request->session()->flash('error', 'Đã có đủ các bản dịch');

            return redirect()->back();
        }

        $category = $this->categoryRepository->find($id);
        $data = compact(
            'languages',
            'category'
        );

        return view('admin.services.categories.translation', $data);
    }

    public function storeTranslationCategory(TranslationRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['lang_parent_id'] = $id;
        $data['type'] = Category::SERVICE;
        $this->categoryRepository->create($data);
        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $request->lang_id);

        return redirect(route('admin.services.categories.index'));
    }

    public function deleteCategory($id)
    {
        $checkService = $this->categoryRepository->checkServices($id);
        if ($checkService) {
            $dataResponse = [
                'messages' => 'used',
            ];
        } else {
            DB::beginTransaction();
            try {
                $this->categoryRepository->deleteServiceCategory($id);
                DB::commit();
                $dataResponse = [
                    'messages' => 'success',
                ];
            } catch (\Exception $e) {
                DB::rollBack();
                throw new \Exception($e->getMessage());
            }

        }

        return response()->json($dataResponse, 200);
    }

    public function create()
    {
        $units = $this->unitRepository->where('lang_parent_id', '=', 0)->get();
        $categories = $this->categoryRepository->where('lang_parent_id', '=', 0)->where('type', Category::SERVICE)->get();
        $data = compact(
            'units',
            'categories'
        );

        return view('admin.services.create', $data);
    }

    public function store(\App\Http\Requests\Admin\Services\StoreRequest $request)
    {
        $data = $request->except('_token');
        $this->serviceRepository->storeService($data);
        $request->session()->flash('success', 'Lưu thành công');
        Session::put('locale', $this->baseLang);

        return redirect(route('admin.services.index'));
    }

    public function datatable()
    {
        $services = $this->serviceRepository->makeDataTable();

        return response()->json(['data' => $services], 200);
    }

    public function index()
    {
        return view('admin.services.index');
    }

    public function edit(Request $request, $id)
    {
        $service = $this->serviceRepository->findOrFail($id);
        if (session('locale') != $this->baseLang) {
            $service = $this->serviceRepository->where('lang_parent_id', '=', $id)->where('lang_id', session('locale'))->first();
            if (!$service) {
                $request->session()->flash('error', 'Chưa có bản dịch');
                Session::put('locale');

                return redirect(route('admin.services.edit', $id));
            }
        }
        $units = $this->unitRepository->where('lang_id', '=', \session('locale'))->get();
        $categories = $this->categoryRepository->where('lang_id', '=', \session('locale'))->where('type', Category::SERVICE)->get();
        $data = compact(
            'units',
            'categories',
            'service'
        );


        return view('admin.services.edit', $data);
    }

    public function update(\App\Http\Requests\Admin\Services\UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['image'] = uploadImage('services', $data['image']);
        $this->serviceRepository->update($id, $data);
        $request->session()->flash('success', 'Sửa thành công');

        return redirect()->back();
    }

    public function translation(Request $request, $id)
    {
        $languages = $this->serviceRepository->getTranslateId($id);
        $service = $this->serviceRepository->find($id);

        if (!$languages) {
            $request->session()->flash('error', 'Đã có đủ các bản dịch');

            return redirect()->back();
        }


        $data = compact(
            'languages',
            'service'
        );

        return view('admin.services.translation', $data);
    }

    public function storeTranslation(\App\Http\Requests\Admin\Services\TranslationRequest $request, $id)
    {
        $service = $this->serviceRepository->find($id);
        $data = $request->except('_token');
        $checkUnit = $this->serviceRepository->checkUnitTranslate($service, $data['lang_id']);
        if (!$checkUnit) {
            $request->session()->flash('error', 'Chưa có bản dịch của đơn vị');

            return redirect()->back();
        }

        $checkCate = $this->serviceRepository->checkCateTranslate($service, $data['lang_id']);
        if (!$checkCate) {
            $request->session()->flash('error', 'Chưa có bản dịch của danh mục');

            return redirect()->back();
        }
        $this->serviceRepository->translate($data, $id);
        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $request->lang_id);

        return redirect(route('admin.services.index'));
    }

    public function origin($id)
    {
        Session::put('locale', $this->baseLang);

        return redirect(route('admin.services.edit', $id));

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $check = $this->serviceRepository->deleteService($id);

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
