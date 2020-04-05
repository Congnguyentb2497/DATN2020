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
  .btnsearch{
    width: 150px;
    padding: 3px;
    margin-left: 5px;


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
<h2>Bạn có <span style="font-size: 35px; color: red;">{{$notices->total()}}</span> thông báo</h2>
<div class="container2">
    <div style="padding: 0px; margin-left: : 150px; width: 40%; font-size: 14px;">
      @if(session('message'))
      <div class="alert alert-success" style="width: 70%;">
        {{session('message')}}
      </div>
      @endif
    </div>
   <!--  <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0" class="input-group mb-3">
        <tr>
            <td> <label for="date">Từ ngày</label>
            <input type="date" id="fromdate" name="fromDate" ></td>
            <td> <label for="date">Đến ngày</label>
            <input type="date" id="todate" name="toDate"></td>
            <td><button class="btnsearch" type="submit" ><i class="fa fa-search"></i></button>
            </td>
        </tr>
      </table>  
    </form> -->
  <br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Thời gian</th>
        <th>Nội dung thông báo</th>
        <th>Tên thiết bị</th>
        <th>Người báo hỏng</th>
        <th width="7%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
        @foreach($notices as $notice)
      <tr style="font-size: 15px;">
        <td>{{$notice->id}}</td>
        <td>{{$notice->req_date}}</td>
        <td>{{$notice->req_content}}</td>
        <td>{{ \App\Device::where(['id' => $notice->dv_id])->pluck('dv_name')->first()}}</td>
        <td>{{ \App\User::where(['id' => $notice->annunciator_id])->pluck('fullname')->first()}} </td>
        <td style="text-align: center;">
          <a href="{{route('ktv.acceptNotice',['user_id'=>Auth::id(),'id'=>$notice->id,'dv_id'=>$notice->dv_id,'status'=>$notice->status]) }}"><i class="fa fa-pencil-square-o " title="Xác nhận" aria-hidden="true" onclick="return confirm('Bạn có chắc chắn?')"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <!-- <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="#"><i class="fa fa-trash " title="Xóa" aria-hidden="true"></i></a> -->
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$notices->links()}}
    </nav>
  </div>
</div>
@endsection

