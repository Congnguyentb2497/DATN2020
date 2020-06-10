@extends('ktv.index')
@section('content')

<div>
    
    <form action="{{ route('device.editcheck',['id'=>$check->id])}}" class="form-container" method="post">
    	@csrf
      <table width="70%" style="font-size: 20px;" border="0" >
        <tr>
          <td colspan="2"><label style="text-align: center; font-size: 22px;"><b>Cập nhật thông tin bảo dưỡng thiết bị</b></label></td>
        </tr>
        <tr>
          <td><label>Năm</label></td>
          <td><input type="text" name="dv_id" value="{{$check->year}}" disabled=""></td>
        </tr>
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="{{$check->dv_id}}" disabled=""></td>
        </tr>
        <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check" name="id_check" value="{{$check->check_id}}" disabled=""></td>
        </tr>
        
        <tr>
          <td ><label>Loại kiểm tra</label></td>
          <td>
            <select disabled="" id="select_check" type="text" name="select_check" style="font-style: 17px;">
              <option value="{$check->type_check}}">{{$check->type_check}}</option>
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check" type="date" name="date_check" value="{{$check->time}}"></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker" name="checker" value="{{$check->checker}}"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note" type="text" name="note" value="{{$check->note}}"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;">
          <button type="button" class="btn cancel" >Lưu</button>
          <button class="btn btn-cancle">Hủy</button>
      		</td>
        </tr>
      </table>
    </form>
  </div>
  @endsection