@extends('layouts.main')
@section('content')
<div class="allcontent">
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
                <th>Action</th>
            </tr>
            @foreach ($leaves as $leave)
            <tr>
                <td>{{ $leave->user->full_name }}</td>
                <td class="table-data"> {{ $leave->subject }}</td>
                <td> {{ $leave->description }} </td>
                <td> {{ $leave->leave_date }} </td>
                <td> {{ $leave->status }} </td>
                <td>
                    <button type="button" class="btn btn-primary"><a href=" {{ route('leaves.request.store', $leave) }} " class="createButtons">Approved</a></button> 
                    <button type="button" class="btn btn-primary"><a href=" {{ route('leaves.request.delete', $leave) }} " class="createButtons">Reject</a></button> 
                </td>
            </tr>
            @endforeach
        @else
            <h1 style="text-align: center;">No Request Available</h1>       
        @endif
    </table>
</div>
@endsection