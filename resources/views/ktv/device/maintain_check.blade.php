@extends('ktv.index')
@section('content')
<style type="text/css">
  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    top: 200px;
    bottom: 200px;
    left: 400px;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }
  .form-container {
    max-width: 800px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 500px;
    border-radius: 5px;
  }
  /* Full-width input fields */
  .form-container input[type=text], .form-container input[type=date], .form-container input[type=password], .form-container select[type=text] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 5px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus, .form-container input[type=password]:focus,.form-container select[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-container .btn {
    background-color: #4CAF50;
    font-size: 20px;
    color: white;
    padding: 10px 10px;
    border: none;
    cursor: pointer;
    width: 150px;
    margin-left:10px;
    opacity: 0.7;
  }

  /* Add a red background color to the cancel button */
  .form-container .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover, .open-button:hover {
    opacity: 1;
  }
</style>
@php
$month = [
    'January', 
    'February', 
    'March', 
    'April', 
    'May', 
    'June', 
    'July', 
    'August', 
    'September', 
    'Octorber', 
    'November', 
    'December'
];
@endphp

<div>Thống Kê Lịch Trình Bảo Dưỡng Định Kì Thiết Bị {{$device->dv_name}}</div>
<br>
<select class="form-control" id="year" style="width: 200px;">
  <option disabled="" value="">Lựa chọn năm</option>
  @for ($j = 2020; $j<=2030; $j++)
  <option value="{{$j}}">{{ 'Năm '.$j }}</option>
  @endfor
</select>
<br>
<table width="100%" border="1">
    <tr>
        <th style="width: 20%;background-color: yellow;">Hạng mục công việc</th>
        @for($i = 0; $i < count($month); $i++)
        @php
            if($i == 0 || $i == 3 || $i == 6 || $i == 8 || $i == 11)
            {
                $col = 5;
            }
            else{
                $col = 4;
            }
        @endphp
        <th colspan="{{ $col }}" style="text-align: center; width: 7%;background-color: yellow;">{{ $month[$i] }}</th>
        @endfor
    </tr>
    <tr>
        <th></th>
        @for($i = 1; $i <= 53; $i++)
        <td style="text-align: center; width: 1.5%;background-color: yellow;">{{ 'T'.$i }}</td>
        @endfor
    </tr>
    @if(isset($maintainAct))
    @foreach($maintainAct as $row)
  <tr>
    <td>{{ $row -> scheduleAct}}</td>
    @for($i = 1; $i <= 53; $i++)
    <td style="text-align: center; width: 1.5%;cursor: pointer;"> <button data-deviceid="{{ $row->id.$i   }}" id="{{ $row->id.$i }}" onmousemove="show()" class="check" style="height: 20px;"></button></td>
    @endfor
  </tr>
    @endforeach
    @endif
</table>

<div class="form-popup" id="myForm">
    <form action="{{ route('device.check','id')}}" class="form-container form1" method="post">
      @csrf
      <table style="font-size: 17px;" border="0" >
        <tr>
          <td colspan="2"><label style="text-align: center; font-size: 22px;"><b>Thông tin bảo dưỡng thiết bị</b></label></td>
        </tr>
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="{{$device->dv_id}}"></td>
        </tr>
        <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check" name="id_check"></td>
        </tr>
        
        <tr>
          <td ><label>Loại kiểm tra</label></td>
          <td>
            <select id="select_check" type="text" name="select_check" style="font-style: 17px;">
              <option value="" disabled="">Chọn loại bảo dưỡng</option>
              <option value="C">Kiểm tra</option>
              <option value="M">Bảo trì</option>
              <option value="I">Kiểm định</option>
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check" type="date" name="date_check" value="{{date('Y-m-d')}}"></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker" name="checker" value="{{Auth::user()->fullname}}"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note" type="text" name="note"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button type="submit" class="btn">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>
<script>
  var arr = [];

  //luu du lieu check
  function luu() {
    
    // document.getElementById("myForm").style.display = "block";

  }
  function show(){

  }
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  $(document).on('click', '.check', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form1').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form1').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm").style.display = "block";
    document.getElementById('id_check').value = $('#year').val()+id;

  });

</script>
@endsection


