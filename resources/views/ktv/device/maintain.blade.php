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
  
 
</div>
@endsection

