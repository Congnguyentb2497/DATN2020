@extends('ktv.index')
@section('content')
<style type="text/css">
  h2{
    margin-left: 40px;
    font-weight: bold;
  }
</style>
<h2>Hồ Sơ Thiết Bị {{ \App\Device::where(['id' => $dv])->pluck('dv_name')->first()}}</h2>
<div class="container2">
  <br>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #00BD9C;">
      <tr style="font-size: 18px;">
        <th>Thời gian</th>
        <th>Hoạt động - Tình trạng</th>
        <th>Thực hiện bởi</th>   
      </tr>
    </thead>
    <tbody>
        @if(isset($file))
        @foreach($file as $row)
      <tr style="font-size: 15px;">
        <td>{{$row->time}}</td>
        <td>{{$row->action}}</td>
        <td>{{$row->implementer}}</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>
@endsection


