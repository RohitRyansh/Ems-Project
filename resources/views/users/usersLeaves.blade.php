@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="allUser">
        <button class="btn btn-secondary dropdown-toggle"  id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
            Leaves
        </button>
        <ul class="dropdown-menu menu">
            @foreach( $leave_status as  $leave)
            <li>
                <a class="dropdown-item" href=" {{ route('users.leaves')}}?leave={{ $leave->status }}">{{ $leave->status }} </a>
            </li>
            @endforeach
        </ul> 
    </div>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    @if (session('unsuccess'))
        <p class="dangermessage"> {{ session('unsuccess') }} </p>
    @endif
    <table class="table">
        @if ($leaves->count()>0)   
            <tr class="table-heading">
                <th>Name</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            @foreach ($leaves as  $leave)
            <tr>
                <td>{{ $leave->user->full_name }}</td>
                <td class="table-data"> {{ $leave->subject }}</td>
                <td> {{ $leave->description }} </td>
                <td> {{ $leave->leave_date }} </td>
                <td> {{ $leave->status }} </td>
            </tr>
            @endforeach
        @else
            <h1 style="text-align: center;">No Leave Exist</h1>        
        @endif
    </table>
</div>
@endsection