<?php

namespace App\Jobs;

use App\Mail\Posts\DeletePost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailDeletePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $input;
    private $message;

    public function __construct($input, $message)
    {
        $this->input = $input;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->input;

        Mail::to($data->email)->send(new DeletePost($data, $this->message));
    }
}
