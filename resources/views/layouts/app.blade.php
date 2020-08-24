<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Lets go') }}</title>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <!-- CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  {{-- link style and script of calendar --}}
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.css">

</head>

<script>
  window.addEventListener('load', function() {
    confirm_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if ($('#new_password').val() != $('#confirm_password').val()) {
        responseBox.innerHTML = "&cross; does not match password";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)

    new_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if (new_password.length < 8) {
        responseBox.innerHTML = "&cross; must be at least 8 characters";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)
  }, false)

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#image')
          .attr('src', e.target.result)
          .width(120)
          .height(120);
      };
      reader.readAsDataURL(input.files[0]);
    }
</head>

<script>
  window.addEventListener('load', function() {
    confirm_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if ($('#new_password').val() != $('#confirm_password').val()) {
        responseBox.innerHTML = "&cross; does not match password";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)

    new_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if (new_password.length < 8) {
        responseBox.innerHTML = "&cross; must be at least 8 characters";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)
  }, false)

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#image')
          .attr('src', e.target.result)
          .width(120)
          .height(120);
      };
      reader.readAsDataURL(input.files[0]);
    }

  }
</script>
<script>
  window.addEventListener('load', function() {
    confirm_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if ($('#new_password').val() != $('#confirm_password').val()) {
        responseBox.innerHTML = "&cross; does not match password";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)


  }
</script>
<script>
  window.addEventListener('load', function() {
    confirm_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if ($('#new_password').val() != $('#confirm_password').val()) {
        responseBox.innerHTML = "&cross; does not match password";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)

    new_password.addEventListener('keyup', function(event) {
      var new_password = event.target.value;
      var responseBox = event.target.nextElementSibling;
      if (new_password.length < 8) {
        responseBox.innerHTML = "&cross; must be at least 8 characters";
        responseBox.style.color = "red";
      } else {
        responseBox.innerHTML = "";

      }
    }, false)
  }, false)

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#image')
          .attr('src', e.target.result)
          .width(120)
          .height(120);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<body>
  <div id="app">
    @if(Auth::check())
    <nav class="navbar navbar-expand-md  navbar-dark" style="background-color: teal;">
      <!-- Brand -->
      <a class="navbar-brand" href="{{url('/home')}}">Let's go</a>


      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="nav navbar-nav ml-auto">

          <li class="nav-item"><a class="nav-link text-uppercase line" href="{{ url('exploreEvent') }}" id="city">Explorer Event</a></li>
          <li class="nav-item"><a class="nav-link text-uppercase line" href="{{ url('event') }}">Your Event</a></li>
          @if(Auth::user()->role == 1)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-uppercase line" href="#" id="navbardrop" data-toggle="dropdown">
              MANAGE
            </a>
            <div class="dropdown-menu" style="background-color: teal;">
              <a class="dropdown-item text-uppercase text-warning line" href="{{{route('viewevent')}}}">EVENT</a>
              <a class="dropdown-item text-uppercase text-warning line" href="{{route('categories.index')}}">CATEGORY</a>
            </div>
            @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-uppercase line" href="#" id="navbardrop" data-toggle="dropdown">
              {{Auth::user()->firstname}}
            </a>
            <div class="dropdown-menu down" style="background-color: teal;">
              <a data-toggle="modal" data-target="#userPopup" class="dropdown-item text-uppercase text-warning line" href="#">Profile</a>
              <a class="dropdown-item text-uppercase text-warning line" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
        </ul>
      </div>
    </nav>

    <div class="container">
      <!-- The Modal -->
      <div class="modal fade" id="userPopup">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title text-center">Edit User</h4>
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>

            <div class="modal-body">

              <form method="POST" action="{{route('editUser',Auth::user()->id)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group">

                  <input type="text" value="{{Auth::user()->firstname}}" class="form-control" name="firstname">
                </div>
                <div class="form-group">

                  <input type="text" value="{{Auth::user()->lastname}}" class="form-control" name="lastname">
                </div>

                <div class="form-group">

                  <select name="city" class="form-control" id="searchCity">
                    <option value="">-----Select City-----</option>
                    
                    <option value="{{ Auth::user()->city}}" {{ (Auth::user()->city) ? "selected" : "" }}>{{ Auth::user()->city}}</option>
                   
                  </select>
                  </div>
                <div class="form-row">
                  <div class="form-group col-md-7">
                    <div class="form-group">
                      <input type="mail" value="{{Auth::user()->email}}" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" placeholder="New Password...." class="form-control" name="new_password" id="new_password">
                      <span></span>
                    </div>
                    <div class="form-group">

                      <input type="password" placeholder="Confirm Password...." class="form-control" name="confirm_password" id="confirm_password">
                      <span></span>
                    </div>
                  </div>
                  <div class="form-group col-md-5">
                    <img class="mx-auto d-block" src="../images/{{Auth::user()->profile}}" alt="..." width="105" id="image" style="border-radius: 105px;" height="105" alt="Avatar" onchange="readURL(this)">
                    <div class="image-upload text-center">
                      <label for="file-input">
                        <i class="material-icons m-2 text-primary">create</i>
                      </label>

                      <input id="file-input" type="file" name="profile" hidden onchange="readURL(this)">
                      <a href="{{route('delete',Auth::user()->id)}}"><i class="material-icons m-2 text-danger">delete</i></a>
                    </div>
                  </div>
                </div>

                <a data-dismiss="modal" class="closeModal">DISCARD</a>
                &nbsp;
                <input type="submit" value="UPDATE" class="createBtn text-warning">
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  <main class="py-4">
    @yield('content')
    <script>
      < script src = "js/jquery.min.js" >
    </script>
    </script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </script>
  </main>
  </div>

</body>

</html>