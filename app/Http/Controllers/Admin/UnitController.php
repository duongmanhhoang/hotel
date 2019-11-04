<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use App\Http\Requests\Admin\Units\StoreRequest;
use App\Http\Requests\Admin\Units\TranslationRequest;
use App\Repositories\Unit\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    private $unitRepository;
    private $baseLang;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index()
    {
        return view('admin.units.index');
    }

    public function datatable()
    {
        $units = $this->unitRepository->makeDataTable();

        return response()->json(['data' => $units], 200);
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $data['lang_id'] = $this->baseLang;
        $this->unitRepository->create($data);
        $request->session()->flash('success', 'Lưu thành công');

        return redirect(route('admin.units.index'));
    }

    public function edit(Request $request, $id)
    {
        if (session('locale') == $this->baseLang) {
            $unit = $this->unitRepository->findOrFail($id);
        } else {
            $unit = $this->unitRepository->where('lang_parent_id', '=', $id)->where('lang_id', session('locale'))->first();
            if (!$unit) {
                $request->session()->flash('error', 'Chưa có bản dịch');
                Session::put('locale');

                return redirect(route('admin.units.edit', $id));
            }
        }


        return view('admin.units.edit', compact('unit'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $this->unitRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhập thành công');

        return redirect()->back();
    }

    public function translation(Request $request, $id)
    {
        $languages = $this->unitRepository->getTranslateId($id);

        if (!$languages) {
            $request->session()->flash('error', 'Đã có đủ các bản dịch');

            return redirect()->back();
        }

        $unit = $this->unitRepository->find($id);
        $data = compact(
            'languages',
            'unit'
        );

        return view('admin.units.translation', $data);
    }

    public function storeTranslation(TranslationRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['lang_parent_id'] = $id;
        $this->unitRepository->create($data);
        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $request->lang_id);

        return redirect(route('admin.units.index'));
    }

    public function origin($id)
    {
        Session::put('locale', $this->baseLang);

        return redirect(route('admin.units.edit', $id));

    }

    public function delete($id)
    {
        $checkService =  $this->unitRepository->checkService($id);
        if ($checkService) {
            $dataResponse = [
                'messages' => 'used',
            ];
        } else {
            DB::beginTransaction();
            try {
                $this->unitRepository->deleteUnit($id);
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
}
