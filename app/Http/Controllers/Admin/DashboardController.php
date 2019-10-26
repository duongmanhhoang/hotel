<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Analytic\AnalyticRepository;
use App\Repositories\Statistical\StatisticalRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $analyticRepository;

    public function __construct(
        AnalyticRepository $analyticRepository,
        StatisticalRepository $statisticalRepository
    )
    {
        $this->analyticRepository = $analyticRepository;
        $this->statisticalReppo = $statisticalRepository;
    }

    public function index()
    {
        $analyticUser = $this->analyticRepository->getWeeklyResult();
        $pages = $this->analyticRepository->getHighestPageAccess();
        $statistical = $this->statisticalReppo->statisticalByMonth();

        $data = compact(
            'analyticUser',
            'pages',
            'statistical'
        );

        return view('admin.index', $data);
    }
}
