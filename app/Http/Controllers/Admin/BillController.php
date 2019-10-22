<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\BillPostRequest;
use App\Repositories\Bill\BillRepository;
use App\Repositories\Location\LocationRepository;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct(
        BillRepository $billRepository,
        LocationRepository $locationRepository
    )
    {
        $this->billRepo = $billRepository;
        $this->locationRepo = $locationRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $data = $this->billRepo->searchBill($input);

        $compact = compact('data');

        return view('admin.bill.index', $compact);
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

        $this->billRepo->updateBill($id, $input);

        $request->session()->flash('success', 'Sửa thành công');

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $data = $this->billRepo->deleteBill($id);

        if($data == null) {
            return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        if ($data == true) {
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Có lỗi xảy ra');
        }

        return redirect()->back();
    }
}
