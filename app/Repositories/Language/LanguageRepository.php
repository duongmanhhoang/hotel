<?php

namespace App\Repositories\Language;

use App\Models\Language;
use App\Repositories\EloquentRepository;

class LanguageRepository extends EloquentRepository
{
    public function getModel()
    {
        return Language::class;
    }

    public function getLanguage()
    {
        return $this->_model->all();
    }

    public function makeDataTable()
    {
        $languages = $this->_model->all();

        return $languages;
    }
}
