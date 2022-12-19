
@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Users</h2>
        </div>
        <div class="nav1">
            <button type="button" class="btn btn-primary"><a href=" {{ route('users.create') }} " class="createButtons">Create User</a></button> 
        </div>
    </div>
    <div class="allUser">
        <form action=" {{  route('users.index')}}?{{ request()->getQueryString() }} " method="get">
            <div class="d-flex">
                <input class="form-control" type="text" name="search" placeholder="Search by Name">
                <i class="bi bi-search"></i>
            </div>
        </form>
        <div class="all2">
            <div class="dropdown">   
                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                    Latest Created Date
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href=" {{ route('users.index')}}?newest=latest">Newest</a></li>
                    <li><a class="dropdown-item" href=" {{ route('users.index')}}">Oldest</a></li>
                </ul>
            </div>
        </div>  
    </div>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    @if (session('unsuccess'))
        <p class="dangermessage"> {{ session('unsuccess') }} </p>
    @endif
    <div class="content2">
        @if ($users->count()>0)
        <table class="table">
            <tr class="table-heading">
                <th>User Name</th>
                <th>Type of User</th>
                <th>Created Date</th>
                <th>Status</th>
                <th></th>
            </tr>
            @foreach ($users as  $user)
            <tr>
                <td class="table-data"> {{ $user->full_name }}
                    <br> {{ $user->email }} </td>
                <td> {{ $user->role->name }} </td>
                <td> {{ $user->created_at }} </td>
                <td>
                    @if($user->status == true)
                    <span class="badge text-bg-success">
                        <p>active</p>
                    </span>
                    @else
                    <span class="badge text-bg-danger">
                        <p>deactive</p>
                    </span> 
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button class="icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        
                        <ul class="dropdown-menu"> 
                            <li class="drop-items">
                                <div class="drop-items-icon">
                                    <i class="bi bi-wrench-adjustable"></i>
                                    <a href=" {{  route('users.edit', $user) }} ">Edit User</a>
                                </div>
                            </li>
                            <li>
                                <form action=" {{ route('users.status', $user)}} " method="POST">
                                    @csrf
                                    @if ($user->status == true)
                                        <input type="submit" name="Deactive" value="Deactive" class="deletebuttons">
                                    @else
                                        <input type="submit" name="Active" value="Active" class="deletebuttons">
                                    @endif
                                </form>
                            </li>

                            <li class="drop-items">
                                <div class="drop-items-icon">
                                    <i class="bi bi-wrench-adjustable"></i>
                                    <form action=" {{ route('users.delete', $user) }} " method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="deletebuttons">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                            
                </td>
            </tr>
            @endforeach
        </table>
        @else
            <h1 style="text-align: center;">No User Exist</h1>      
        @endif
    </div>
</div>
@endsection
    

