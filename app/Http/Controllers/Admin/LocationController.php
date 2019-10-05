<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Locations\StoreRequest;
use App\Http\Requests\Admin\Locations\TranslationRequest;
use App\Http\Requests\Admin\Locations\UpdateRequest;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Province\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function __construct(LocationRepository $locationRepository, ProvinceRepository $provinceRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->provinceRepository = $provinceRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if (!is_null($keyword)) {
            $locations = $this->locationRepository->searchByLang('name', $keyword, config('common.pagination.default'), Session::get('locale'));
        } else {
            $locations = $this->locationRepository->paginateByLang(session('locale'), config('common.pagination.default'));
        }
        $data = compact(
            'locations'
        );

        return view('admin.locations.index', $data);
    }

    public function create()
    {
        $provinces = $this->provinceRepository->all();
        $data = compact(
            'provinces'
        );

        return view('admin.locations.create', $data);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $data['lang_id'] = $this->baseLang;
        $this->locationRepository->create($data);
        $request->session()->flash('success', 'Thêm cơ sở thành công');
        Session::put('locale', $this->baseLang);

        return redirect(route('admin.locations.index'));
    }

    public function edit(Request $request, $id)
    {
        if (session('locale') == $this->baseLang) {
            $location = $this->locationRepository->findOrFail($id);
        } else {
            $location = $this->locationRepository->findByLang($id);
            if ($location == false) {
                $request->session()->flash('error', 'Không tìm thấy bản dịch này');

                return redirect()->back();
            }
        }
        $provinces = $this->provinceRepository->all();
        $data = compact(
            'location',
            'provinces'
        );

        return view('admin.locations.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $this->locationRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhập thành công');

        return redirect()->back();
    }

    public function translation(Request $request, $id)
    {
        $languages = $this->locationRepository->getTranslateId($id);
        if (count($languages) == 0) {
            $request->session()->flash('error', 'Đã có đủ các bản dịch');

            return redirect()->back();
        }
        $origin = $this->locationRepository->findOrFail($id);
        $data = compact(
            'languages',
            'origin'
        );

        return view('admin.locations.translation', $data);
    }

    public function storeTranslation(TranslationRequest $request, $id)
    {
        $data = $request->except('_token');
        $origin = $this->locationRepository->findOrFail($id);
        $data['phone'] = $origin->phone;
        $data['email'] = $origin->email;
        $data['province_id'] = $origin->province_id;
        $data['lang_parent_id'] = $id;
        $this->locationRepository->create($data);
        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $request->lang_id);

        return redirect(route('admin.locations.index'));
    }

    public function delete(Request $request, $id)
    {
        $action = $this->locationRepository->delete($id);
        if ($action) {
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Có lỗi xảy ra');
        }
        return redirect()->back();
    }

    public function showOriginal($id)
    {
        Session::put('locale', config('common.languages.default'));

        return redirect(route('admin.locations.edit', $id));
    }
}
