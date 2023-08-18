<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckOderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $oder_code;
    public $time;
    public $user_name;
    public $price;
    public function __construct($oder_code, $time,$user_name,$price)
    {
        //
        $this->oder_code = $oder_code;
        $this->time = $time;
        $this->user_name = $user_name;
        $this->price = $price;
        // dưới đây là cách để gửi mail bỏ vào api.
//        Mail::to('admin@example.com')->send(new CheckOrderMail($course_name, $time, $user_name, $price));
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Thông báo về 1 đơn hàng mua khóa đã được thanh toán',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.check_oder',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
