<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
  <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">

  <!--Pulling Awesome Font -->
  <link
    href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
    rel="stylesheet">

  <link rel="stylesheet"
  	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>

  <style>
    div.container {
      text-align: center;
    }
    div>img {
      margin: 110px 0 12px 0;
    }
    .form-control {
      display: inline-block;
      width: auto;
      position: relative;
    }
  </style>

  <script>
    $(function() {
      $(":text").keydown(function() {
        $(".alert-danger").fadeOut(0);
      });
      $("#password").keydown(function() {
        $(".alert-danger").fadeOut(0);
      });
    });
  </script>

</head>
<body>
  <div class="container">
    <img class="img-rounded" src="{{asset('images/logo.png')}}"
      alt="KidsCity Logo" width="20%" height="auto">
  </div>

  <div class="container">
    @if ($errors->any())
      <div class="alert alert-danger" style="display: inline-block;">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form id="login_form" name="login_form" action="{{url('/admin/login')}}"
      method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <!-- <label for="username">Phone Number:</label> -->
        <input type="text" id="username" class="form-control"
          placeholder="Username" name="phone_number"
          value="{{ old('phone_number') }}" autofocus>
      </div>

      <div class="form-group">
        <!-- <label for="password">Password:</label> -->
        <input type="password" id="password" class="form-control"
          placeholder="Password" name="password">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Login
        </button>
      </div>

    </form>

  </div>
</body>
</html>
