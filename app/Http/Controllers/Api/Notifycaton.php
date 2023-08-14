<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class Notifycaton extends Controller
{
    //
   public function getNotifys(){
       $notifys = Notification::Where('send_user','admin')->orderBy('id', 'desc')->get();
       return response()->json($notifys);
   }

}
