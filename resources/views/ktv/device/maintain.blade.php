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
            <input style="width: 90%" type="text" name="dv_name" placeholder="nhập tên thiết bị">  
          </td>
          <td>
            <select class="form-control" id="searchDvt" name="dvt_id" style="background-color: #D8D8D8;width: 90%">
              <option value="">Loại thiết bị</option>
              @if(isset($dvts))
              @foreach($dvts as $rows)
              <option value="{{ $rows->id }}" >
                {{ $rows->dv_type_name }}
              </option>
              @endforeach
              @endif
            </select>
          </td>
          <td>
          <select class="form-control" name="provider" style="background-color: #D8D8D8;width: 90%">
              <option value="">Nhà cung cấp</option>
              @if(isset($providers))
              @foreach($providers as $row)
              <option value="{{ $row->id }}" >
                {{ $row->provider_name }}
              </option>
              @endforeach
              @endif
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
        <th>Bảo dưỡng đk</th>
        <th>Khấu hao bđ</th>
        <th width="10%">Điều khiển</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $row)
      <tr style="font-size: 15px;cursor: pointer;" ondblclick='location.href=("{{ route('device.maintainCheck', ['id' => $row->dv_id]) }}")' >
        <td>{{ $row->dv_id }}</td>
        <td>{{$row->dv_name}}</td>
        <td>{{$row->dv_model}}</td>
        <td>{{ \App\Department::where(['id' => $row->department_id])->pluck('department_name')->first() }}</td>
        <td>{{ \App\Provider::where(['id' => $row->provider_id])->pluck('provider_name')->first() }}</td>
        <td>{{ $row->maintain_date }}</td>
        <td>{{ $row->khbd }}</td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('device.history',['id'=>$row->id])}}" style="text-decoration: none;"><i class="fa fa-history " style="font-size: 22px" title="Lịch sử sửa chữa" aria-hidden="true"></i></a>
        </td>
      </tr>
      @endforeach
  @endif
  
</div>
@endsection
<script type="text/javascript">
  $(document).ready(function(){
    $('#searchT').select2({});
    $('#searchDvt').select2({});
  })
</script>

