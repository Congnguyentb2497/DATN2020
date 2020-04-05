@extends('doctor.dashboard')
@section('content')
<style type="text/css">
  input[type=text]{
    margin-left: : 0px;
    font-size: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    height: 40px;
    width: 500px;
  }
  .btnsearch{
    width: 150px;
    margin-left: 5px;
    margin-top: 0px;
    height: 33px;
    font-size: 17px;
    height: 40px;


  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 40px;
    margin-top: 40px;
  }
  .fa-exclamation-circle{
  	cursor: pointer;
  }
  .fa-exclamation-circle:hover{
  	background-color: red;
  		border-radius: 5px;

  }
  
  h2{
    margin-left: 40px;
    font-weight: bold;
  }
  label {
    font-weight: bold;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-left: 2px;
    padding: 3px;

  }
</style>
<h2>Danh sách thiết bị của khoa {{$user->department->department_name}}</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0" class="input-group mb-3">
        <tr>
            <td width="40%"><input type="text" name="dv_name" placeholder="Nhập tên thiết bị"></td>
            <td width="50%"><div><button class="btnsearch" type="submit" ><i class="fa fa-search"></i> Tìm kiếm</button></div>
            </td>
            <td><div style="font-size: 20px;">Tổng: {{ $devices->total() }}</div></td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Loại thiết bị</th>
        <th>Ngày bàn giao</th>
        <th>Hạn sử dụng</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
        @foreach($devices as $row)
      <tr style="font-size: 15px;">
        <td>{{$row->id}}</td>
        <td>{{$row->dv_name}}</td>
        <td>{{ $row->dv_model}}</td>
        <td>{{ \App\Device_type::where(['id'=>$row->dv_type_id])->pluck('dv_type_name')->first() }}</td>
        <td>{{$row->handover_date}}</td>
        <td>{{ $row->expire_date }}</td>
        <td style="text-align: center;">
          <a href="{{ route('doctor.noticeDev',['id'=>$row->id,'user_id'=>Auth::id()]) }}" onclick="return confirm('Bạn có chắc chắn báo hỏng thiết bị này? Thông báo sẽ được gửi đến phòng vật tư!')"><i style="font-size: 20px;" class="fa fa-exclamation-circle " title="Báo hỏng" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$devices->links()}}
    </nav>
  </div>
</div>

@endsection