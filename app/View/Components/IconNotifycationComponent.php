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
        $this->countIsreadNotify = Notification::where('send_user','<>','admin')->count();
        $this->listNotifys = Notification::where('send_user', '<>', 'admin')->paginate(3);
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
