@extends('ktv.index')
@section('content')
@php
$month = [
    'January', 
    'February', 
    'March', 
    'April', 
    'May', 
    'June', 
    'July', 
    'August', 
    'September', 
    'Octorber', 
    'November', 
    'December'
];
@endphp
<table width="200%" border="1">
    <tr>
        <th style="width: 20%;background-color: yellow;">Hạng mục công việc</th>
        @for($i = 0; $i < count($month); $i++)
        @php
            if($i == 0 || $i == 3 || $i == 6 || $i == 8 || $i == 11)
            {
                $col = 5;
            }
            else{
                $col = 4;
            }
        @endphp
        <th colspan="{{ $col }}" style="text-align: center; width: 7%;background-color: yellow;">{{ $month[$i] }}</th>
        @endfor
    </tr>
    <tr>
        <th style="background-color: blue;">{{$dev ->dv_name}}</th>
        @for($i = 1; $i <= 53; $i++)
        <td style="text-align: center; width: 1.5%;background-color: yellow;">{{ 'T'.$i }}</td>
        @endfor
    </tr>
    @foreach($dv as $row)
<tr>
<td>{{ $row -> scheduleAct}}</td>
@for($i = 1; $i <= 53; $i++)
        <td style="text-align: center; width: 1.5%;cursor: pointer;"> <button id="{{ $i }}" class="btn1" style="height: 20px;"></button></td>
        @endfor
</tr>
</table>
@endsection


