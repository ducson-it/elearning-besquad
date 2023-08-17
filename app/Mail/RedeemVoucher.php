<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RedeemVoucher extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $userName;
    public $voucherCode;
    public $voucherName;
    public $discountPercentage;
    public $remainingPoints;
    public function __construct($userName, $voucherCode, $voucherName, $discountPercentage, $remainingPoints)
    {
        //
        $this->userName = $userName;
        $this->voucherCode = $voucherCode;
        $this->voucherName = $voucherName;
        $this->discountPercentage = $discountPercentage;
        $this->remainingPoints = $remainingPoints;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Thông báo đã đổi voucher thành công từ point của bạn.',
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
            view: 'emails.redeem_voucher',
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
