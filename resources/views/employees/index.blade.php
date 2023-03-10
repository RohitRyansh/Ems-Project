@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <button class="btn btn-secondary dropdown-toggle"  id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
            Leaves
        </button>
        <ul class="dropdown-menu menu">
            @foreach( $leave_status as  $leave)
            <li>
                <a class="dropdown-item" href=" {{ route('employees.index')}}?leave={{ $leave->status }}">{{ $leave->status }} </a>
            </li>
            @endforeach
        </ul> 
        <div class="nav1">
            <button type="button" class="btn btn-primary"><a href="{{ route('employees.attendence.store')}}" class="createButtons">Present</a></button> 
        </div>
    </div>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    @if (session('unsuccess'))
        <p class="dangermessage"> {{ session('unsuccess') }} </p>
    @endif
        <button type="button" class="btn btn-primary"><a href=" {{ route('employees.leaves.create') }} " class="createButtons">Leave</a></button> 
    <div class="content2">
        <table class="table">
            @if ($leaves->count()>0)
                <tr class="table-heading">
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Leave Date</th>
                    <th>Status</th>
                </tr>
                @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->subject }}</td> 
                    <td>{{ $leave->description }}</td> 
                    <td>{{ $leave->leave_date }}</td> 
                    <td>{{ $leave->status }}</td> 
                </tr>
                @endforeach 
            @else
                <h1 style="text-align: center;">No Leave Sent</h1>         
            @endif
        </table>
    </div>
</div>
@endsection