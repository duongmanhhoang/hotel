<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Statistical\StatisticalRepository;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    public function __construct(StatisticalRepository $statisticalRepository)
    {
        $this->statisticalRepo = $statisticalRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $data = $this->statisticalRepo->searchStatistical($input);

        return $data;
    }
}
