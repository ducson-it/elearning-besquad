<?php

namespace App\Jobs;

use App\Mail\VoucherSystemMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendVoucherEmail
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $discount;
    protected $expired;
    protected $code;
    public function __construct($user,$code, $discount, $expired)
    {
        $this->user = $user;
        $this->discount = $discount;
        $this->expired = $expired;
        $this->code = $code;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
            Mail::to('hoangxuan27022001@gmail.com')->send(new VoucherSystemMail($this->user->name,$this->code, $this->discount, $this->expired));
        }
}
