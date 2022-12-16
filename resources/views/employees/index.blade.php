@extends('layouts.main')
@section('content')
<div class="allcontent">
        <div class="nav">
            <div>
                <h2>Employee</h2>
            </div>
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
        <tr class="table-heading">
            <th>Subject</th>
            <th>Description</th>
            <th>Leave Date</th>
            <th>Status</th>
        </tr>
        @if ($leaves)
        @foreach ($leaves as $leave)
        <tr>
            <td>{{ $leave->subject }}</td> 
            <td>{{ $leave->description }}</td> 
            <td>{{ $leave->leave_date }}</td> 
            <td>{{ $leave->status }}</td> 
        </tr>
        @endforeach        
        @endif
    </div>
</div>
@endsection