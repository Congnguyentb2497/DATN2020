@extends('ktv.index')
@section('content')
<style type="text/css">
	input[type=text], select, input[type=date]{
		padding: 3px;
		font-size: 17px;
		width: 100%;
	}
</style>
<div>
	<h1>Cập nhật thông tin bảo dưỡng thiết bị</h1>
</div>
<div style="margin-left: 50px;"  class="form-group">
    
    <form action="{{ route('device.editcheck',['id'=>$check->id])}}" class="form-container" method="post">
    	@csrf
      <table width="70%" style="font-size: 20px;" border="0" >
        <tr>
          <td><label>Năm</label></td>
          <td><input type="text" name="dv_id" value="{{$check->year}}" class="form-container" disabled=""></td>
        </tr>
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="{{$check->dv_id}}" class="form-container" disabled=""></td>
        </tr>
        <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check" name="id_check" class="form-container" value="{{$check->check_id}}" disabled=""></td>
        </tr>
        
        <tr>
          <td ><label>Loại kiểm tra</label></td>
          <td>
            <select disabled="" id="select_check" type="text" class="form-container" name="select_check" style="font-style: 17px;">
              <option value="{$check->type_check}}">{{$check->type_check}}</option>
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check" type="date" class="form-container" name="date_check" value="{{$check->time}}"></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker" class="form-container" name="checker" value="{{$check->checker}}"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note" type="text" class="form-container" name="note" value="{{$check->note}}"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;width: 100%">
          <button type="button" class="btn btn-primary" >Lưu</button>
      		</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;width: 100%">
        <button class="btn btn-cancle">Hủy</button>
      		</td>
        </tr>
      </table>
    </form>
  </div>
  @endsection