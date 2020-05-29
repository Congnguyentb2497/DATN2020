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
  <div style="margin-left: 30px;font-size: 22px;">
    <form action="{{route('device.saveAcc',['id'=>$dv->id] )}}" method="post">
      @csrf
    <div class="input-group mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3"><b>Tên vật tư </b></span>
      </div>
      <input style="width: 400px;" type="text" name="accName" class="form-control" id="basic-url" required="">
    </div>
    <div class="input-group mb-3" style="margin-top: 10px;">
      <div class="input-group-prepend">
       <span class="input-group-text" id="basic-addon3"><b>Số lượng </b></span>
      </div>
      <input style="width: 400px;" type="text" value="1" name="accNumber" class="form-control" id="basic-url">
    </div>
    <div class="form-group" style="margin-top: 20px;">
          <select required="" name="typeAcc" class="form-control" style="width: 400px;background-color: #E6E6E6">
            <option value=""> Chọn loại vật tư </option>
            <option value="vtth">Vật tư tiêu hao</option>
            <option value="vttt">Vật tư thay thế </option>
          </select>
    </div>
    <div class="input-append date form_datetime" style="margin-top: 10px;">
      <span class="input-group-text"> <b>Hạn sử dụng</b></span><br>
      <input style="width: 400px;" type="date"  name="expire_date" required="">
    </div>
    <br>
    <div style="margin-top: 10px;margin-left: 100px;">
      <input style="width: 100px;" type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <button style="width: 100px;" class="btn btn-danger" type="reset">Reset</button>
    </div>
    
    </form>
  </div>
</div>
@endsection



