<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Languages\StoreRequest;
use App\Http\Requests\Admin\Languages\UpdateRequest;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function index(Request $request)
    {
        $keword = $request->keyword;
        if (!is_null($keword)) {
            $languages = $this->languageRepository->search('name', $keword, config('common.pagination.default'));
        } else {
            $languages = $this->languageRepository->paginate(config('common.pagination.default'));
        }
        $data = compact(
            'languages'
        );

        return view('admin.languages.index', $data);
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function edit($id)
    {
        $language = $this->languageRepository->findOrFail($id);
        $data = compact(
            'language'
        );

        return view('admin.languages.edit', $data);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $data['flag'] = uploadImage('languages', $data['flag']);

        $this->languageRepository->create($data);
        $request->session()->flash('success', 'Thêm ngôn ngữ thành công');

        return redirect(route('admin.languages.index'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        if ($request->flag) {
            $data['flag'] = uploadImage('languages', $data['flag']);
        } else {
            $data['flag'] = $request->current_image;
        }
        $this->languageRepository->update($id, $data);
        $request->session()->flash('success', 'Sửa thành công');

        return redirect()->back();
    }

    public function deactive(Request $request, $id)
    {
        if ($id == config('common.languages.default')) {
            $request->session()->flash('error', 'Không thể hủy ngôn ngữ mặc định');

            return redirect()->back();
        }
        if (session('locale') == $id) {
            $request->session()->forget('locale');
        };
        $this->languageRepository->update($id, ['status' => false]);
        $request->session()->flash('success', 'Hủy kích hoạt thành công');

        return redirect()->back();
    }

    public function active(Request $request, $id)
    {
        $this->languageRepository->update($id, ['status' => true]);
        $request->session()->flash('success', 'Kích hoạt thành công');

        return redirect()->back();
    }
}
