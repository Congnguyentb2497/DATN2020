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
              <option value="1w">Trong 1 tuần tới</option>
              <option value="1m">Trong 1 tháng tới</option>
              <option value="2m">Trong 2 tháng tới</option>
              <option value="3m">Trong 3 tháng tới</option>
            </select>
          </td>
          <td>
            <button class="btnsearch" type="submit" style="width: 100px;padding: 4px;margin-left: -2px;"><i class="fa fa-search">&nbsp;Tìm kiếm</i></button>
          </td>
          <td width="5%" style="text-align: left;font-size: 18px;">Tất cả: </td>
        </tr>
      </table>  
    </form>
  </div><br><br><br>
  
  <!-- <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <tr style="font-size: 20px;">
        <th>ID</th>
        <th>Tên thiết bị</th>
        <th>Model</th>
        <th>Nhà cung cấp</th>
        <th>Hạn sử dụng</th>
        <th>Ngày bảo dưỡng định kì</th>
        <th width="7%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
      @foreach($providers as $provider)
      <tr style="font-size: 15px;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">
          <a href="{{route('provider.getEdit',['id'=>$provider->id])}}"><i class="fa fa-pencil-square-o " style="font-size: 18px;" title="Sửa" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{route('provider.del',['id'=>$provider->id])}}"><i class="fa fa-trash" style="font-size: 18px;" title="Xóa" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="page-nav text-right">
    <nav aria-label="Page navigation">
      {{$providers->links()}}
    </nav>
  </div> -->
</div>
@endsection

