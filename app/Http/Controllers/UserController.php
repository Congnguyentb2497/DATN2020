<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Provider;
use App\Notification;
use App\Device;
use App\Device_type;
use App\Maintenance_schedule;
use App\Accessory;
use App\Device_accessory;
use App\Department;
use App\History_ktv;
class UserController extends Controller
{
    //ktv
    public function index(){
    	return view ('ktv.index');
    }

    public function notice(Request $request){
        $notices = DB::table('notification')->where('status',0)->orWhere('status',2)->paginate(8);
        return view('ktv.trangchu',['notices'=>$notices]);
    }
    public function getEditKTV($id){
    	$user=User::find($id);
      return view('ktv.editKtv')->with(['user'=>$user]);
  }

  public function postEditKTV(Request $request, $id){
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
   return redirect()->route('get.home')->with('message','Cập nhật thông tin thành công!');
}

public function getPswKTV($id){
   $user=User::find($id);
   return view('ktv.setPsw')->with(['user'=>$user]);
}

public function postPswKTV(Request $request, $id){
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
     return redirect()->route('get.home')->with('message','Cập nhật mật khẩu thành công!');

}
//accept notice biến cần tuyền từ route sang theo đúng thứ tự $user_id, $id, $dv_id, $status
public function acceptNotice( $user_id, $id, $dv_id, $status){
    $notice = Notification::find($id);
    $dep_now = Department::where(['id'=>$notice->dept_now])->pluck('department_name')->first();
    $dep_next = Department::where(['id'=>$notice->dept_next])->pluck('department_name')->first();
    $device = DB::table('device')->where('id','=',$dv_id)->first();
    if((int)$status == 0)
    {
        $notice->status = 1;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận thông báo hỏng";
        $notice->save();
        $response = new Notification;
        $response->req_date = Carbon::now('Asia/Ho_Chi_Minh');
        $response->req_content = "Đã xác nhận thông báo hỏng thiết bị.";
        $response->status = 4;
        $response->dv_id = $dv_id;
        $response->annunciator_id = $user_id;
        $response->save();
    }
    if((int)$status == 2)
    {
        // xác nhận thông báo
        $notice->status = 3;
        $notice->res_date = Carbon::now('Asia/Ho_Chi_Minh');
        $notice->res_content = "Đã xác nhận điều chuyển thiết bị";
        $notice->save();

        //tạo thông báo gửi phòng đã điều chuyển
        $response = new Notification;
        $response->req_date =Carbon::now('Asia/Ho_Chi_Minh');
        $response->req_content = "Đồng ý điều chuyển thiết bị.";
        $response->status = 6;
        $response->dv_id = $dv_id;
        $response->annunciator_id = $user_id;
        $response->save();

        // tạo thông báo gửi phòng nhận điều chuyển
        // $receive = new Notification;
        // $receive->req_date = $notice->res_date;
        // $dept_new = Department::where(['id' =>$dept_next])->pluck('department_name')->first();
        // $receive->req_content = 'Thiết thiết bị '.$device->dv_name.' sẽ được điều chuyển từ khoa '.$dep_now.' tới khoa '.$dep_new;
        // $receive->annunciator_id = $user_id;
        // $receive->dv_id = $dv_id;
        // $receive->status = 8;
        // $receive->save();

        //điều chuyển thiết bị về trang thái chưa bàn giao
         Device::where('id','=',$dv_id)->update(['status'=>0]);
        
    }
    return redirect()->route('get.home');
}

