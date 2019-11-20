<?php

namespace App\Mail\Posts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovePost extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->input->message = $this->input->approve == 1
            ? "Bài viết <b>" . $this->input->title . '</b> của bạn đã được duyệt.'
            : "Bài viết <b>" . $this->input->title . '</b> của bạn đã bị từ chối với lí do: ' . $this->input->message_reject;

        return $this->with([
                        'data' => $this->input
                    ])
                    ->view('mail.approve_post');
    }
}
