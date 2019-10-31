<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba</title>
    {{ HTML::style('css/bootstrap.min.css')}}
    {{ HTML::style('css/font-awesome.min.css')}}
    {{ HTML::style('css/styles.css')}}
    {{ HTML::style('css/estilo.css')}}
    
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><img style="height: 30px; display: initial;"> <h5 class="visible-lg-* visible-md-* visible-sm-* hidden-xs" style="display: inline; color: #FFFFFF;">Prueba <span>Agence</span></h5><h5 class="hidden-lg hidden-md hidden-sm visible-xs-*" style="display: inline; color: #FFFFFF;"></h5></a>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-asterisk"></em>
                    </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li><a href="{{ URL::to('exit') }}"><i class="fa fa-sign-out fa-fw text-info"></i> {{ Lang::get('translate.exit')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <ul class="nav menu">
            <li>
                <a href="{{URL::to('inicio')}}"> Inicio</a>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{URL::to('comercial/inicio')}}">Comercial</a>
            </li>
                <!-- /.nav-second-level -->
        </ul>
        <!-- <ul class="nav menu">
            <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
            <li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
            <li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
            <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
                    </a></li>
                    <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
                    </a></li>
                    <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
                    </a></li>
                </ul>
            </li>
            <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul> -->
    </div><!--/.sidebar-->
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"></h3>
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
