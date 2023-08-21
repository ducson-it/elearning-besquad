<?php

namespace App\View\Components;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class IconNotifycationComponent extends Component
{
    public $countIsreadNotify;
    public $listNotifys;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $currentDate = now();  // Lấy ngày hiện tại
        $this->countIsreadNotify = Notification::where('send_user', 'admin')
            ->where('expired', '>=', $currentDate)  // Lấy các thông báo có hạn sử dụng còn hiệu lực
            ->orderBy('id', 'desc')
            ->count();
        $this->listNotifys = Notification::where('send_user', 'admin')
            ->where('expired', '>=', $currentDate)  // Lấy các thông báo có hạn sử dụng còn hiệu lực
            ->orderBy('id', 'desc')
            ->paginate(5);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.icon-notifycation-component');
    }
}
