@extends('ktv.index')
@section('content')
<style>
input[type=text], input[type=date]{
  width: 450px;
  padding: 5px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
}
select[type=text]{
  width: 450px;
  padding: 5px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
  background-color: #D8D8D8;
}
.btn{
  width: 130px;
  background-color: green;
  color: black;
  padding: 7px;
  margin: 7px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
  margin-left: 5px;
}

.btn:hover {
  opacity: 1;
  color: black;
  font-weight: bold;
}
.rgt1{
  margin-top: 10px;
  width: 130px;
  background-color: #848484;
  height: 40px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
  margin-left: 5px;
  text-align: center;
  padding: 5px;
}

.rgt1:hover{
  opacity: 1;
}


.rgt_canl:hover{
  opacity: 1;
  text-decoration: none;
  padding: 4px;
  color: black;
}
.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  margin-left: 40px;
  margin-top: 40px;
}
hr {
	background-color: #4CAF50;
	height: 2px;
	padding: 1px;
	margin-left:  50px;
	margin-right: 50px;
}
label {
	font-size: 20px;
  font-weight: bold;
  padding: 2px;
  background-color: #81DAF5;
  border: solid 0px;
    border-radius: 4px;
    width: 150px;
    text-align: center;
}
</style>
<div style="font-size: 30px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Nhập thông tin thiết bị</div>
<hr >
<div class="editKtv">
  <form action="{{route('device.postAdd')}}" method="post">
  	     @csrf
    <table border="0" width="100%" >
      <tr>
        <td><label>Tên thiết bị</label></td>
        <td><input type="text"  name="name_device" required></td>
        <td><label>Nhà cung cấp</label></td>
        <td><select type="text" name="provider" required>
        		<option value="">Nhà cung cấp</option>
        		@isset($providers)
        		@foreach($providers as $rows)
        		<option name="provider" value="{{$rows->id}}">{{$rows->provider_name}}</option>
        		@endforeach
        		@endif
        	</select></td>
      </tr>
       <tr>
        <td><label>Model</label></td>
        <td><input type="text"  name="model" required></td>
        <td><label>Serial</label></td>
        <td><input type="text"  name="serial" ></td>
      </tr>
       <tr>
        <td><label>Loại thiết bị</label></td>
        <td>
        	<select id="sl_dvt" type="text" name="device_type" required>
        		<option value="">Loại thiết bị</option>
        		@isset($dv_types)
        		@foreach($dv_types as $rows)
        		<option class="dvt" value="{{$rows->id}}">{{$rows->dv_type_name}}</option>
        		@endforeach
        		@endif
        	</select>
        </td>
        <td><label>Hãng sản xuất</label></td>
        <td><input type="text"  name="produce" ></td>
      </tr>
       <tr>
        <td><label>Ngày sản xuất</label></td>
        <td><input type="date"  name="produce_date" ></td>  
        <td><label>Nhóm thiết bị</label></td>
        <td><input type="text"  name="group" value="X"></td>
      </tr>
       <tr>
        <td><label>Ngày nhập kho</label></td>
        <td><input type="date"  name="import_date" ></td>
        <td><label>Mã phiếu nhập</label></td>
        <td><input type="text"  name="import_id" ></td>
      </tr>
      <tr>
        <td><label>Giá nhập</label></td>
        <td><input type="text"  name="price" ></td>
        <td><label>Xuất xứ</label></td>
        <td><input type="text"  name="country" ></td>
      </tr>
      <tr>
        <td><label>Số lưu hành</label></td>
        <td><input type="text"  name="license_number" ></td>
        <td><label>Ngày cấp</label></td>
        <td><input type="date"  name="license_number_date" ></td>
      </tr>
       <tr>
        <td><label>Bảo dưỡng ĐK</label></td>
        <td><input type="date"  name="maintain_date" ></td>
        <td><label>Mã thiết bị</label></td>
        <td><input type="text" id="dv_id"  name="dv_id" ></td>
      </tr>
      <tr>
        <td><label>Ghi chú</label></td>
        <td><input type="text"  name="note"></td>
        <td></td>
        <td>
          <div>
          <div style="float: left; margin-top: 2px;"><input value="Lưu" class="btn" type="submit" style="margin-left: 50px;color: black;" ></div>
          <div style="float: left;margin-left: 5px;background-color:green " class="rgt1"><a  class="rgt_canl" style="color: black; text-decoration: none;font-weight: bold;">Hoàn Thành</a></div>
          </div>
          <div style="float: left;margin-left: 5px;" class="rgt1"><a  class="rgt_canl" href="{{route('get.home')}}" style="color: black; text-decoration: none;font-weight: bold;">Hủy</a></div>
          </div>
        </td>
      </tr>
    </table> 
  </form>
</div>
@endsection
<!-- <script type="text/javascript">
  $(document).ready(function(){
    var id = $('#sl_dvt').val();
    $('#dv_id').val(id);
  })
</script> -->
