<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RoomInvoice;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Notification\NotificationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $invoiceRepository;
    private $notificationRepository;

    public function __construct(InvoiceRepository $invoiceRepository, NotificationRepository $notificationRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->notificationRepository = $notificationRepository;

    }

    public function mybooking()
    {
        $user = Auth::user();
        $user->load(['invoices.rooms.roomName.children']);
        $invoices = $this->invoiceRepository->makeDataMyBooking($user->invoices()->orderBy('id', 'desc')->paginate(config('common.pagination.default')));

        $data = compact(
            'user',
            'invoices'
        );

        return view('client.profile.mybooking', $data);
    }


    public function maskAsRead($id)
    {
        $now = Carbon::now()->toDateTimeString();
        $notifcation = $this->notificationRepository->find($id);
        $notifcation->update(['read_at' => $now]);

        return response()->json(['messages' => 'success'], 200);
    }

    public function maskAllRead()
    {
        $now = Carbon::now()->toDateTimeString();
        $user = Auth::user();
        $user->notifications()->where('read_at', null)->update(['read_at' => $now]);

        return response()->json(['messages' => 'success'], 200);
    }

    public function cancelBooking(Request $request, $id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $pivot = RoomInvoice::where('invoice_code', $invoice->code)->first();
        $pivot->update(['status' => RoomInvoice::CANCEL]);
        $request->session()->flash('success', __('messages.Cancel_booking_success'));

        return redirect()->back();
    }
}
