<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">

    <title>MuColLib - The Music Collection Library</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ URL::asset('bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('bootstrap/css/mucollib.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MuColLib</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li>{{ link_to("artist", "All Artists"); }}</li>
            <li>{{ link_to("artist?begins=A", "A" ); }}</li>
            <li>{{ link_to("artist?begins=B", "B" ); }}</li>
            <li>{{ link_to("artist?begins=C", "C" ); }}</li>
            <li>{{ link_to("artist?begins=D", "D" ); }}</li>
            <li>{{ link_to("artist?begins=E", "E" ); }}</li>
            <li>{{ link_to("artist?begins=F", "F" ); }}</li>
            <li>{{ link_to("artist?begins=G", "G" ); }}</li>
            <li>{{ link_to("artist?begins=H", "H" ); }}</li>
            <li>{{ link_to("artist?begins=I", "I" ); }}</li>
            <li>{{ link_to("artist?begins=J", "J" ); }}</li>
            <li>{{ link_to("artist?begins=K", "K" ); }}</li>
            <li>{{ link_to("artist?begins=L", "L" ); }}</li>
            <li>{{ link_to("artist?begins=M", "M" ); }}</li>
            <li>{{ link_to("artist?begins=N", "N" ); }}</li>
            <li>{{ link_to("artist?begins=O", "O" ); }}</li>
            <li>{{ link_to("artist?begins=P", "P" ); }}</li>
            <li>{{ link_to("artist?begins=Q", "Q" ); }}</li>
            <li>{{ link_to("artist?begins=R", "R" ); }}</li>
            <li>{{ link_to("artist?begins=S", "S" ); }}</li>
            <li>{{ link_to("artist?begins=T", "T" ); }}</li>
            <li>{{ link_to("artist?begins=U", "U" ); }}</li>
            <li>{{ link_to("artist?begins=V", "V" ); }}</li>
            <li>{{ link_to("artist?begins=W", "W" ); }}</li>
            <li>{{ link_to("artist?begins=X", "X" ); }}</li>
            <li>{{ link_to("artist?begins=Y", "Y" ); }}</li>
            <li>{{ link_to("artist?begins=Z", "Z" ); }}</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      @yield('content')

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ URL::asset('bootstrap/js/vendor/jquery.min.js') }}"><\/script>')</script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ URL::asset('bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>
  </body>
</html>