    //provider


public function showProvider(Request $request){
  $provider =  DB::table('provider');
  if($request->searchName)
  {
    $provider = $provider->where('provider_name','like','%'.$request->searchName.'%');
}
if($request->searchEmail)
{
    $provider = $provider->where('email','like','%'.$request->searchEmail.'%');
}
$provider = $provider->paginate(7);  
return view('ktv.provider.list', ['providers' => $provider]);
}

public function getEditProvider($id){
  $provider = Provider::find($id);
  return view('ktv.provider.edit',compact('provider'));
}

public function postEditProvider(Request $request, $id){
  $provider = Provider::find($id);
  $this->validate($request,[
      'email'=>'email',
  ],[
   'email.email'=>'Email không đúng định dạng!'
]);
  $provider->provider_name = $request->nameProvider;
  $provider->address = $request->address;
  $provider->representator = $request->representator;
  $provider->mobile = $request->phone;
  $provider->email = $request->email;
  $provider->save();
  return redirect()->route('show.provider')->with(['message'=>'Cập nhật thành công!','provider'=>$provider]);
}

public function getAddProvider(){
   return view('ktv.provider.add');
}

public function postAddProvider(Request $request){
   $this->validate($request,[
      'nameProvider' => 'required|unique:provider,provider_name',
  ],[
      'nameProvider.required' => 'Tên nhà cung cấp chưa được nhập.',
      'nameProvider.unique' => 'Nhà cung cấp này đã tồn tại, vui lòng kiểm tra danh sách nhà cung cấp.'
  ]);
   $provider = new Provider;
   $provider->provider_name = $request->nameProvider;
   $provider->address = $request->address;
   $provider->representator = $request->representator;
   $provider->mobile = $request->phone;
   $provider->email = $request->email;
   $provider->save();
   return redirect()->route('show.provider')->with(['message'=>'Thêm nhà cung cấp thành công.','provider'=>$provider]);
}

public function deleteProvider($id){
 $provider = Provider::findOrFail($id);
 $provider->delete();    
 return redirect()->route('show.provider')->with(['message'=>'Xóa một người dùng thành công','provider'=>$provider]);
}
    //Device
    //list device not used status=0
public function showDevice0(Request $request){
    $devices = Device::where('status', 0)->orderBy('id','desc');
    $dv_types = Device::where('status', 0)->select('dv_type_id')->groupBy('dv_type_id')->get();
    $dept = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->dv_type_id)
    {
        $devices = $devices->where('dv_type_id', '=', $request->dv_type_id);
    }

    $devices = $devices->paginate(10);

    return view('ktv.device.list0', ['devices'=>$devices,'dv_types'=>$dv_types,'depts'=>$dept,'providers'=>$provider]);
}
    //list device used status =1
public function showDevice1(Request $request){
    $devices = Device::where('status', 1)->orderBy('id','desc');
    $dept = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->department_id)
    {
        $devices = $devices->where('department_id', '=', $request->department_id);
    }

    $devices = $devices->paginate(8);
    return view('ktv.device.list1',['devices'=>$devices,'providers'=>$provider,'depts'=>$dept]);

}
    //list device broken status=2
public function showDevice2(Request $request){
    $devices = Device::where('status', 2)->orderBy('id','desc');
    $department = DB::table('department')->get();
    $dv_type = DB::table('device_type')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->dv_type_id)
    {
        $devices = $devices->where('dv_type_id', '=', $request->dv_type_id);
    }
    $devices = $devices->paginate(8);
    return view('ktv.device.list2',['devices'=>$devices, 'depts' => $department,'dv_types'=>$dv_type]);
}
    //device fixing
public function showDevice3(Request $request) {
    $dept = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    $device = Device::where('status',3)->orderBy('id','desc');
    if($request->dv_name)
    {

        $device = $device->where('dv_name','like','%'.$request->dv_name.'%');
    }
    if($request->provider_id)
    {
        $device  = $device->where('provider_id', '=', $request->provider_id);
    }
    if($request->department_id)
    {
        $device = $device->where('department_id', '=', $request->department_id);
    }
    $device = $device->paginate(8);
    return view('ktv.device.list3',['devices'=>$device,'departments'=>$dept,'providers'=>$provider]);
}

    //device stop used

