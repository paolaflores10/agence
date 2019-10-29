<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title}} | Florida Global University</title>
    {{ HTML::style('css/bootstrap.min.css')}}
    {{ HTML::style('css/font-awesome.min.css')}}
    {{ HTML::style('css/styles.css')}}
    {{ HTML::style('css/estilo.css')}}
    
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL::to('images/favicon.ico')}}">
    @yield('css')
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img style="height: 30px; display: initial;" src="{{ URL::to('images/fgu_logo.png') }}"> <h5 class="visible-lg-* visible-md-* visible-sm-* hidden-xs" style="display: inline; color: #FFFFFF;">FLORIDA GLOBAL <span>UNIVERSITY</span></h5><h5 class="hidden-lg hidden-md hidden-sm visible-xs-*" style="display: inline; color: #FFFFFF;">FGU</h5></a>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-bars"></em>
                    </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li><a href="{{URL::to('solicitante')}}">Inicio</a></li>
                            <li class="divider"></li>
                            <li><a href="{{URL::to('solicitante/modificarsolicitud')}}">Modificar Solicitud</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
        
    <div class="col-sm-12 col-lg-12 main">
        
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">{{ $title }}</h3>
            </div>
        </div>

        @yield('content')
        
        
    </div>  <!--/.main-->
    {{ HTML::script('js/jquery-1.11.1.min.js')}}
    {{ HTML::script('js/bootstrap.min.js')}}
    {{ HTML::script('js/input_complete_false.js')}}
    @yield('postscript')
</body>
</html>