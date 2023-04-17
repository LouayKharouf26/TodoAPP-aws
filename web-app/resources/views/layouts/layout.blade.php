<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
   
    </head>
    <body>
 <!--   <div id="navbar">
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">Home</a></li>
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</div>-->
<nav class="navbar">
  <div class="container-fluid">
    <p class=" todo"><i class="fa fa-list-alt" aria-hidden="true"></i> ToDo</p>
    @if(Auth::check())
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
    <p class="nav-link" >{{ Auth::user()->name }}<br>{{ Auth::user()->email }}</p>
  
    <a class="nav-link" href="{{url('/addtasks')}}"><i class="fa fa-calendar" aria-hidden="true"></i> Today</a>
    <a class="nav-link" href="{{url('/donetasks')}}"><i class="fa fa-check" aria-hidden="true"></i> Done</a>
</li>
    @else 
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">

        
          <a class="nav-link" href="{{url('/signup')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a>
     
          <a class="nav-link " aria-current="page" href="{{url('/signin')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>

      
          <a class="nav-link" href="{{url('/addtasks')}}"><i class="fa fa-calendar" aria-hidden="true"></i> Today</a>
        
          <a class="nav-link" href="{{url('/donetasks')}}"><i class="fa fa-check" aria-hidden="true"></i> Done</a>
</li>
@endif
        <hr>
        <li class="nav-item add">
        <a class="nav-link " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
          <!--<a class="nav-link " href="#"> <i class="fa fa-plus" aria-hidden="true"></i>  Add list </a>-->
       
</li>
       
      </ul>
     
    </div>
  </div>
</nav>
@yield('signin')
@yield('signup')
@yield('addtasks')
    </body>
</html>
