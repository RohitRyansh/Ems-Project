@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{  route ('employees.index')  }} ">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page">Send Leave</li>
        </ol>
    </nav>
    @if (session('success'))
            <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    <div class="create">
        <form action="{{ route ('employees.leaves.store') }}" method="post" class="createForm">
            @csrf
            
            <span class="errorMessage">
                @if($errors->all())
                @foreach ($errors->all() as $error) 
                {{ $error }}      
                @endforeach
                @endif
            </span>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" placeholder="Enter Subject" required>
                <span class="errorMessage">
                    @error('subject')
                     {{ $message }}      
                    @enderror
                </span>
            </div>
                
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <textarea name="description" id="" cols="50" rows="15" required></textarea>
                <span class="errorMessage">
                    @error('description')
                     {{ $message }}      
                    @enderror
                </span>
            </div>
                
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Leave</label>
                <input type="date" name="leave_date" class="form-control" id="exampleFormControlInput1" required>
                <span class="errorMessage">
                    @error('leave_date')
                        {{ $message }}      
                    @enderror
                </span>
            </div>

            <div class="saveButtons">
                <button type="submit" value="send" name="submit" class="btn btn-secondary">Send</button>
                <a href=" {{ route('employees.index')  }} " class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
