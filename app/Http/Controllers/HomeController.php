<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //Get 5 recent order
        $recent_orders = Order::with('user', 'course')->latest()->limit(5)->get();
        $order = Order::first();
        //sum total earning
        $total_earning = Order::where('status', 1)->sum('amount');

        //sum total earning in day
        $total_earning_day = Order::whereDate('created_at', Carbon::today())
            ->sum('amount');
        //count order in day
        $order_count_day = Order::with(['course'])
            ->whereHas('course', function ($q) {
                $q->where('is_free', 1);
            })
            ->whereDate('created_at', Carbon::today())
            ->count();
        //calculate order day growth rate
        $order_count_preDay = Order::with(['course'])
            ->whereHas('course', function ($q) {
                $q->where('is_free', 1);
            })
            ->whereDate('created_at', Carbon::yesterday())
            ->count();
        if($order_count_preDay == 0){
            $order_growth_rate =  round(($order_count_day - $order_count_preDay) * 100, 2);
        }else{
            $order_growth_rate =  round(($order_count_day - $order_count_preDay) * 100 / $order_count_preDay, 2);
        }
        //count user active in day
        $users_count_day = User::where('role_id',2)
            ->whereDate('created_at', Carbon::today())
            ->count();
        //calculate user day growth rate
        $users_count_preDay = User::where('role_id',2)
            ->whereDate('created_at', Carbon::yesterday())
            ->count();
        if( $users_count_preDay == 0){
            $users_growth_rate = round(($users_count_day - $users_count_preDay) * 100, 2);
        }else{
            $users_growth_rate = round(($users_count_day - $users_count_preDay) * 100 / $users_count_preDay, 2);
        }
        return view('home', compact
        ('recent_orders', 'total_earning_day', 'order_count_day', 'order_count_preDay', 'order_growth_rate',
        'users_count_day','users_growth_rate'
        ));
    }
}