public function scheduleRepair(Request $request, $id){
    $device = Device::find($id);
    $device->status = 3;
    $device->save();
    $schedule = new Maintenance_schedule;
    $schedule->schedule_date = $request->fix_date;
    $schedule->dv_id = $id;
    $schedule->repair_responsible = $request->name_repair;
    $schedule->information = $request->infor_repair;
    $schedule->status = 0;
    $schedule->save();
    //code them ngay 20-5 lich su thiet bi
    $his = new History_ktv;
    $his->time = $request->fix_date;
    $his->action = 'Tạo lịch sửa chữa';
    $his->dv_id = $id;
    $his->status = 'of';//of = order-fix
    $his->implementer = 'Phòng vật tư';
    $his->save();
    return redirect()->route('device.show2')->with('message', 'Đã tạo lịch sửa chữa thành công cho thiết bị '.$device->dv_name);
}
    // edit schedule
public function editSchedule(Request $request, $id){
    $schedule = Maintenance_schedule::find($id);
    if($request->schedule_date){
        $schedule->schedule_date = $request->schedule_date; 
    }
    if($request->name_repair){
        $schedule->repair_responsible = $request->name_repair;                
    }
    if($request->information){
        $schedule->information = $request->information;                
    }
    $schedule->save();
    return redirect()->route('device.show3')->with('message','Cập nhật thành công');
}
    //update status device
public function updateStatus(Request $request, $id){
    $device = Device::find($id);
    $his = new History_ktv;
    $his->dv_id = $id;
    $his->time = $request->update_time;
    if($request->status == '0'){
        $device->status = 1;
        $history = Maintenance_schedule::where('status',0)->where('dv_id',$id)->first();
        $history->status = 1;
        $history->proceed_date = $request->update_time;
        $history->note = $request->note;
        //tạo lịch sử tb
        $his->action = 'Đã sửa chữa thành công';
        $his->status = 'sf';//sf = success fix

    }
    if($request->status == '4'){
        $device->status = 4;
        $history = Maintenance_schedule::where('status',0)->where('dv_id',$id)->first();
        $history->status = 2;
        $history->proceed_date = $request->update_time;
        $history->note = $request->note;
        $his->action = 'Không thể sửa chữa, chuyển vào kho thanh lý';
        $his->status = 'ff';//ff = faile fix
        $his->implementer = 'Phòng vật tư';
    }
    $device->save();
    $history->save();
    $his->save();
    return redirect()->route('device.show3')->with('message','Cập nhật trạng thái thiết bị thành công');
}

    // device stop used
public function showDevice4(Request $request) {
    $devices = Device::where('status',4)->orderBy('id','desc');
    $dep = DB::table('department')->get();
    $provider = DB::table('provider')->get();
    if($request->dv_name)
    {
        $devices = $devices->where('dv_name', 'like', '%'.$request->dv_name.'%');
    }
    if($request->provider_id)
    {
        $devices = $devices->where('provider_id', '=', $request->provider_id);
    }
    if($request->department_id)
    {
        $devices = $devices->where('department_id', '=', $request->department_id);
    }
    $devices = $devices->paginate(8);
    return view('ktv.device.list4',['devices'=>$devices,'depts'=>$dep,'providers'=>$provider]);

}
    //add device
public function getAddDevice(){
    $dv_types = DB::table('device_type')->get();
    $provider = DB::table('provider')->get();
    return view('ktv.device.add',['dv_types'=>$dv_types,'providers'=>$provider]);
}

public function postAddDevice(Request $request){
    $this->validate($request,[
        'name_device' => 'required|unique:device,dv_name',
        'amount' => 'numeric'
    ],[
        'name_device.required' => 'Bạn phải nhập tên thiết bị',
        'name_device.unique' => 'Thiết bị đã tồn tại, vui lòng kiểm tra lại danh sách thiết bị',
        'amount.numeric'=>'Số lượng phải là số tự nhiên'
    ]);
    $device = new Device;
    $device->dv_name = $request->name_device;
    $device->dv_model = $request->model;
    $device->dv_serial = $request->serial;
    $device->dv_type_id = $request->device_type;
    $device->manufacturer = $request->produce;
    $device->produce_date = $request->produce_date;
    $device->import_id = $request->import_id;
    $device->import_date = $request->import_date;
    $device->expire_date = $request->handover_date;
    $device->price = $request->price;
    $device->country = $request->country;
    $device->provider_id = $request->provider;
    $device->license_number = $request->license_number;
    $device->license_number_date = $request->license_number_date;
    $device->maintain_date = $request->maintain_date;
    $device->status = 0;
    $device->save();
    $dv = DB::table('device')->where('dv_name',$request->name_device)->get();
    //tạo lịch sử nhập mới thiết bị
    $his = new History_ktv;
    $his->status = 'sadv'; //sadv = success add DV
    $his->action = 'Nhập mới thiết bị '.$request->name_device;
    
    $his->time = date('Y-m-d');
    $his->implementer = 'Phòng vật tư';
    $his->save();
    return redirect()->route('device.show0')->with('message','Thêm thiết bị thành công');
}
    // move device
