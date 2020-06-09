@extends('ktv.index')
@section('content')
<style type="text/css">
  form-container {
    max-width: 800px;
    padding: 10px;
    background-color: #BDBDBD;
    max-height: 300px;
    border-radius: 5px;
  }
  /* Full-width input fields */
  .form-container input[type=text], .form-container input[type=password], .form-container select[type=text] {
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
<table width="200%" border="1">
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
        @if(isset($device))
        <th style="background-color: blue;">{{$device ->dv_name}}</th>
        @else
        <th style="background-color: blue;"></th>
        @endif

        @for($i = 1; $i <= 53; $i++)
        <td style="text-align: center; width: 1.5%;background-color: yellow;">{{ 'T'.$i }}</td>
        @endfor
    </tr>
    @if(isset($maintainAct))
    @foreach($maintainAct as $row)
  <tr>
    <td>{{ $row -> scheduleAct}}</td>
    @for($i = 1; $i <= 53; $i++)
    <td style="text-align: center; width: 1.5%;cursor: pointer;"> <button id="{{ $i.$row->id }}" onmousemove="show()" onclick="openForm()" class="check" style="height: 20px;"></button></td>
    @endfor
  </tr>
    @endforeach
    @endif
</table>

<div class="form-popup" id="myForm">
    <form action="" class="form-container form1" method="post">
      @csrf
      <table style="font-size: 17px;" border="0" >
        <tr>
          <td colspan="2"><label style="text-align: center; font-size: 22px;"><b>Thông tin bảo dưỡng thiết bị</b></label></td>
        </tr>
        <tr>
          <td><label>Mã kiểm tra</label></td>
          <td><input type="text" name="id_check"></td>
        </tr>
        <tr>
          <td ><label>Loại kiểm tra</label>
            <select type="text" name="select_check" style="font-style: 17px;">
            </select>
              <option value="C">Kiểm tra</option>
              <option value="M">Bảo trì</option>
              <option value="I">Kiểm định</option>
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input type="date" name="date_check"></td>
        </tr>
        <tr>
          <td>Người thực hiện</td>
          <td><input style="margin-left: 3px;" type="text" name="receiver"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input type="text" name="note"></td>
        </tr>
        <tr>
          <td colspan="2"><button type="submit" class="btn" onclick="luu()">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>

  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$devices->links()}}
    </nav>
  </div>
</div>
<script>

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
    var id = $(this).attr('id');
    // Lấy action hiện tại của form theo class
    $('#id_check').val = id;
    // Hiện form
    document.getElementById("myForm").style.display = "block";
  });

</script>
@endsection


