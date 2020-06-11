@extends('ktv.index')
@section('content')
<style type="text/css">
	.fa-history{
		font-size: 20px;
		opacity: 0.7;
		color: green;
	}
	.fa-history:hover{
		opacity: 1;
	}
	table{
		width: 100%;
		font-size: 17px;
	}
</style>
<div>
	<div>
	<form class="form-group" action="" method="get">
		@csrf
		<table>
			<tr>
				<td width="20%">
					<div><input type="text" name="dvId" class="form-control" placeholder="Nhập mã thiết bị "></div>
				</td>
				<td width="20%">
					<div style="margin-left: 5px;"><input class="form-control" type="text" name="dvname" placeholder="Nhập tên thiết bị "> </div>
				</td>
				<td width="20%">
					<div style="margin-left: 5px;"><select name="dept" class="form-control">
						<option value="">Chọn khoa phòng</option>
						@foreach($depts as $d)
						<option value="{{ $d->id }}">{{ $d->department_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="20%">
					<div style="margin-left: 5px;">
						<select name="dvt" class="form-control">
						<option value="">Chọn loại thiết bị</option>
						@foreach($dvts as $dvt)
						<option value="{{ $dvt->id }}">{{ $dvt->dv_type_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="20%">
					<div style="margin-left: 5px;"> <button class="btn btn-primary">Tìm kiếm </button></div>
				</td>
				<td width="10%">
					<div style="margin-left: 5px;">Tổng: {{ $devices->total() }}</div>
				</td>
			</tr>
		</table>
	</form>
	</div><br><br>
	<div>
		<table class="table table-condensed table-bordered table-hover">
			<thead style="background-color: #D8D8D8">
				<th width="20%">Mã thiết bị</th>
				<th width="30%">Tên thiết bị</th>
				<th width="10%">Model</th>
				<th width="20%">Nhà cung cấp</th>
				<th width="5%">Năm SX</th>
				<th width="5%">Chi tiết</th>
			</thead>
			<tbody>
				@if(isset($devices))
				@foreach($devices as $r)
				<tr>
					<td>{{ $r->dv_id }}</td>
					<td>{{ $r->dv_name }}</td>
					<td>{{ $r->dv_model }}</td>
					<td>{{ $r->provider->provider_name }}</td>
					<td>{{ $r->produce_date }}</td>
					<td style="text-align: center;">
						<a  href="{{ route('device.view',['id'=>$r->id]) }}"><i  title="Xem hồ sơ" class="fa fa-history" aria-hidden="true"></i></a>
					</td>
					
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>

</div>
@endsection