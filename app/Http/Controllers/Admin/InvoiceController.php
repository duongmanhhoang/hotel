<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoices\StoreRequest;
use App\Models\ListRoomNumber;
use App\Models\Room;
use App\Models\RoomName;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\InvoiceRoom\InvoiceRoomRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomName\RoomNameRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function PHPSTORM_META\type;

class InvoiceController extends Controller
{
    private $invoiceRepository;
    private $roomRepository;
    private $baseLang;
    private $roomNameRepsitory;

    public function __construct(InvoiceRepository $invoiceRepository, RoomRepository $roomRepository, RoomNameRepository $roomNameRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->roomRepository = $roomRepository;
        $this->roomNameRepsitory = $roomNameRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request)
    {
        $dataTable = $this->invoiceRepository->makeDataTable()->toJson();
//        dd($dataTable);
        $data = compact(
            'dataTable'
        );

        return view('admin.invoices.index', $data);
    }

    public function datatable()
    {
        $invoices = $this->invoiceRepository->makeDataTable();

        return response()->json($invoices, 200);
    }

    public function create()
    {
        $rooms = $this->roomRepository->all();
        $data = compact(
            'rooms'
        );

        return view('admin.invoices.create', $data);
    }

    public function edit($id)
    {
        $today = Carbon::today();
        $invoice = $this->invoiceRepository->findOrFail($id);
        $invoiceRoom = $invoice->rooms->first()->pivot;
        $room = $invoice->rooms->first();
        $checkIn = formatDate($invoiceRoom->check_in_date);
        $diff = Carbon::parse($checkIn)->diff($today);
        $disable = false;
        if (!$diff->invert) {
            $disable = true;
        };
        $roomNameRepository = $this->roomNameRepsitory;
        $checkOut = formatDate($invoiceRoom->check_out_date);
        $roomDetail = $room->roomDetails->where('lang_parent_id', 0)->first();
        $data = compact(
            'invoice',
            'room',
            'invoiceRoom',
            'roomDetail',
            'checkIn',
            'checkOut',
            'disable',
            'roomNameRepository'
        );

        return view('admin.invoices.edit', $data);
    }

    public function show($id)
    {
        $invoice = $this->invoiceRepository->findOrFail($id);
        $invoiceRoom = $invoice->rooms->first()->pivot;
        $room = $invoice->rooms->first();
        $roomDetail = $room->roomDetails->where('lang_parent_id', 0)->first();
        if ($invoiceRoom->currency) {
            $detail = $room->roomDetails->where('lang_parent_id', '<>', 0)->first();
            $price = $room->sale_status ? $detail->sale_price : $detail->price;
        } else {
            $price = $room->sale_status ? $roomDetail->sale_price : $roomDetail->price;
        }
        $currency = $invoiceRoom->currency ? '$' : 'vnđ';
        $data = compact(
            'invoice',
            'room',
            'invoiceRoom',
            'roomDetail',
            'price',
            'currency'
        );

        return view('admin.invoices.show', $data);
    }

    public function getAvailableRoomNumbers(Request $request, $id)
    {
        $room = $this->roomRepository->find($id);

        if (!$room) {
            $dataRespone = [
                'messages' => 'not_found',
            ];
        } else {
            $numbers = $this->roomRepository->availableTimeByRoom($request, $room);
            $numbers = ListRoomNumber::where('room_id', $id)->whereIn('room_number', $numbers)->get();
            $dataRespone = [
                'messages' => 'success',
                'data' => $numbers
            ];
        }

        return response()->json($dataRespone, 200);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        DB::beginTransaction();
        try {
            $this->invoiceRepository->storeData($data);
            DB::commit();
            $request->session()->flash('success', 'Tạo hóa đơn thành công');

            return redirect(route('admin.invoices.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $invoice = $this->invoiceRepository->findOrFail($id);
        $invoiceRoom = $invoice->rooms->first()->pivot;
        $disabled = $request->disabled;

        if ($disabled == 1) {
            $validator = Validator::make($data, $this->invoiceRepository->makeRulesUpdateAfter(), $this->invoiceRepository->messagesUpdateAfter());
        } else {
            $validator = Validator::make($data, $this->invoiceRepository->makeRulesUpdateBefore(), $this->invoiceRepository->messagesUpdateBefore());
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $this->invoiceRepository->updateData($data, $invoice, $invoiceRoom);
            DB::commit();
            $request->session()->flash('success', 'Cập nhập hóa đơn thành công');

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function getAvailableRoom(Request $request)
    {
        $results = $this->roomRepository->roomAvailable($request);
        $rooms = Room::whereIn('id', $results['room_id'])->get();

        foreach ($rooms as $room) {
            if (session('locale') == config('common.languages.default')) {
                $room->name = $room->roomName->name;
            } else {
                $room->name = RoomName::where('lang_id', session('locale'))->where('lang_parent_id', $room->room_name_id)->first()->name;
            }

        }

        if ($rooms) {
            $dataResponse = [
                'messages' => 'success',
                'data' => $rooms,
            ];
        } else {
            $dataResponse = [
                'messages' => 'fail',
            ];
        }

        return response()->json($dataResponse, 200);
    }

    public function markAsReturn(Request $request, $id)
    {
        $invoice = $this->invoiceRepository->findOrFail($id);
        if (is_null($invoice)) {
            $dataResponse = [
                'messages' => 'not_found',
            ];
        } else {
            $invoiceRoom = $invoice->rooms->first()->pivot;
            $invoiceRoom->update(['status' => $request->status]);
            $dataResponse = [
                'data' => $id,
                'messages' => 'success'
            ];
        }

        return response()->json($dataResponse, 200);
    }
}
