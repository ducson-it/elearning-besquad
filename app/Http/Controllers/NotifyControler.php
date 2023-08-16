<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotifycationRequest;
use App\Http\Requests\UserRequest;
use App\Models\Notification;
use App\Models\Notifycation_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotifyControler extends Controller
{
    public function showNotify(Request $request){
            $search = $request->input('search_notify');
            $notifycations  = Notification::where('title', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->paginate(8);

        return view('notifycations.list',compact('notifycations','search'));
    }
   public function addNotify(){
       $list_users = User::with('role')->Where('role_id', '<>', 1)->get();
       return view('notifycations.create', compact('list_users'));
   }
    public function storeNotify(NotifycationRequest $request)
    {
//        if ($request->option === 'option2' && $request->has('group_user')) {
//            $send_to = 'group_users';
//            $userIds = $request->group_user;
//        }

        if ($request->option === 'system') {
            $send_to = 'system';
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content_notify,
            'priority' => $request->priority,
            'expired' => $request->expired,
            'send_to'=> $send_to,
            'send_user'=> 'admin'
        ];

        try {
            $notify = Notification::create($data);
         //  dd($userIds);
            // Kiểm tra giá trị của option
                return redirect()->route('show.notify')->with('message', 'Đã tạo thông báo thành công');
//            if ($userIds &&  $send_to == 'group_users' ) {
//                foreach ($userIds as $key => $userId) {
//                    Notifycation_user::create([
//                        'notifycation_id' => $notify->id,
//                        'user_id' => $userId,
//                    ]);
//                }
//                return redirect()->route('show.notify')->with('success', 'Đã tạo thông báo thành công');
//            }


        } catch (\Exception $e) {
            Log::error("Lưu message lỗi: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo thông báo thất bại');
        }
    }
    public function deleteNotify($id)
    {
        $notify =  Notification::find($id);


        if ($notify) {
            Notification::find($id)->delete();
            if($notify->send_to == 'system'){
                return redirect('/notify/list')->with('message', 'Xóa thành công thông báo toàn hệ thống');
            }
            if($notify->send_to == 'group_users'){
                Notifycation_user::where('notifycation_id',$notify->id)->delete();
                return redirect('/notify/list')->with('message', 'Xóa thành công thông báo cho nhóm user');
            }
        } else {
            return redirect('/notify/list')->with('message', 'Xóa thất bại');
        }

    }
    public function deleteCheckbox(Request $request)
    {

        $selectedIds = $request->input('selectedIds');

        if ($selectedIds && is_array($selectedIds)) {
            // Xóa các bản ghi có ID nằm trong danh sách đã chọn
            Notification::whereIn('id', $selectedIds)->delete();

            // Trả về phản hồi cho giao diện
            return response()->json(['success' => true]);
        } else {
            // Trả về phản hồi lỗi khi selectedIds không hợp lệ
            return response()->json(['error' => 'Invalid selectedIds'], 400);
        }
    }
    public function editNotify($id){
        $notify = Notification::find($id);
        return view('notifycations.edit',compact('notify'));
    }
    public function updateNotify(NotifycationRequest $request, $id)
    {
        $notify = Notification::find($id);

        if ($notify) {
            $data = [
                'title' => $request->input('title'),
                'content' => $request->input('content_notify'),
                'priority' => $request->input('priority'),
                'expired' => $request->input('expired'),
            ];
            if ($notify->update($data)) {
                // Lưu category vào cơ sở dữ liệu
                return redirect()->route('show.notify')->with('message', 'Cập nhật thông báo thành công');
            } else {
                return redirect()->back()->with('message', 'Cập nhật thông báo thất bại');
            }
        } else {
            return redirect()->route('show.notify')->with('message', 'Không tồn tại bản ghi hợp lệ');
        }
    }
    public function getNoicePage(Request $request){
        $listNotifys = Notification::where('send_user','<>','admin')->Where('is_read','<>',true)->paginate(10);
        $search = '';
        if($request->input('search_notice')){
            $search = $request->input('search_notice');
            $listNotifys = Notification::where('send_user','<>','admin')
                ->Where('is_read','<>',true)
                ->where('title', 'LIKE', '%'.$search.'%')
                ->paginate(10);
        }
        return view('notifycations.notice_page',compact('listNotifys','search'));
    }
    public function updateIreadNotify($id)
    {
        $notify = Notification::find($id);
        if ($notify) {
            $notify->is_read = true;
            $notify->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Notify not found.']);
        }
    }
}