public function moveDevice(Request $request, $id)
{  
    $dep = $request->select_dept;
    $dep_name = Department::where(['id' => $dep])->pluck('department_name')->first();
    $device = Device::find($id);
    $dep_now = Department::where(['id' => $device->department_id])->pluck('department_name')->first();
    $name = $device->dv_name;
    $device->status = 1;
    $device->department_id = $request->select_dept;
    $device->handover_date = date('Y-m-d H:i:s');
    $device->save();
    $notice = new Notification;
    $notice->req_content = "Phòng vật tư xác nhận điều chuyển thiết bị ".$name."cho khoa ".$dep_name;
    $notice->dv_id = $id;
    $notice->dept_now = $request->select_dept;
    $notice->status = 12;
    $notice->save();
    //tạo lịch sử điều chuyển
    $his =new History_ktv;
    $his->status = 'mdv'; //mdv = move device
    $his->action = 'Thiết bị được điều chuyển từ khoa '.$dep_now.' sang khoa '.$dep_name;
    $his->time = date('Y-m-d');
    $his->dv_id = $id;
    $his->implementer = 'Phòng vật tư';
    $his->save();
    return redirect()->route('device.show0')->with('message','Đã bàn giao thiết bị thành công');
}
    //getEditDevice
public function getEditDevice($id){
    $dev = Device::find($id);
    $provider = DB::table('provider')->get();
    $dv_types = DB::table('device_type')->get();
    $accs = DB::table('device_accessory')->where('dv_id',$id)->get();
    $history = DB::table('mainten_schedule')->where('dv_id',$id)->get();
    return view('ktv.device.edit',['dev'=>$dev,'dv_types'=>$dv_types,'providers'=>$provider,'accs'=>$accs,'hiss'=>$history]);
}

public function postEditDevice(Request $request,$id){
    $device = Device::find($id);
    $device->dv_name = $request->name_device;
    $device->dv_model = $request->model;
    $device->dv_serial = $request->serial;
    $device->dv_type_id = $request->device_type;
    $device->manufacturer = $request->produce;
    $device->produce_date = $request->produce_date;
    $device->import_id = $request->import_id;
    $device->import_date = $request->import_date;
    $device->expire_date = $request->expire_date;
    $device->price = $request->price;
    $device->country = $request->country;
    $device->provider_id = $request->provider;
    $device->license_number = $request->license_number;
    $device->license_number_date = $request->license_number_date;
    $device->maintain_date = $request->maintain_date;
    $device->save();
    return redirect()->route('device.show0')->with('message','Cập nhật thông tin thiết bị thành công');
}
public function delDevice($id){
    $device = Device::findOrFail($id);
    if($device->status == 0){
        $device->delete();    
        return redirect()->route('device.show0')->with('message','Đã xóa một loại thiết bị ');
    }elseif ($device->status == 1) {
        $device->delete();    
        return redirect()->route('device.show1')->with('message','Đã xóa một loại thiết bị ');
    }else
    {
        $device->delete();    
        return redirect()->route('device.show2')->with('message','Đã xóa một loại thiết bị ');
    }

}
// bàn giao vật tư
public function accessoryDevice(Request $request, $id){
    $acc = Accessory::find($id);
    $used = $acc->used;
    $sl = strval($acc->amount - $acc->used);
    $amount = (int)$request->amount;
    if($amount <1){
          return redirect()->route('accessory.show')->with(['message'=>'Số lượng vật tư tối thiểu là 1,vui lòng chọn lại số lượng']);
    }
    elseif($amount > $sl){
        return redirect()->route('accessory.show')->with(['message'=>'Số lượng vật tư hiện tại ít hơn '.$amount.',vui lòng kiểm tra lại thông tin vật tư']);
    }else
    {   
        $acc->used =$used +$amount;
        $acc->save();

        $dv_acc = new Device_accessory;
        $dv_acc->dv_id = $request->dv_id;
        $dv_acc->acc_id = $id;
        $dv_acc->amount = $request->amount;
        $dv_acc->export_date = $request->export_date;
        $dv_acc->save();
        //tạo lịch sử tb
        $his = new History_ktv;
        $his->action = 'Bàn giao vật tư '.$acc->acc_name.' cho thiết bị ';
        $his->status = 'gacc';//gacc = give accessory
        $his->time = $request->export_date;
        $his->dv_id = $request->dv_id;
        $his->implementer = 'Phòng vật tư';
        $his->save();
        return redirect()->route('accessory.show')->with(['message'=>'Bàn giao vật tư thành công!']);
    }
}
     // show history device
