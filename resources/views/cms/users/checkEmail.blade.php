<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert CSS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>forgin password</title>

</head>

<body class="hold-transition login-page">

    <div class="login-logo">
        <a href="{{route('admin.login')}}"><b>Professionals</b>System</a>
    </div>
    @if (session()->has('status'))
    @if (session('status'))
    <script>
        $(document).ready(function() {
                                  swal({
                                      icon: "success",
                                      text: "Check the message in your email !"
                                  })
                              });
    </script>

    @endif
    @endif
    <div class="login-box card"
        style="padding:30px; height:250px; width:500px; border-radius: 25px; background-color: white ;">
        <div class="login-logo">
            <a href="#"><b>forgin password</b></a>
        </div>


        <form action="{{route('email.check')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
                @error('email')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                @enderror

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>