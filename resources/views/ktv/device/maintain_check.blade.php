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
    width: 95%;
    margin: 20px;
    margin-top: 60px;
  }
  h2{
    margin-left: 20px;
    font-weight: bold;
  }
  table, tr, td {
    border: 1px solid black;
  }
  .months{
    text-align: center;
    font-weight: bold;
  }
  .week{
    font-size: 15px;
  }
</style>
<h2>Thống Kê Kế Hoạch Kiểm Tra - Bảo Trì - Kiểm Kê Thiết Bị Trong Năm {{ date('Y') }} </h2>
<div class="container2">
  <table border="1" style="font-size: 20px;">
    <thead >
      <table  style="background-color: #FFBF00">
        <tr rowspan="2">
          <td width="22%"><b>Hạng mục công việc</b></td>
          <td class="months">Tháng 1</td>
          <td class="months">Tháng 2</td>
          <td class="months">Tháng 3</td>
          <td class="months">Tháng 4</td>
          <td class="months">Tháng 5</td>
          <td class="months">Tháng 6</td>
          <td class="months">Tháng 7</td>
          <td class="months">Tháng 8</td>
          <td class="months">Tháng 9</td>
          <td class="months">Tháng 10</td>
          <td class="months">Tháng 11</td>
          <td class="months">Tháng 12</td>
        </tr>
        <tr>
          <td style="background-color:#01A9DB; "><b>{{ $device->dv_name }}</b></td>
          <td>
            <table>
              <tr>
                <td class="week">T1</td>
                <td class="week">T2</td>
                <td class="week">T3</td>
                <td class="week">T4</td>
                <td class="week">T5</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T6</td>
                <td class="week">T7</td>
                <td class="week">T8</td>
                <td class="week">T9</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T10</td>
                <td class="week">T11</td>
                <td class="week">T12</td>
                <td class="week">T13</td>
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T14</td>
                <td class="week">T15</td>
                <td class="week">T16</td>
                <td class="week">T17</td>
                <td class="week">T18</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T19</td>
                <td class="week">T20</td>
                <td class="week">T21</td>
                <td class="week">T22</td>
                               
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T23</td> 
                <td class="week">T24</td>
                <td class="week">T25</td>
                <td class="week">T26</td>                
                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T27</td>
                <td class="week">T28</td>
                <td class="week">T29</td>
                <td class="week">T30</td>
                <td class="week">T31</td>
                
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T32</td>
                <td class="week">T33</td>
                <td class="week">T34</td>
                <td class="week">T35</td>
                
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T36</td>
                <td class="week">T37</td>
                <td class="week">T38</td>
                <td class="week">T39</td>
                <td class="week">T40</td>
                
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T41</td>
                <td class="week">T42</td>
                <td class="week">T43</td>
                <td class="week">T44</td>
                
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T45</td>
                <td class="week">T46</td>
                <td class="week">T47</td>
                <td class="week">T48</td>
                           
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td class="week">T49</td>
                <td class="week">T50</td>
                <td class="week">T51</td>
                <td class="week">T52</td>
                <td class="week">T53</td>                
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


