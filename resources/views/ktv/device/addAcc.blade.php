@extends('ktv.index')
@section('content')
<style type="text/css">
  
  .container2{
    margin: 40px;
    margin-top: 40px;
  }
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
  hr{
    height: 2px;
    background-color: #2EFE64;
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
<div>
  <h1>Nhập vật tư kèm theo cho thiết bị {{$dv->dv_name}}</h1>
  <hr>
  <div class="editKtv">
  <form action="{{route('device.saveAcc',['id'=>$dv->id] )}}" method="post">
         @csrf
    <table border="0" width="100%" >
      <tr>
        <td><label>Tên vật tư</label></td>
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
        <td><label>Loại vật tư</label></td>
        <td>
          <select id="sl_dvt" type="text" name="device_type" required>
            <option value="">Chọn loại vật tư</option>
            <option value="vtth">Vật tư tiêu hao</option>
            <option value="vttt">Vật tư thay thế</option>
          </select>
        </td>
        <td><label>Ngày sản xuất</label></td>
        <td><input type="date"  name="produce_date" ></td>
      </tr>
       <tr>
        <td><label>Ngày nhập kho</label></td>
        <td><input type="date" id="import_date" name="import_date" value="{{ date('Y-m-d') }}" ></td>  
        <td><label>Hãng sản xuất</label></td>
        <td><input type="text"  name="produce" ></td>
      </tr>    
       <tr>
        <td><label>Hạn sử dụng</label></td>
        <td><input type="date"  name="expire_date" ></td>
        <td><label>Mã thiết bị đi kèm</label></td>
        <td><input type="text" id="dvId"  name="dv_id" value="{{$dv->dv_id}}"></td>
      </tr>
      <tr>
        <td><label>Ghi chú</label></td>
        <td><input type="text"  name="note"></td>
        <td></td>
        <td>
          <div>
          <input style="width: 100px;" type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button style="width: 100px;" class="btn btn-danger" type="reset">Reset</button>
          </div>
        </td>
      </tr>
    </table> 
  </form>
</div>
</div>
@endsection



