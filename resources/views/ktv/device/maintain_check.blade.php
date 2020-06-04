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
          <td style="background-color:#01A9DB; "><b>{{ $device->dv_name }}</b></td>
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
                <td>T6</td>
                <td>T7</td>
                <td>T8</td>
                <td>T9</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T10</td>
                <td>T11</td>
                <td>T12</td>
                <td>T13</td>
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T14</td>
                <td>T15</td>
                <td>T16</td>
                <td>T17</td>
                <td>T18</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T19</td>
                <td>T20</td>
                <td>T21</td>
                <td>T22</td>
                <td>T23</td>                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T24</td>
                <td>T25</td>
                <td>T26</td>                
                <td>T27</td>
                <td>T28</td>
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T29</td>
                <td>T30</td>
                <td>T31</td>
                <td>T32</td>
                <td>T33</td>
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T34</td>
                <td>T35</td>
                <td>T36</td>
                <td>T37</td>
                <td>T38</td>
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T39</td>
                <td>T40</td>
                <td>T41</td>
                <td>T342</td>
                <td>T43</td>
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T44</td>
                <td>T45</td>
                <td>T46</td>
                <td>T47</td>
                <td>T48</td>
                                
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td>T49</td>
                <td>T50</td>
                <td>T51</td>
                <td>T52</td>
                <td>T53</td>                
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