public function historyDevice($id){
    $his = DB::table('mainten_schedule')->where('dv_id',$id)->get();
    $dep = Device::find($id);
    return view('ktv.device.history',['his'=>$his,'device'=>$dep]);
}

    //device_type

public function showDvType(Request $request){
    $dv_type = DB::table('device_type');
    if($request->searchName)
    {
        $dv_type = $dv_type->where('dv_type_name', 'like' , '%'.$request->searchName.'%');
    }
    if($request->dv_group)
    {
        $dv_type = $dv_type->where('dv_group', '=',$request->dv_group);
    }
    $dv_type = $dv_type->paginate(8);
    return view('ktv.device_type.list',['dv_types'=>$dv_type]);
}

public function getAddDvType(){
    return view('ktv.device_type.add');
}

public function postAddDvType(Request $request){
    $this->validate($request,[
        'nameDvt' => 'required|unique:device_type,dv_type_name',
        'dv_group' => 'required'
    ],[
        'nameDvt.required' => 'Bạn chưa nhập tên loại thiết bị',
        'nameDvt.unique' => 'Tên thiết bị đã tồn tại, vui lòng kiểm tra lại',
        'dv_group.required' => 'Bạn chưa phân loại nhóm thiết bị'
    ]);
    $dv_types = new Device_type;
    $dv_types->dv_type_name = $request->nameDvt;
    $dv_types->dv_group = $request->dv_group;
    $dv_types->dv_code = $request->dv_code;
    $dv_types->save();
    return redirect()->route('dvtype.show')->with('message','Thêm thành công loại thiết bị '.$request->nameDvt);
}

public function getEditDvType($id){
    $dv_type = Device_type::find($id);
    return view('ktv.device_type.edit',compact('dv_type'));
}

public function postEditDvType(Request $request, $id){
    $this->validate($request,[
        'dv_group' => 'required'
    ],[
        'dv_group.required' => 'Bạn chưa phân loại nhóm thiết bị.'
    ]);
    $dv_types = Device_type::find($id);
    $dv_types->dv_type_name = $request->nameDvt;
    $dv_types->dv_group = $request->dv_group;
    $dv_types->save();
    return redirect()->route('dvtype.show')->with('message','Cập nhật thông tin loại thiết bị thành công.');
}

public function deleteDvType($id){
    $dv_types = Device_type::findOrFail($id);
    $dv_types->delete();    
    return redirect()->route('dvtype.show')->with('message','Đã xóa một loại thiết bị ');
}

    //accessory
public function showAcc(Request $request){
    $acc = DB::table('accessory');
    $prov = DB::table('provider')->get();
    $devs = DB::table('device')->where('status',0)->orWhere('status',1)->get();
    if($request->acc_name){
        $acc = $acc->where('acc_name','like','%'.$request->acc_name.'%');
    }
    if($request->provider_id){
        $acc = $acc->where('provider_id','=', $request->provider_id);
    }
    $acc = $acc->paginate(10);
    return view('ktv.accessory.list',['accs'=>$acc,'providers'=>$prov,'devs'=>$devs]);

}

