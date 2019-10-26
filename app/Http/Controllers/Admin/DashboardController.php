<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Analytic\AnalyticRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $analyticRepository;

    public function __construct(AnalyticRepository $analyticRepository)
    {
        $this->analyticRepository = $analyticRepository;
    }

    public function index()
    {
        $analyticUser = $this->analyticRepository->getWeeklyResult();
        $pages = $this->analyticRepository->getHighestPageAccess();
        $data = compact(
            'analyticUser',
            'pages'
        );

        return view('admin.index', $data);
    }
}
