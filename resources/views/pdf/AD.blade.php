<!DOCTYPE html>
<html>
<head>
	<title>Phiếu xin bàn giao thiết bị</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/times.ttf');
		font-style: normal; 
	}
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/timesbd.ttf');
		font-weight: bold; 
	}
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/timesi.ttf');
		font-style: italic; 
	}
	@font-face{
		font-family: "Times New Roman" !important;
		src: url('fonts/timesbi.ttf');
		font-style: italic; 
		font-weight: bold;
	}
	* {
		font-family: Times New Roman !important;
	}
	.font-bold {
		font-weight: bold;
	}
	.font-italic {
		font-style: italic;
	}
	body{
		margin: auto;
	}
	table{
		width: 100%;
	}
</style>
<body>
	<div>
		<table style="font-size: 22px;" width="100%">
			<tr>
				<td class="font-bold" style="text-align: center;">Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam</td>
			</tr>
			<tr>
				<td class="font-bold" style="text-align: center;">Độc lập - Tự do - Hạnh phúc</td>
			</tr>
			<tr>
				<td>
					<div style="margin-top: 50px;font-size: 24px;text-align: center; " class="font-bold">Phiếu Xin Bàn Giao Thiết Bị</div>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="font-size: 20px;">
			<tr>
				<td class="font-bold">Kính gửi: </td>
				<td>Trưởng Phòng Quản Lý Vật Tư Trang Thiết Bị</td>
			</tr>
			<tr>
				<td class="font-bold">Lý do:</td>
				<td>Khoa phòng đang thiếu thiết bị cần bổ sung để đảm bảo hoạt động</td>		
			</tr>
		</table>
	</div>
	<div>
		<h3 class="font-bold">I. Thông tin về thiết bị </h3><br>
		<table border="1" width="100%">
			<tr>
				<td>Mã thiết bị</td>
				<td>Tên thiết bị</td>
				<td>Model</td>
				<td>Số lượng</td>
				<td>Tình trạng</td>
				<td>Năm SX</td>
			</tr>
				<tr>
					<td> {{$device-> dv_id}}</td>
					<td> {{$device->dv_name}}</td>
					<td> {{$device->model}}</td>
					<td> 1 </td>
					<td> Chưa được bàn giao</td>
					<td> {{$device->produce_date}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div>
		<h3 class="font-bold">II. Thông tin vật tư kèm theo</h3><br>
		<table border="1px" width="100%">
			<tr>
				<td width="30%">Tên vật tư</td>
				<td width="10%">Model</td>
				<td width="10%">Số lượng</td>
				<td width="10%">Đơn vị tính</td>
				<td width="10%">Năm sản xuất</td>
				<td width="20%">Tình trạng sử dụng</td>
			</tr>
				@if(isset($acc))
				@foreach($acc as $r)
			<tr>
					<td> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('acc_name')->first() }}</td>
					<td> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('model')->first() }}</td>
					<td> {{$r->amount}}</td>
					<td> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('unit')->first()}}</td>
					<td> {{\App\Accessory::where(['id' => $r->acc_id])->pluck('produce_date')->first() }}</td>
					<td> Chưa sử dụng</td>
			</tr>
				@endforeach
				@endif

		</table>
	</div>
	<div>
		<table width="100%" border="1">
			<tr>
				<td width="50%"></td>
				<td style="text-align: center;">Ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;">Khoa phòng xin bàn giao</td>
			</tr>
			<tr>
				<td><br><br><br><br><br><br></td>
				<td style="text-align: center;" class="font-bold"> {{ \App\Department::where(['id'=>Auth::user()->department_id])->pluck('department_name')->first() }}
				</td>
			</tr>
		</table>
	</div>
</body>
</html>



				