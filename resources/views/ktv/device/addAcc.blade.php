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
<div>
  <h1>Nhập vật tư kèm theo cho thiết bị {{$dv->dv_name}}</h1>
  <hr>
  <div>
    <form action="{{route('device.saveAcc',['id'=>$dv->id] )}}" method="post">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Tên vật tư </span>
      </div>
      <input type="text" name="accName" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3">Số lượng </span>
      </div>
      <input type="text" name="accNumber" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>
    <div class="form-group">
        <label for="sel1">Chọn loại vật tư</label>
          <select name="typeAcc" class="form-control" id="sel1">
            <option value="vtth">Vật tư tiêu hao</option>
            <option value="vttt">Vật tư thay thế</option>
          </select>
    </div>
    <div class="input-append date form_datetime">
      <input size="16" type="text" name="expire_date" value="" readonly>
      <span class="add-on"><i class="icon-th"></i></span>
    </div>
 
    <button type="button" class="btn btn-primary">Lưu</button>
    <button class="btn btn-danger" type="reset">Reset</button>
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

