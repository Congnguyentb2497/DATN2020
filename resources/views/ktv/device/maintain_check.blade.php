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
<h2>Thống Kê Kế Hoạch Kiểm Tra - Bảo Trì - Kiểm Kê Thiết Bị Trong Năm {{ date('Y') }} </h2>
<div class="container2">
  <table border="1" style="font-size: 20px;">
    <thead style="background-color: #FFBF00">
      <table>
        <tr rowspan="2">
          <td>Hạng mục công việc</td>
          <td>Tháng 1</td>
          <td>Tháng 2</td>
          <td>Tháng 3</td>
          <td>Tháng 4</td>
          <td>Tháng 5</td>
          <td>Tháng 6</td>
          <td>Tháng 7</td>
          <td>Tháng 8</td>
          <td>Tháng 9</td>
          <td>Tháng 10</td>
          <td>Tháng 11</td>
          <td>Tháng 12</td>
        </tr>
        <tr>
          <td style="background-color:#01A9DB; "><b>{{ $device->dv_name}}</b></td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T1</td>
                <td>T2</td>
                <td>T3</td>
                <td>T4</td>
                <td>T5</td>                
              </tr>
            </table>
          </td>
        </tr>

      </table>
      
    </thead>
    <tbody></tbody>
  </table>
  
</div>
@endsection


