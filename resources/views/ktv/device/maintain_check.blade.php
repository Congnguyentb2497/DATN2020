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

<div><h1>Thống Kê Lịch Trình Bảo Dưỡng Định Kì Thiết Bị {{$device->dv_name}}</h1></div>
<br>
<select class="form-control" id="year" style="width: 200px;">
  <option disabled="" value="">Lựa chọn năm</option>
  @for ($j = 2020; $j<=2040; $j++)
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
      <td style="text-align: center; width: 1.5%;cursor: pointer;" class="check" data-deviceid="{{ $row->id.$i }}" id="{{ $row->id.$i }}"> 
        @if($checked != null) 
            @foreach($checked as $ch)
                @if($ch->check_id == $row->id.$i)
                    @if($ch->type_check == 'C')
                    <button data-deviceid="{{ $ch->id }}" class="editcheck" style="height: 20px;font-size: 10px;background-color: green">{{$ch->type_check}} </button>
                    @elseif($ch->type_check == 'M')
                    <button data-deviceid="{{ $ch->id }}" class="editcheck" style="height: 20px;font-size: 10px;background-color: yellow">{{$ch->type_check}} </button>
                    @else
                    <button data-deviceid="{{ $ch->id }}" class="editcheck" style="height: 20px;font-size: 10px;background-color: violet">{{$ch->type_check}} </button>
                    @endif



                @endif
            @endforeach
        @endif
      </td>
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
          <td colspan="2" style="text-align: center;"><button id="luu" type="submit" class="btn">Lưu
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
    </form>
  </div>
<div class="form-popup" id="myForm1">
    <input type="hidden" name="bienphp" id="bienphp" value="process" />
    <form action="{{ route('device.editcheck','id')}}" class="form-container form2" method="post">
      @csrf
      @if(isset($checked))
      @foreach($checked as $row)
      @if($row->id == $_POST['bienphp'])
      <table style="font-size: 17px;" border="0" >
        <tr>
          <td colspan="2"><label style="text-align: center; font-size: 22px;"><b>Cập nhật thông tin bảo dưỡng thiết bị</b></label></td>
        </tr>
        <tr>
          <td><label>Mã thiết bị</label></td>
          <td><input type="text" name="dv_id" value="{{$ch->dv_id}}" disabled=""></td>
        </tr>
        <tr>
          <td width="20%"><label>Mã kiểm tra</label></td>
          <td><input type="text" id="id_check1" name="id_check" value="{{$ch->check_id}}" disabled=""></td>
        </tr>
        
        <tr>
          <td ><label>Loại kiểm tra</label></td>
          <td>
            <select disabled="" id="select_check1" type="text" name="select_check1" style="font-style: 17px;">
              <option value="{$ch->type_check}}">{{$ch->type_check}}</option>
            </select> 
          </td>
        </tr>
        <tr>
          <td><label>Ngày thực hiện</label></td>
          <td><input id="date_check1" type="date" name="date_check1" value="{{$ch->time}}"></td>
        </tr>
        <tr>
          <td><label>Người thực hiện</label></td>
          <td><input type="text" id="checker1" name="checker1" value="{{$ch->checker}}"></td>
        </tr>
        <tr>
          <td><label>Ghi chú</label></td>
          <td><input id="note1" type="text" name="note1" value="{{$ch->note}}"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><button id="luu" type="submit" class="btn">Sửa
          </button>
          <button type="button" class="btn cancel" onclick="closeForm()">Hủy</button></td>
        </tr>
      </table>
      @endif
      @endforeach
      @endif
    </form>
  </div>
<script>
  var arr = '{{ $checked }}';
  var v;
  //luu du lieu check

  function closeForm() {
        document.getElementById("myForm").style.display = "none";
        document.getElementById("myForm1").style.display = "none";

  }
//check
  $(document).on('click', '.check', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form1').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form1').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm").style.display = "block";
    document.getElementById('id_check').value = id;
    var ch = '#'+id;
    $('#select_check').on('change',function(){
        //var optionValue = $(this).val();
        //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
        g = $("#select_check option:selected").val();
        if(g == 'C'){
          $(ch).css('background-color','green');
        }else if(g == 'M')
        {
          $(ch).css('background-color','yellow');
        }else{
          $(ch).css('background-color','violet');         
        }
    });
  })
//editcheck
    $(document).on('click', '.editcheck', function(){
    // Lấy id của data
    var id = $(this).attr('data-deviceid');
    // Lấy action hiện tại của form theo class
    var action = $('.form2').attr('action');
    // Thay thế id data vào đoạn action của form
    var actions= $('.form2').attr('action', action.replace('id',id));
    // Hiện form
    document.getElementById("myForm1").style.display = "block";
    document.getElementById('bienphp').value= id;
  });

 
  

</script>
@endsection


