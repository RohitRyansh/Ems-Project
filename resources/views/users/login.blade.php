<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Login Page</title>
</head>
<body>
    <main>
        <div class="loginpage">
            <h1>
                Account Login
            </h1>
            @if (session('error'))
                <span> {{ session('error') }} </span>
            @endif
            @if (session('status'))
                <p class="succesmessage"> {{ session('status') }} </p>
            @endif
            <form action=" {{  route ('users.authentication')  }} " method="post">
                @csrf
                <div class="formStyle">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" required>
                    <span class="errorMessage">
                        @error('email')
                         {{ $message }}      
                        @enderror
                    </span>
                    <label for="">Password</label>
                    <input type="password" name="password" id="" required>
                    <span class="errorMessage">
                        @error('password')
                         {{ $message }}      
                        @enderror
                    </span>
                    <div>
                        <input type="checkbox" name="" id=""> Remember me
                    </div>
                    <input type="submit" name="login" id="" value="Log in"> 
                </div>
            </form>
        </div>
    </main>
</body>
</html>