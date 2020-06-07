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
        <th style="width: 16%">Hạng mục công việc</th>
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
        <th colspan="{{ $col }}" style="text-align: center; width: 7%">{{ $month[$i] }}</th>
        @endfor
    </tr>
    <tr>
        <th>Hệ thống khí y tế trung tâm</th>
        @for($i = 1; $i <= 53; $i++)
        <td style="text-align: center; width: 1.5%">{{ 'T'.$i }}</td>
        @endfor
    </tr>
<tr>
<td>{{ trich xuat db }} </td>
@for($i = 1; $i <= 53; $i++)
        <td style="text-align: center; width: 1.5%">

  </td>
        @endfor
</tr>
</table>
@endsection


