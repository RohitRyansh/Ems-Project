@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{  route ('users.index')  }} ">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>
    <div class="create">
        @if (session('success'))
            <p class="succesmessage"> {{ session('success') }} </p>
         @endif
        <form action=" {{ route('users.store') }} " method="post" class="createForm">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter First Name" value="{{old('first_name')}}" required>
                <span class="errorMessage">
                    @error('first_name')
                     {{ $message }}      
                    @enderror
                </span>
            </div>

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Last Name" value="{{old('last_name')}}" required>
                <span class="errorMessage">
                    @error('last_name')
                     {{ $message }}      
                    @enderror
                </span>
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Email Address" value="{{old('email')}}" required>
                <span class="errorMessage">
                    @error('email')
                     {{ $message }}      
                    @enderror
                </span>
            </div>

            <div class="saveButtons">
                <button type="submit" value="create" name="create" class="btn btn-secondary">Invite User</button>
                <button type="submit" value="create_another" name="create" class="btn btn-secondary">Invite User & Invite Another</button>        
                <a href=" {{ route('users.index')  }} " class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection