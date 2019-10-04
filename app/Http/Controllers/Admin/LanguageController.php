<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
        $languages = $this->languageRepository->paginate(config('common.pagination.default'));
        $data = compact(
            'languages'
        );

        return view('admin.languages.index', $data);
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store()
    {

    }
}
