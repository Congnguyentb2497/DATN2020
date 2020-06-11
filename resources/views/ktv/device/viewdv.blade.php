@extends('ktv.index')
@section('content')
<div>
	<div>
	<form class="form-group">
		<table>
			<tr>
				<td width="20%">
					<div><input type="text" name="dvId" placeholder="Nhập mã thiết bị "> </div>
				</td>
				<td width="20%">
					<div><input type="text" name="dvId" placeholder="Nhập tên thiết bị "> </div>
				</td>
				<td width="20%">
					<div><select>
						<option>Chọn khoa phòng</option>
						@foreach($depts as $d)
						<option value="{{ $d->id }}">{{ $d->department_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="20%">
					<div>
						<select>
						<option>Chọn loại thiết bị</option>
						@foreach($dvts as $dvt)
						<option value="{{ $dvt->id }}">{{ $d->dv_type_name }}</option>
						@endforeach
					</select>
					</div>
				</td>
				<td width="20%">
					<div> <button class="btn btn-primary">Tìm kiếm </button></div>
				</td>
			</tr>
		</table>
	</form></div><br>br
	<div>
		<table class="table table-condensed table-bordered table-hover">
			<thead>
				<th>Mã thiết bị</th>
				<th>Tên thiết bị</th>
				<th>Model</th>
				<th>Nhà cung cấp</th>
				<th>Năm sản xuất</th>
				<th>Chi tiết</th>
			</thead>
			<tbody>
				@if(isset($devices))
				@foreach($devices as $r)
				<tr>
					<td>{{ $r->dv_id }}</td>
					<td>{{ $r->dv_name}}</td>
					<td>{{ $r->dv_model }</td>
					<td>{{ $r->provider->provider_name}}</td>
					<td>{{ $r->produce_date }}</td>
					<td></td>
					
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>

</div>
@endsection