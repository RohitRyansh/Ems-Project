<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set Password Page</title>
</head>
<body>
    <div class="create">
    <form action="{{route('setpassword', $user)}}" method="post" class="Edit">
        @csrf
        <label for="Password">Password</label>
        <input type="password" name="password" id="">
        <span class="errorMessage">
            @error('password')
            {{$message}}     
            @enderror
        </span>
        <label for="ConfirmPassword">Confirm Password</label>
        <input type="password" name="ConfirmPassword" id="">
        <span class="errorMessage">
            @error('ConfirmPassword')
            {{$message}}     
            @enderror
        </span>
        <input type="submit" value="Set Password">
        <input type="hidden" value="{{$user->email}}" name="email">
    </form>
    </div>
</body>
</html>