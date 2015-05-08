<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("head")
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Buang Library</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">


    <!-- Optional theme -->
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/site.css">
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    @yield("styles")
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default">
     <div class="col-sm-2 col-md-2 pull-right" style="margin-right: 0px;">
       <form class="navbar-form" role="search" action ="/search">
       <div class="input-group">
       <input type="text" class="form-control" placeholder="Search" name="query" id="query">
       <div class="input-group-btn">
       <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
       </div>
       </div>
       </form>
     </div>
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">Buang Library</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/about-us') }}">About Us</a></li>
            <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check()==false)
              <li><a href="{{ url('/auth/login') }}">Login</a></li>
              <li><a href="{{ url('/auth/register') }}">Register</a></li>
            @else
              <li><a href="{{ url('/admin') }}">My Account</a></li>
            @endif
          </ul>
            {{-- <li> --}}
            {{-- </li> --}}
          {{-- </ul> --}}
        </div>
      </div>
    </nav>
    @yield("content")
    @include("site.includes.footer")
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-ui.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
{{--     <script src="/js/modernizr.js"></script>
    <script src="/js/main.js"></script> --}}
    @yield("scripts")
  </body>
</html>


