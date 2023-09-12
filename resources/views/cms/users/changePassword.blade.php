<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Change Password </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert CSS -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="hold-transition login-page">

  @if (session()->has('status'))
  @if (session('status'))
  <script>
    $(document).ready(function() {
                              swal({
                                  icon: "success",
                                  text: "Successful password change !"
                              }).then(function () {
                                window.location = "{{ route("admin.login") }}";
                                })
                          });
  </script>
  @else
  <script>
    swal({
                                    title: "Error",
                                    text: "Faild for change the password !",
                                    type: "error",
                                    confirmButtonColor: "#dc3545",
                                    });
  </script>
  @endif
  @endif


  <div class="login-box">
    <div class="login-logo">
      <a href="{{route('admin.login')}}"><b>Professionals</b>System</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password</p>

        <form action="{{route('user.Changepassword')}}" method="post">
          @csrf
          @error('email')
          <small class="text-danger">
            {{$message}}
          </small>
          @enderror
          <div class="input-group mb-3">

            <input type="hidden" class="form-control" value="{{session('email_reset')}}" name="email">

          </div>

          @error('password')
          <small class="text-danger">
            {{$message}}
          </small>

          @enderror
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" value="{{old('password')}}"
              placeholder="new Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock "></span>
              </div>
            </div>
          </div>

          @error('password_confirmation')
          <span class="fas fa-lock danger">
            {{$message}}
          </span>
          @enderror
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password_confirmation"
              value="{{old('password_confirmation')}}" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
</body>
<script>
  function login() {
       const data = {
      email: document.getElementById('email').value,
      password: document.getElementById('password').value,
      remember_me: document.getElementById('remember').checked
    };
    
    fetch('https://phplaravel-1025967-3619615.cloudwaysapps.com/admin/login',

     {
      method: 'POST',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         'Content-Type': 'application/json'
        },
      body: JSON.stringify(data),
    }).then( response=>{ return response.json();})
   .then(response => {
    // console.log(response.message);
  // const status = response.status;
  // response.json().then(data => {
  
  const message = response.message;
  //  console.log(response);
  if(message == 'success'){
    window.location.href = 'https://phplaravel-1025967-3619615.cloudwaysapps.com/admin';
  }else{
   
    const codeMessage = ' <div class="alert alert-warning alert-dismissible fade show" role="alert">'+
    '<i class="fas fa-exclamation-triangle"></i>'+
     ' <strong>Login error!</strong>  The email and password do not exist.'+
     ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
     '   <span aria-hidden="true">&times;</span>'+
     ' </button>'+
    '</div>';
    document.getElementById('faildLogin').innerHTML = codeMessage;

     document.getElementById('errorEmail').innerHTML = '@foreach($errors->get('email') as $message)'+
    '<p style="color:red;">{{$message}}</p>'+
   '@endforeach;';


  }
  // });

  })
    .catch(error => {
    console.error(error+":catch");
    // handle any errors here
    });


  }

  


</script>

</html>