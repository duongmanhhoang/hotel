<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Room\RoomRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BookingController extends Controller
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        Redis::connection();
        $this->roomRepository = $roomRepository;
    }

    public function redirectBooking(Request $request)
    {

        $data = $request->except('_token');

        if (Redis::exists('bookingData')) {
            Redis::del('bookingData');
        }

        if (!$data['checkIn'] || !$data['checkOut']) {
            dd(1);
            $request->session()->flash('error', __('messages.Booking_missing_requirement'));

            return redirect()->back();
        }

        $data['checkIn'] = Carbon::parse($data['checkIn'])->format('d-m-Y');
        $data['checkOut'] = Carbon::parse($data['checkOut'])->format('d-m-Y');
        Redis::set('bookingData', json_encode($data));

        return redirect(route('booking.index'));
    }

    public function index(Request $request)
    {
        if (!Redis::exists('bookingData')) {
            $request->session()->flash('error', __('messages.Booking_missing_requirement'));

            return redirect()->back();
        }

        $bookingData = json_decode(Redis::get('bookingData'), true);
        $data = $this->roomRepository->getRoomForBooking($bookingData['roomId']);
        $data = array_merge($data, $bookingData);

        return view('client.booking.index', $data);
    }
}
