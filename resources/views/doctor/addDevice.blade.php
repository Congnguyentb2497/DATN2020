@extends('doctor.dashboard')
@section('content')
<style type="text/css">
  input, select{
    width: 80%;
    font-size: 15px;
    border-radius: 3px;
  }
.fa-print{
  background-color: green;
  opacity: 0.7;
  font-size: 22px;
}
.fa-print:hover{
  opacity: 1;
}
</style>
<div class="form-group">
  <form>
    <table>
      <tr>
        <td><input type="text" name="dvId" class="form-control"></td>
        <td><input type="text" name="dvName" class="form-control"></td>
        <td><select id="dvt" class="form-control" name="dvt">
          <option disabled="" value="">Chọn loại thiết bị</option>
          @foreach($dvts as $dvt)
            <option value="{{$dvt->id}}">{{$dvt->dv_type_name}}</option>
          @endforeach
        </select></td>
        <td>
          <button class="btn btn-primary">Tìm kiếm</button>
        </td>
      </tr>
    </table>
  </form>
</div>
<br>
if(isset($dvs))
@foreach($dvs as $r)
<div>
  <table class="table table-condensed table-bordered table-hover">
    <thead style="background-color: #81BEF7;">
      <th>Mã thiết bị</th>
      <th>Tên thiết bị</th>
      <th>Model</th>
      <th>Năm sản xuất</th>
      <th>Nhà cung cấp</th>
      <th>Ngày nhập</th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td>{{ $r->dv_id }}</td>
        <td>{{ $r->dv_name }}</td>
        <td>{{ $r->model }}</td>
        <td>{{ $r->produce_date }}</td>
        <td>{{ $r->provider->provider_name}}<td>
        <td>{{ $r->import_date }}</td>
        <td>
          <a href="{{ route('doctor.print.device',['id'=>$r->id]) }}" style="text-decoration: none;"><i class="fa fa-print" title="In phiếu bàn giao" aria-hidden="true"></i></a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endforeach
@endif
<script type="text/javascript">
  $(document).ready(function(){
    $('#dvt').select2({});
  })
</script>
@endsection
