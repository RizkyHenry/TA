<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('/from-login.jpg') no-repeat center center fixed;
        }
        .mb-3 {
            max-width: 100%;
            width: 400px;
            padding: 20px;
            background-color: transparent;
            backdrop-filter: blur(50px);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-top: 20px;
            max-width: 100%;
            width: 400px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }
        .alert-success {
        --bs-alert-color: #fff;
        --bs-alert-bg: #253aaa;
        --bs-alert-border-color: #fff;
        text-align:center;
        width: 100%;
        }
        .alert-warning{
        --bs-alert-bg: #e81111;
        --bs-alert-color:#fff;
        }
    </style>
</head>

<!--  -->
@if($errors->any())
@foreach($errors->all() as $error)
{{ $errors }}
@endforeach
@endif
<!--  -->

<body>
    <form method="POST" action="{{ route('login') }}">
        @if (Session::has('success'))
    <div id="success-alert" class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
@if (Session::has('fail'))
    <div id="success-alert" class="alert alert-warning">
        {{ Session::get('fail') }}
    </div>
@endif
        @csrf
        <div class="mb-3">
            <h2>LOGIN</h2>
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
                           

  <script>
    // Menghilangkan alert setelah beberapa detik
    const alertElement = document.getElementById('success-alert');
    if (alertElement) {
        setTimeout(() => {
            alertElement.style.display = 'none';
        }, 3000); // hilangkan setelah 3 detik
    }
    </script>
</body>
</html>
