@extends('ktv.index')
@section('content')
<style type="text/css">
  input[type=text] {
    padding: 3px;
    font-size: 20px;
    border: #A4A4A4 solid 1px;
  }
  .btnsearch:hover{
    background-color: #BDBDBD;
  }
  .container2{
    margin: 20px;
    margin-top: 60px;
  }
  h2{
    margin-left: 20px;
    font-weight: bold;
  }
  
</style>
<h2>Xem Lịch Bảo Dưỡng Định Kì Thiết Bị</h2>
<div class="container2">
  <div>
    <form action="" method="get" style="float: left;">
      @csrf
      <table width="100%" border="0">
        <tr>
          <td>
            <select style="width: 600px;" name="time_maintain" class="form-control">
              <option value="">Lựa chọn thời gian</option>
              <option value="1w">Trong 1 tuần tới</option>
              <option value="1m">Trong 1 tháng tới</option>
              <option value="2m">Trong 2 tháng tới</option>
              <option value="3m">Trong 3 tháng tới</option>
            </select>
          </td>
          <td>
            <button class="btnsearch" type="submit" style="width: 100px; margin-left: 5px;padding: 4px;"><i class="fa fa-search">&nbsp;Tìm kiếm</i></button>
          </td>
          
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  @if(isset($devices))
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 18px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Khoa phòng</th>
        <th>Nhà cung cấp</th>
        <th>Hạn sử dụng</th>
        <th>Ngày bảo dưỡng định kì</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $row)
      <tr style="font-size: 15px;">
        <td>{{ $row->dv_id }}</td>
        <td>{{$row->dv_name}}</td>
        <td>{{$row->dv_model}}</td>
        <td>{{ \App\Department::where(['id' => $row->department_id])->pluck('department_name')->first() }}</td>
        <td>{{ \App\Provider::where(['id' => $row->provider_id])->pluck('provider_name')->first() }}</td>
        <td>{{ $row->handover_date }}</td>
        <td>{{ $row->maintain_date }}</td>
        <td></td>
      </tr>
      @endforeach
  @endif
  
</div>
@endsection

