@extends('doctor.dashboard')
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
    width: 200px;
  }
  .btnsearch{
    width: 150px;
    margin-left: 5px;
    margin-top: 0px;
    height: 33px;
    font-size: 17px;


  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 40px;
    margin-top: 40px;
  }
  h2{
    margin-left: 40px;
    font-weight: bold;
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
<h2>Danh sách thông báo</h2>
<div class="container2">
  <!-- <div>
    <div style="padding: 0px; margin-left:50px; width: 40%; font-size: 14px;">
      @if(isset($message))
      <div class="alert alert-success" style="width: 70%;">
        {{ $message }}
      </div>
      @endif
    </div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0" class="input-group mb-3">
        <tr>
            <td width="40%"><label for="date">Từ ngày</label>
            <input type="date" id="fromdate" name="fromDate" ></td>
            <td width="40%"> <label for="date">Đến ngày</label>
            <input type="date" id="todate" name="toDate"></td>
            <td><div style="border-top: 0px;"><button class="btnsearch" type="submit" ><i class="fa fa-search"></i> Tìm kiếm</button></div>
            </td>
        </tr>
      </table>  
    </form>
  </div><br><br> --><br>
  
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Thời gian</th>
        <th>Nội dung</th>
        <th>Người gửi</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
    @if(isset($notices))
        @foreach($notices as $notice)
      <tr style="font-size: 15px;">
        <td>{{$notice->id}}</td>
        <td>{{$notice->req_date}}</td>
        <td>{{$notice->req_content}}</td>
        <td>Phòng vật tư</td>
        <td style="text-align: center;">
          <a href="{{ route('doctor.acceptNoitce',['id'=>$notice->id])}}"><i class="fa fa-pencil-square-o " title="Xác nhận" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$notices->links()}}
    </nav>
  </div>
</div>
@endsection