<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoices\StoreRequest;
use App\Models\ListRoomNumber;
use App\Models\Room;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Room\RoomRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class InvoiceController extends Controller
{
    private $invoiceRepository;
    private $roomRepository;
    private $baseLang;

    public function __construct(InvoiceRepository $invoiceRepository, RoomRepository $roomRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->roomRepository = $roomRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $invoices = $this->invoiceRepository->getAll($keyword);
        $data = compact(
            'invoices'
        );

        return view('admin.invoices.index', $data);
    }

    public function create()
    {
        $rooms = $this->roomRepository->all();
        $data = compact(
            'rooms'
        );

        return view('admin.invoices.create', $data);
    }

    public function getAvailableRoomNumbers(Request $request, $id)
    {
        $room = $this->roomRepository->find($id);
        $checkIn = Carbon::parse($request->checkIn);
        $checkOut = Carbon::parse($request->checkOut);

        if (!$room) {
            $dataRespone = [
                'messages' => 'not_found',
            ];
        } else {
            $numbers = $this->roomRepository->availableTimeByRoom($room, $checkIn, $checkOut);
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
            $this->roomRepository->updateAvailableTime($data['room_id'], $data['check_in_date'], $data['check_out_date'], $data['room_number']);
            $this->invoiceRepository->storeData($data);
            DB::commit();
            $request->session()->flash('success', 'Tạo hóa đơn thành công');

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
            $room->name = $room->roomDetails()->where('lang_parent_id', 0)->first()->name;
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
}
