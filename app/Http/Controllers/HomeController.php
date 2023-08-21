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
use Spatie\Permission\Models\Role;

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
                $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at', Carbon::today())
            ->count();
        //calculate order day growth rate
        $order_count_preDay = Order::with(['course'])
            ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at', Carbon::yesterday())
            ->count();
        if($order_count_preDay == 0){
            $order_growth_rate =  round(($order_count_day - $order_count_preDay) * 100, 2);
        }else{
            $order_growth_rate =  round(($order_count_day - $order_count_preDay) * 100 / $order_count_preDay, 2);
        }
        //count user active in day
        // $users_count_day = User::where('role_id',2)
        //     ->whereDate('created_at', Carbon::today())
        //     ->count();
            $users_count_day = Role::findById(2)->users()->whereDate('created_at', Carbon::today())->count();
        //calculate user day growth rate
        // $users_count_preDay = User::where('role_id',2)
        //     ->whereDate('created_at', Carbon::yesterday())
        //     ->count();
            $users_count_preDay =  Role::findById(2)->users()->whereDate('created_at', Carbon::yesterday())->count();
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
            $q->where('is_free', Beesquad::FALSE);
            })
            ->count();
        $order_payment = Order::with(['course'])
        ->whereHas('course', function ($q) {
        $q->where('is_free', Beesquad::FALSE);
        })
        ->where('status',Beesquad::DONE)
        ->count();
        $revenue_all = Order::sum('amount');
        $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
        })
            ->where('status',Beesquad::CANCEL)
            ->count();
        $order_complete= Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
        })
            ->where('status',Beesquad::DONE)
            ->count();
        if($order_all == 0){
            $conversion_rate = round($order_payment*100,2);
        }else{
            $conversion_rate = round($order_payment*100/$order_all,2);
        }
        //top 5 course bestseller
        $top5_bestseller_courses = Course::where('is_free',Beesquad::FALSE)->withCount('orders')->withSum('orders','amount')->orderBy('orders_count','desc')->limit(5)->get();
        return view('home', compact
        ('recent_orders', 'total_earning_day', 'order_count_day', 'order_count_preDay', 'order_growth_rate',
        'users_count_day','users_growth_rate','total_number_courses','order_all','revenue_all','order_cancel','order_complete',
        'conversion_rate','top5_bestseller_courses'
        ));
    }

    public function statistic(Request $request)
    {
        $time = $request->time;
        $monthList = [];
        $order_cancel_list = [];
        $order_complete_list = [];
        //statistic in 3 month
        if($time == 3){
            $preMonth = Carbon::now()->subMonth(3);
            $order_all = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->count();
            for($i = 3; $i >0 ; $i--){
                array_push($monthList,Carbon::now()->subMonth($i)->format('Y-m-d'));
                $order_cancel_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::now()->subMonth($i))
                ->whereDate('created_at','<=',Carbon::now()->subMonth($i-1))
                ->where('status',Beesquad::CANCEL)
                ->count();
                array_push($order_cancel_list,$order_cancel_preM);
                $order_complete_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::now()->subMonth($i))
                ->whereDate('created_at','<=',Carbon::now()->subMonth($i-1))
                ->where('status',Beesquad::DONE)
                ->count();
                array_push($order_complete_list,$order_complete_preM);
            }
            $order_payment = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->where('status',Beesquad::DONE)
            ->count();

            $revenue_all = Order::where('created_at','>=',$preMonth)->sum('amount');
            $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->where('status',Beesquad::CANCEL)
            ->count();
            $order_complete = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preMonth)
            ->where('status',Beesquad::DONE)
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
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->count();
            for($i = 6; $i >0 ; $i--){
                array_push($monthList,Carbon::now()->subMonth($i)->format('Y-m-d'));
                $order_cancel_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::now()->subMonth($i))
                ->whereDate('created_at','<=',Carbon::now()->subMonth($i-1))
                ->where('status',Beesquad::CANCEL)
                ->count();
                array_push($order_cancel_list,$order_cancel_preM);
                $order_complete_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::now()->subMonth($i))
                ->whereDate('created_at','<=',Carbon::now()->subMonth($i-1))
                ->where('status',Beesquad::DONE)
                ->count();
                array_push($order_complete_list,$order_complete_preM);
            }
            $order_payment = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->where('status',Beesquad::DONE)
            ->count();

            $revenue_all = Order::where('created_at','>=',$preSixMonth )->sum('amount');
            $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->where('status',Beesquad::CANCEL)
            ->count();
            $order_complete = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preSixMonth )
            ->where('status',Beesquad::DONE)
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
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->count();
            for($i = 12; $i >0 ; $i--){
                array_push($monthList,Carbon::now()->subMonth($i)->format('Y-m-d'));
                $order_cancel_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::now()->subMonth($i))
                ->whereDate('created_at','<=',Carbon::now()->subMonth($i-1))
                ->where('status',Beesquad::CANCEL)
                ->count();
                array_push($order_cancel_list,$order_cancel_preM);
                $order_complete_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::now()->subMonth($i))
                ->whereDate('created_at','<=',Carbon::now()->subMonth($i-1))
                ->where('status',Beesquad::DONE)
                ->count();
                array_push($order_complete_list,$order_complete_preM);
            }
            $order_payment = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->where('status',Beesquad::DONE)
            ->count();

            $revenue_all = Order::where('created_at','>=',$preYear )->sum('amount');
            $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->where('status',Beesquad::CANCEL)
            ->count();
            $order_complete = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
            })
            ->whereDate('created_at','>=',$preYear )
            ->where('status',Beesquad::DONE)
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
            $q->where('is_free', Beesquad::FALSE);
            })
            ->count();
            $order_done_all_count = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE)
            ->where('status',Beesquad::DONE);
            })
            ->count();
            $order_done_all = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE)
            ->where('status',Beesquad::DONE);
            })
            ->oldest();
            for($i = 0; $i > $order_done_all_count ; $i++){
                array_push($monthList,Carbon::create($order_done_all[$i]->created_at)->subMonth(1)->format('Y-m-d'));
                $order_cancel_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::create($order_done_all[$i]->created_at)->subMonth(1))
                ->whereDate('created_at','<=',Carbon::create($order_done_all[$i]->created_at))
                ->where('status',Beesquad::CANCEL)
                ->count();
                array_push($order_cancel_list,$order_cancel_preM);
                $order_complete_preM = Order::with(['course'])
                ->whereHas('course', function ($q) {
                $q->where('is_free', Beesquad::FALSE);
                })
                ->whereDate('created_at','>=',Carbon::create($order_done_all[$i]->created_at)->subMonth(1))
                ->whereDate('created_at','<=',Carbon::create($order_done_all[$i]->created_at))
                ->where('status',Beesquad::DONE)
                ->count();
                array_push($order_complete_list,$order_complete_preM);
            }
        $order_payment = Order::with(['course'])
        ->whereHas('course', function ($q) {
        $q->where('is_free', Beesquad::FALSE);
        })
        ->where('status',Beesquad::DONE)
        ->count();
        $revenue_all = Order::sum('amount');
        $order_cancel = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
        })
            ->where('status',Beesquad::CANCEL)
            ->count();
            $order_complete = Order::with(['course'])
            ->whereHas('course', function ($q) {
            $q->where('is_free', Beesquad::FALSE);
        })
            ->where('status',Beesquad::DONE)
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
                'order_complete'=>$order_complete,
                'conversion_rate'=>$conversion_rate,
                'monthList'=>$monthList,
                'order_cancel_list'=>$order_cancel_list,
                'order_complete_list'=>$order_complete_list
            ]
        ],200);
    }
    public function topCourse(Request $request){
        $course_type = $request->course_type;
        //top 5 course bestseller
        if(!$course_type){
            $top5_bestseller_courses = Course::where('is_free',Beesquad::FALSE)->withCount('orders')->withSum('orders','amount')->orderBy('orders_count','desc')->limit(5)->get();
        }else{
            $top5_bestseller_courses = Course::where('is_free',Beesquad::TRUE)->withCount('orders')->withSum('orders','amount')->orderBy('orders_count','desc')->limit(5)->get();

        }
        return response()->json($top5_bestseller_courses);
    }
}