public function addAcc(){
    $prov = DB::table('provider')->get();
    return view('ktv.accessory.add',['providers'=>$prov]);
}
//thêm số lượng vật tư đã có
public function plusAcc(Request $request, $id, $user_id){

    $acc = Accessory::find($id);
    $amount =(int)$request->amount;
    $now =$acc->amount + $amount;
    $acc->amount = $now;
    $acc->save();
    $his = new History_ktv;
    $his->time = $request->import_date;
    $his->action = "Nhập thêm số lượng vật tư";
    $his->acc_id =(int)$id;
    $his->implementer = (int)$user_id;
    $his->status = 'acc';
    $his->save();
    return redirect()->route('accessory.show')->with('message','Thêm thành công.');
}

public function postAddAcc(Request $request){
    $this->validate($request,[
        'accName'=> 'unique:accessory,acc_name',
        'amount' => 'numeric',
    ],[
        'accName.unique' =>'Vật tư này đã tồn tại, vui lòng kiểm tra lại',
        'amount.numeric' => 'Chỉ nhập số tự nhiên cho trường Số lượng'
    ]);
    $acc = new Accessory;
    $acc->acc_name    = $request->accName;
    $acc->provider_id = $request->provider_id;
    $acc->amount      = $request->amount;
    $acc->import_date = $request->importDate;
    $acc->unit        = $request->unit;
    $acc->save();
    return redirect()->route('accessory.show')->with('Thêm mới vật tư thành công');
}
public function getEditAcc($id){
    $acc = Accessory::find($id);
    $prov = DB::table('provider')->get();
    return view('ktv.accessory.edit',['acc'=>$acc,'providers'=>$prov]);

}
public function postEditAcc(Request $request, $id){
    $this->validate($request,[
        'amount' => 'numeric',
        'used' => 'numeric',
        'broken' => 'numeric'
    ],[
        'amount.numeric' => 'Số lượng phải là số tự nhiên',
        'used.numeric' => 'Số lượng phải là số tự nhiên',
        'broken.numeric' => 'Số lượng phải là số tự nhiên',
    ]);
    $acc = Accessory::find($id);
    $acc->acc_name    = $request->accName;
    $acc->provider_id = $request->provider_id;
    $acc->amount      = $request->amount;
    $acc->used      = $request->used;
    $acc->broken      = $request->broken;
    $acc->import_date = $request->importDate;
    $acc->unit        = $request->unit;
    $acc->save();
    return redirect()->route('accessory.show')->with('message','Cập nhật thành công thông tin vật tư ');
}
public function delAcc($id){
    $acc = Accessory::findOrFail($id);
    $acc->delete();
    return redirect()->route('accessory.show')->with('Đã xóa thành công một vật tư');

}
//xem hồ sơ thiết bị
public function fileDevice($id){
    $file = History_ktv::where('dv_id',$id)->get();
    $dv = $id;
    return view('ktv.device.file')->with(['file'=>$file,'dv'=>$dv]);
}

//lịch bảo dưỡng
public function showmaintain(Request $request){
    $device = DB::table('device');
    $sl = $request->time_maintain;
    $today = now();
    $now = Carbon::now();//y-m-d h:m:s
    if($sl == '1w'){
        $device = $device->where('maintain_date','<=',$today)->where('maintain_date','>=',$now->subDays(7));
        
    }
    if($sl == '1m'){
         $device = $device->where('maintain_date','<=',$today)->where('maintain_date','>=',$now->subMonth());
    }
    if($sl == '2m'){
        $device = $device->where('maintain_date','<=',$today)->where('maintain_date','>=',$now->subMonths(2));
    }
    if($sl == '3m'){
        $device = $device->where('maintain_date','<=',$today)->where('maintain_date','>=',$now->subMonths(3));
    }
    return view('ktv.device.maintain')->with(['devices'=>$device]);

}

}


