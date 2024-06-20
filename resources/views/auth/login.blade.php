<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('asset/logo.png') }}">
  <title>Login | SIA UD.RAR CRACKERS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="hold-transition login-page" style="background-color: #17a2b8">
<div class="row"> 
  <div class="col-lg-8">
    <img src="{{ asset('asset/login.png') }}" alt="">
  </div>
  <div class="login-box col-lg-4 mx-auto my-auto" style="width: 750px">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ route('login') }}" class="h1"><b>SIA</b> UD. RAR CRACKERS</a>
      </div>
      <div class="card-body">
        {{-- <p class="login-box-msg"></p> --}}
  
        <form action="{{ route('login-proses') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="name" class="form-control" name="user" placeholder="Nama Pengguna">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="showPassword">
                <label for="showPassword">
                  Perlihatkan kata sandi
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div> 
<!-- /.login-box -->
<!-- jQuery -->
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
  document.getElementById('showPassword').addEventListener('change', function() {
    var passwordInput = document.getElementById('password');
    if (this.checked) {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });

  @if($message = Session::get('failed'))
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "{{ $message }}",
      backdrop: false,  
    });
  @endif

  @if($message = Session::get('success'))
    Swal.fire({
      icon: "success",
      text: "{{ $message }}",
      backdrop: false,  
    }).then((result) => {
      if (result.isConfirmed || result.isDismissed) {
        setTimeout(() => {
          window.location.href = "{{ route('login') }}"; 
        }, 500); 
      }
    });
  @endif
</script>
</body>
</html>
