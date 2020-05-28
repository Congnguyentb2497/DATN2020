<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Notification;
use App\Device;
use DB;
use Device_type;
use History_ktv;


class DoctorController extends Controller
{
    //
    public function index(){
        $notice = Notification::where('status','=',4)->orWhere('status',6)->orWhere('status',8)->orWhere('status',12)->paginate(10);
    	return view('doctor.home',['notices'=>$notice]);
    }

    public function showDev(Request $request, $id){
        $user = User::where('id',$id)->get();
        $dept = DB::table('department')->get();
        $devices = Device::where('status',1)->where('department_id','=',$user->department_id)->orderBy('id','desc');
        if($request->dv_name){
            $devices = $devices->where('dv_name','like','%'.$request->dv_name.'%');
        }
        $devices = $devices->paginate(8);
    	return view('doctor.listDevice',['devices'=>$devices,'user'=>$user,'depts'=>$dept]);
    }

     public function fixDev(Request $request, $id){
        $user = User::find($id);
        $devices = Device::where('status',2)->where('department_id','=',$user->department_id)->orderBy('id','desc');
        if($request->dv_name){
            $devices = $devices->where('dv_name','like','%'.$request->dv_name.'%');
        }
        $devices = $devices->paginate(5);
     	return view('doctor.listBroken',['devices'=>$devices,'user'=>$user]);
    }
    //báo điều chuyển thiết bị
     public function moveDev($id){
        $user = User::find($id);
        $dept = DB::table('department')->get();
        $devices = Device::where('status',1)->where('department_id','=',$user->department_id)->get();
        return view('doctor.moveDevice',['devices'=>$devices,'depts'=>$dept]);

    }
    // post thông tin chuyển thiết bị
    public function postMoveDev(Request $request, $id){
            $user = User::find($id);
            $notice = new Notification;
            $notice->req_date = $request->req_date;
            $notice->req_content = $request->reason;
            $notice->annunciator_id = $id;
            $notice->dept_now = $user->department_id;
            $notice->dept_next = $request->dept_name;
            $notice->dv_id= $request->dv_name;
            $notice->status = 2;
            $notice->save();
            return redirect()->route('doctor.home')->with('message','Đã gửi phiếu điều chuyển tới phòng vật tư.');

    }
    //báo hỏng thiết bị
    public function noticeDev(Request $request,$id){
        $d = $request->user_id;
        $notice = new Notification;
        $notice->req_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->req_content = $request->reason;
        $notice->dv_id = $request->dv_id;
        $notice->status = 0;
        $notice->annunciator_id = $request->user_id;
        $notice->save();
        $dev = Device::find($id);
        $dev->status = 2;
        $dev->department_id = $request->select_dept;
        $dev->save();
        return redirect()->route('doctor.actDevice',['id'=>$d])->with('message','Đã báo hỏng thiết bị thành công.');
    }

    //accept notice from ktv
    public function acceptNotice($id){
        $notice = Notification::find($id);
        if($notice->status == '4')
        {
        $notice->status = 5;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        }
        if($notice->status == '6')
        {
        $notice->status = 7;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        }
        if($notice->status == '8')
        {
        $notice->status = 9;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        }
        if($notice->status == '12')
        {
        $notice->status = 13;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận.";
        }
        $notice->save();
        return redirect()->route('doctor.home');
    }

    //lịch sử điều chuyển thiết bị
    //  public function historyMoveDev(){
    //  	return view('doctor.historyMoveDevice');
    // }
    //edit, reset Password,
     public function editDoctor($id){
     	$user = User::find($id);
     	return view('doctor.edit',compact('user'));
    }
     public function postEdit(Request $request, $id){
        $this->validate($request,
        [
            'phone' => 'min:10'
        ],
        [
            'phone.min'=>'Số điện thoại ít nhất 10 số!'
        ]);
       $user=User::find($id);
       $user ->fullname = $request->fullname;
       $user ->mobile = $request->phone;
       $user ->address = $request->address;
       $user->save();
        return redirect()->route('doctor.home')->with('message','Cập nhật thông tin thành công!');
    }
     public function getPsw($id){
     	$user = User::find($id);
     	return view('doctor.resetPsw',compact('user'));
    }

    public function postPsw(Request $request, $id){
        $user = User::find($id);
             $this->validate($request,
            [
                'new_psw' => 'different:current-psw',
                'repeat-psw' => 'same:new_psw',

             ],
             [
        'new_psw.regex'=>'Mật khẩu tối thiểu 6 và tối đa 20 kĩ tự, bao gồm chữ thường, chữ hoa và số ',
        'new_psw.different'=>'Mật khẩu mới phải khác mật khẩu cũ!',
        'repeat_psw.same'=>'Mật khẩu xác nhận không khớp!'
        ]);
            $user->password = Hash::make($request->new_psw);
            $user->save();
         return redirect()->route('doctor.home')->with('message','Cập nhật mật khẩu thành công!');
        
    }
}
