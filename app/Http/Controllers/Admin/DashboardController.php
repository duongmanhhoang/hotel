<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Analytic;
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
        $analyticUser = $this->analyticRepository->getResult(true);
        $pages = $this->analyticRepository->getHighestPageAccess(Analytic::TODAY_ACCESS);
        $statistical = $this->statisticalReppo->statisticalByMonth();

        $data = compact(
            'analyticUser',
            'pages',
            'statistical'
        );

        return view('admin.index', $data);
    }

    public function userAnalytic(Request $request)
    {
        $data = $request->all();
        $option = $request->option;
        if ($option == Analytic::WEEKLY) {
            $analyticUser = $this->analyticRepository->getResult(true);
        } elseif($option == Analytic::MONTHLY) {
            $analyticUser = $this->analyticRepository->getResult(false);
        } elseif ($option == Analytic::YEAR) {
            $analyticUser = $this->analyticRepository->getYearResult(date('Y'));
        } elseif ($option == Analytic::ADVANCE) {
            $analyticUser = $this->analyticRepository->getAdvanceResult($data);
        }
        $dataResponse = [
            'messages' => 'success',
            'data' => $analyticUser,
        ];

        return response()->json($dataResponse, 200);
    }

    public function userAccess(Request $request)
    {
        $data = $request->all();
        $result = $this->analyticRepository->getHighestPageAccess($data['option']);
        $dataResponse = [
            'messages' => 'success',
            'data' => $result,
        ];

        return response()->json($dataResponse, 200);
    }
}
