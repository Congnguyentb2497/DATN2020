@extends('ktv.index')
@section('content')
<style>
input[type=text], input[type=date], select[type=text] {
  width: 520px;
  padding: 5px 5px;
  margin: 5px 0;
  margin-left: 50px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
}

.btn {
  width: 520px;
  background-color: green;
  color: white;
  padding: 7px 7px;
  margin: 5px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
  opacity: 0.6;
}

.btn:hover {
  opacity: 1;
  color: black;

}
.canl{
  position: absolute;
    width: 520px;
    text-align: center;
    background-color: black;
    color: white;
    padding: 7px 7px;
    margin-top: 5px;
    margin-left:353px;
    margin-bottom: 5px;
    border: none;
    border-radius: 4px;
    font-size: 20px;
    opacity: 0.6;
  }
  .canl:hover{
    opacity: 1;
  }
.editKtv {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 300px;
  padding-top: 20px;
}
hr {
  background-color: #4CAF50;
  height: 2px;
  padding: 1px;
  margin-left:  50px;
  margin-right: 50px;
}
label {
  font-size: 20px;
  font-weight: bold;
}
</style>
<div style="font-size: 25px;padding-left: 50px;padding-top: 10px;font-weight: bold; ">Nhập thông tin vật tư</div>
<hr >
  
<div class="editKtv">
  <form action="{{route('accessory.postAdd')}}" method="post">
         @csrf
    <table border="0">
      <tr>
        <td width="50%"><label>Tên vật tư</label></td>
        <td><input type="text"  name="accName" required></td>
      </tr>
       <tr>
        <td><label>Nhà cung cấp</label></td>
        <td> <select name="provider_id" type="text" required>
              <option value="">Mọi nhà cung cấp</option>
              @if(isset($providers))
              @foreach($providers as $rows)
              <option value="{{ $rows->id }}" >
                {{ $rows->provider_name }}
              </option>
              @endforeach
              @endif
            </select></td>
      </tr> 
      <tr>
        <td><label>Số lượng</label></td>
        <td><input type="text"  name="amount" required><br></td>
      </tr>
      <tr>
        <td><label>Đơn vị tính</label></td>
        <td><input type="text"  name="unit" ><br></td>
      </tr>
       <tr>
        <td><label>Ngày nhập kho</label></td>
        <td><input type="date"  name="importDate" ><br></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input class="btn" type="submit" value="Lưu" style="margin-left: 50px" ></input>
        </td>
      </tr>
    </table> 
        <div class="canl"><a href="{{route('accessory.show')}}" style="color: white; text-decoration: none;">Hủy</a></div>

  </form>
</div>
@endsection
