@extends('ktv.index')
@section('content')
<style type="text/css">
  h2{
    margin-left: 40px;
    font-weight: bold;
  }
  hr{
  	height: 2px;
  	background-color: green;
  }
  #sl_dv{
  	width: 500px;
  }
  .form{

  }
</style>

<div class="container2">
	<h2>Tạo Quy Trình Bảo Dưỡng Cho Thiết Bị</h2>
	<hr>
 	<div>
 		
 		<select name="sl_dv" id="sl_dv" class="form-control" required="">
 			<option value="">Lựa chọn thiết bị cần tạo lịch</option>
 			@if(isset($devices))
 			@foreach($devices as $row)
 			<option value="{{$row->id}}">{{$row->dv_name}}</option>
 			@endforeach
 			@endif
 		</select>
 		

 	</div>
 	<form class="form">
  <div class="form-group">
    <label for="exampleInputEmail1">Hoạt động bảo dưỡng</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập hoạt động cần bảo dưỡng">
    <small id="emailHelp" class="form-text text-muted">VD: Kiểm tra buồng kính chiếu tia X</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Tần suất thực hiện</label>
    <input type="password" class="form-control" id="exampleInputPassword1" >
    <small id="emailHelp" class="form-text text-muted">VD: hàng tuần, hàng tháng,... </small>
  </div>
  <button type="submit" class="btn btn-primary">Lưu</button>
</form>
</div>
@endsection


