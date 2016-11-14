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
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::asset('') }}">MuColLib</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>{{ link_to("artists", "All Artists") }}</li>
                    <li>{{ link_to("artists?begins=A", "A" ) }}</li>
                    <li>{{ link_to("artists?begins=B", "B" ) }}</li>
                    <li>{{ link_to("artists?begins=C", "C" ) }}</li>
                    <li>{{ link_to("artists?begins=D", "D" ) }}</li>
                    <li>{{ link_to("artists?begins=E", "E" ) }}</li>
                    <li>{{ link_to("artists?begins=F", "F" ) }}</li>
                    <li>{{ link_to("artists?begins=G", "G" ) }}</li>
                    <li>{{ link_to("artists?begins=H", "H" ) }}</li>
                    <li>{{ link_to("artists?begins=I", "I" ) }}</li>
                    <li>{{ link_to("artists?begins=J", "J" ) }}</li>
                    <li>{{ link_to("artists?begins=K", "K" ) }}</li>
                    <li>{{ link_to("artists?begins=L", "L" ) }}</li>
                    <li>{{ link_to("artists?begins=M", "M" ) }}</li>
                    <li>{{ link_to("artists?begins=N", "N" ) }}</li>
                    <li>{{ link_to("artists?begins=O", "O" ) }}</li>
                    <li>{{ link_to("artists?begins=P", "P" ) }}</li>
                    <li>{{ link_to("artists?begins=Q", "Q" ) }}</li>
                    <li>{{ link_to("artists?begins=R", "R" ) }}</li>
                    <li>{{ link_to("artists?begins=S", "S" ) }}</li>
                    <li>{{ link_to("artists?begins=T", "T" ) }}</li>
                    <li>{{ link_to("artists?begins=U", "U" ) }}</li>
                    <li>{{ link_to("artists?begins=V", "V" ) }}</li>
                    <li>{{ link_to("artists?begins=W", "W" ) }}</li>
                    <li>{{ link_to("artists?begins=X", "X" ) }}</li>
                    <li>{{ link_to("artists?begins=Y", "Y" ) }}</li>
                    <li>{{ link_to("artists?begins=Z", "Z" ) }}</li>
                </ul>
            </div><!--/.nav-collapse -->
        </nav>  

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
