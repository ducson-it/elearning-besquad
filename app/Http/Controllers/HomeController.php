<?php

namespace App\Http\Controllers;

use App\Models\Beesquad;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Laravel\Ui\Presets\React;

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
        $total_earning = Order::where('status', Beesquad::TRUE)->sum('amount');

        //sum total earning in day
        $total_earning_day = Order::whereDate('created_at', Carbon::today())
            ->sum('amount');
        //count order in day
        $order_count_day = Order::with(['course'])
            ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at', Carbon::today())
            ->count();
        //calculate order day growth rate
        $order_count_preDay = Order::with(['course'])
            ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::TRUE);
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
        //total number of courses
        $total_number_courses = Course::count();
        //statistic business
        $order_all  = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->count();
        $order_payment = Order::with(['course'])
        ->whereHas('course', function ($q) {
        $q->where('is_free', Beesquad::TRUE);
        })
        ->where('status',Beesquad::DONE)
        ->count();
        $revenue_all = Order::sum('amount');
        $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
        })
            ->where('status',Beesquad::CANCEL)
            ->count();
        if($order_all == 0){
            $conversion_rate = round($order_payment*100,2);
        }else{
            $conversion_rate = round($order_payment*100/$order_all,2);
        }
        //top 5 course bestseller
        $top5_bestseller_courses = Course::where('is_free',Beesquad::TRUE)->withCount('orders')->withSum('orders','amount')->orderBy('orders_count','desc')->limit(5)->get();
        return view('home', compact
        ('recent_orders', 'total_earning_day', 'order_count_day', 'order_count_preDay', 'order_growth_rate',
        'users_count_day','users_growth_rate','total_number_courses','order_all','revenue_all','order_cancel',
        'conversion_rate','top5_bestseller_courses'
        ));
    }
    public function statistic(Request $request)
    {
        $time = $request->time;
        //statistic in month
        if($time == 1){
            $preMonth = Carbon::now()->subMonth();
            $order_all = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->count();

            $order_payment = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->where('status',Beesquad::DONE)
            ->count();

            $revenue_all = Order::where('created_at','>=',$preMonth)->sum('amount');
            $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->where('status',Beesquad::CANCEL)
            ->count();
            if($order_all == 0){
                $conversion_rate = round($order_payment*100,2);
            }else{
                $conversion_rate = round($order_payment*100/$order_all,2);
            }
        }
        //statistic in 6 month
        if($time ==6)
        {
            $preSixMonth = Carbon::now()->subMonth(6);
            $order_all = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->count();

            $order_payment = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->where('status',Beesquad::DONE)
            ->count();

            $revenue_all = Order::where('created_at','>=',$preSixMonth )->sum('amount');
            $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->where('status',Beesquad::CANCEL)
            ->count();
            if($order_all == 0){
                $conversion_rate = round($order_payment*100,2);
            }else{
                $conversion_rate = round($order_payment*100/$order_all,2);
            }
        }
        //statistic in a year
        if($time == 12)
        {
            $preYear = Carbon::now()->subMonth(12);
            $order_all = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->count();

            $order_payment = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->where('status',Beesquad::DONE)
            ->count();

            $revenue_all = Order::where('created_at','>=',$preYear )->sum('amount');
            $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->where('status',Beesquad::CANCEL)
            ->count();
            if($order_all == 0){
                $conversion_rate = round($order_payment*100,2);
            }else{
                $conversion_rate = round($order_payment*100/$order_all,2);
            }
        }
        //statistic all
        if($time == 0)
        {
            $order_all  = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
            })
            ->count();
        $order_payment = Order::with(['course'])
        ->whereHas('course', function ($q) {
        $q->where('is_free', Beesquad::TRUE);
        })
        ->where('status',Beesquad::DONE)
        ->count();
        $revenue_all = Order::sum('amount');
        $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::TRUE);
        })
            ->where('status',Beesquad::CANCEL)
            ->count();
            if($order_all == 0){
                $conversion_rate = round($order_payment*100,2);
            }else{
                $conversion_rate = round($order_payment*100/$order_all,2);
            }
        }
        return response()->json([
            'status'=>true,
            'data'=>[
                'time'=>$time,
                'order_all'=>$order_all,
                'revenue_all'=>$revenue_all,
                'order_cancel'=>$order_cancel,
                'conversion_rate'=>$conversion_rate
            ]
        ],200);
    }
}
