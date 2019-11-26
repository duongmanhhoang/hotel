<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\BillPostRequest;
use App\Repositories\Bill\BillRepository;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Statistical\StatisticalRepository;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct(
        BillRepository $billRepository,
        StatisticalRepository $statisticalRepository,
        LocationRepository $locationRepository
    )
    {
        $this->billRepo = $billRepository;
        $this->statisticalReppo = $statisticalRepository;
        $this->locationRepo = $locationRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $data = $this->billRepo->searchBill($input);

        $statistical = $this->statisticalReppo->statisticalByMonth();
        $locations = $this->locationRepo->contactGetLocation();

        $compact = compact('data', 'statistical', 'locations');

        return view('admin.bill.index', $compact);
    }

    public function dataTable()
    {
        $data = $this->billRepo->searchBill();

        return response()->json(['data' => $data]);
    }

    public function test()
    {
        $test = $this->billRepo->recordsDailyInsert();

        return $test;
    }

    public function addView()
    {
        $route = route('admin.bill.postAction');
        $locations = $this->locationRepo->getMainLocation();

        $compact = compact('route', 'locations');

        return view('admin.bill.add', $compact);
    }

    public function store(BillPostRequest $request)
    {
        $input = $request->all();
        $this->billRepo->insertBill($input);

        $request->session()->flash('success', 'Thêm hóa đơn thành công');

        return redirect()->route('admin.bill.list');
    }

    public function editView($id)
    {
        $data = $this->billRepo->findBillById($id);
        $locations = $this->locationRepo->getMainLocation();
        $route = route('admin.bill.editAction', ['id' => $id]);

        if($data == null) {
            return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        $compact = compact('data', 'locations', 'route');

        return view('admin.bill.add', $compact);
    }

    public function postEdit(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];

        $checkUpdateBill = $this->billRepo->find($id);

        $this->statisticalReppo->updateStatisticalAfterUpdateBill($checkUpdateBill, $input);

        $this->billRepo->updateBill($id, $input);

        $request->session()->flash('success', 'Sửa thành công');

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {

        $bill = $this->billRepo->find($id);

        $dayTime = explode(' ', $bill->created_at);

        $statistical = $this->statisticalReppo->findStatisticalByTime($dayTime);

        if($statistical != null) {
            $this->statisticalReppo->updateStatisticalAfterDeleteBill($statistical, $bill);
        }

        $result = $this->billRepo->deleteBill($bill);

        return response()->json(['status' => $result]);
    }
}
