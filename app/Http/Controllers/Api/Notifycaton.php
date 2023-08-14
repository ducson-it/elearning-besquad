<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class Notifycaton extends Controller
{
    //
   public function getNotifys(){
       $currentDate = now();  // Lấy ngày hiện tại
       $notifys = Notification::where('send_user', 'admin')
           ->where('expired', '>=', $currentDate)  // Lấy các thông báo có hạn sử dụng còn hiệu lực
           ->orderBy('id', 'desc')
           ->get();
       return response()->json($notifys);
   }

}
