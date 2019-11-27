<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\RoomInvoice;
use App\Repositories\Invoice\InvoiceRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class changeStatusInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:change-status-invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status invoice';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        parent::__construct();
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $invoiceCodes = $this->invoiceRepository->getChangeStatusInvoice();
        DB::beginTransaction();
        try {
            RoomInvoice::whereIn('invoice_code', $invoiceCodes)->update(['status' => RoomInvoice::PAID_AND_RETURN]);
            Invoice::whereIn('code', $invoiceCodes)->update(['editable' => false]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
        }

    }
}
