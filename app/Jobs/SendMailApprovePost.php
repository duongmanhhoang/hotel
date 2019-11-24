<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailApprovePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        $data = $this->input;

        Mail::to($data->postedBy->email)->send(new \App\Mail\Posts\ApprovePost($data));
    }
}
