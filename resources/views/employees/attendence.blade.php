@extends('layouts.main')
@section('content')
<div class="allcontent">
    <form action=" {{  route('employees.attendence')}}?{{ request()->getQueryString() }} " method="get">
        <div class="d-flex">
            <input class="form-control" type="text" name="search" placeholder="Search by Date">
            <i class="bi bi-search"></i>
        </div>
    </form>
    <div class="content2">
        <table class="table">
            @if ($attendences->count()>0)
                <tr class="table-heading">
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                @foreach ($attendences as $attendence)
                <tr>
                    <td>{{ $attendence->date }}</td> 
                    <td>{{ $attendence->status }}</td> 
                </tr>
                @endforeach 
            @else
                <h1 style="text-align: center;">No Attendence Exists</h1>         
            @endif
        </table>
    </div>
</div>
@endsection