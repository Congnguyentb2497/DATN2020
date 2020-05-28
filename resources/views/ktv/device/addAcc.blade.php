@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=date]{
    margin-left: : 0px;
    font-size: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
    height: 30px;
  }
  .container2{
    margin: 40px;
    margin-top: 40px;
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
<div style="margin-left: 20px;">
  <h1>Nhập vật tư kèm theo cho thiết bị {{$dv->dv_name}}</h1>
  <hr>
  <div style="margin-left: 30px;font-size: 20px;">
    <form action="{{route('device.saveAcc',['id'=>$dv->id] )}}" method="post">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3"><b>Tên vật tư </b></span>
      </div>
      <input style="width: 200px;" type="text" name="accName" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3"><b>Số lượng </b></span>
      </div>
      <input style="width: 200px;" type="text" name="accNumber" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>
    <div class="form-group">
          <select name="typeAcc" class="form-control" id="sel1" style="width: 200px;">
            <option value="">Chọn loại vật tư</option>
            <option value="vtth">Vật tư tiêu hao</option>
            <option value="vttt">Vật tư thay thế</option>
          </select>
    </div>
    <div class="input-append date form_datetime">
      <label>Hạn sử dụng</label><br>
      <input type="date"  name="expire_date">
    </div>
    <br>
    <div>
      <input style="width: 40px;" type="submit" class="btn btn-primary">Lưu</input>
      <button style="width: 40px;" class="btn btn-danger" type="reset">Reset</button>
    </div>
    
    </form>
  </div>
</div>
@endsection
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });
</script> 

