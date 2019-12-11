<?php

namespace App\Mail\Posts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeletePost extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input, $messageDelete)
    {
        $this->input = $input;
        $this->messageDelete = $messageDelete;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->input->message = 'Bài viết <b>' . $this->input['title'] . '</b> đã bị xóa với lí do: ' . $this->messageDelete;

        return $this->with([
            'data' => $this->input
            ])
            ->subject('Xóa bài viết')
            ->view('mail.approve_post');
    }
}
