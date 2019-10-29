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
<!--             <li class="parent "><a data-toggle="collapse" href="#sub-item-9">
                <em class="fa fa-pencil-square-o">&nbsp;</em> {{ Lang::get('translate.admision')}} <span data-toggle="collapse" href="#sub-item-9" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-9">
                    <li>
                        <a href="{{URL::to('admision/solicitudes')}}">{{ Lang::get('translate.solicitante')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('inicio')}}">{{ Lang::get('translate.traslado')}}</a>
                    </li>
                </ul>
            </li> -->

            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-database">&nbsp;</em> {{ Lang::get('translate.admin_datos')}} <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-1">
                    <li>
                        <a href="{{URL::to('admin/verlapso')}}">{{ Lang::get('translate.lapso')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('materias/tipoprograma',array('link' => Crypt::encrypt(1)))}}">{{ Lang::get('translate.programas')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('materias/unidades')}}">{{ Lang::get('translate.unidades')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('materias/tipoprograma',array('link' => Crypt::encrypt(2)))}}">{{ Lang::get('translate.pensum')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('autoridades/verautoridad')}}">{{ Lang::get('translate.autoridades')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('matrizinterna/vermatriz')}}">{{ Lang::get('translate.matrices')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('estudiantes/movimientos')}}">{{ Lang::get('translate.movimientos')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('academico/constancias')}}">{{ Lang::get('translate.constancias')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admision/requisitos')}}">{{ Lang::get('translate.requisitos_ins')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('autoridades/crearconvenio')}}">Convenio</a>
                    </li>
                </ul>
            </li>
            @endif
            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-pencil-square-o">&nbsp;</em> {{ Lang::get('translate.procesos_acad')}} <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-2">
                    <li>
                        <a href="{{URL::to('ofertas/crearoferta')}}">{{ Lang::get('translate.crear_oferta')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('ofertas/listado')}}">{{ Lang::get('translate.ver_oferta')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('ofertas/inscripciones')}}">{{ Lang::get('translate.inscripciones')}}</a>
                    </li>
                    <!-- <li>
                        <a href="{{URL::to('ofertas/nivelacion')}}">{{ Lang::get('translate.nivelacion')}}</a>
                    </li> -->
                    <li>
                        <a href="{{URL::to('academico/historial')}}">{{ Lang::get('translate.historial')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('academico/solicitudes-constancias')}}">{{ Lang::get('translate.solicitudes_constancias')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('matrizinterna/transferencia')}}">{{ Lang::get('translate.transferencia')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('academico/matriculacion')}}">{{ Lang::get('translate.matriculacion')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 4) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-3">
                <em class="fa fa-usd">&nbsp;</em> {{ Lang::get('translate.procesos_admin')}} <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-3">
                    <li>
                        <a href="{{URL::to('administrativos/veradministrativo')}}">Proyecci&oacute;n de Costo</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/ajustarpago')}}">Ajuste de Financiamiento</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/generardeuda')}}">Consulta de Pag. Estudiante</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/relacionpagos')}}">Estado Admin. Estudiante</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/solvencia')}}">Actualizaci&oacute;n de Solvencias</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/tipopago')}}">Metodos de Pago</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/tipofinanza')}}">Tipos de Financiamiento</a>
                    </li>
                    <li>
                        <a href="{{URL::to('administrativos/conceptoadmon')}}">{{ Lang::get('translate.conceptos_adm')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-4">
                <em class="fa fa-male">&nbsp;</em> {{ Lang::get('translate.facilitadores')}} <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-4">
                    <li>
                        <a href="{{URL::to('facilitadores/crearfacilitador')}}">{{ Lang::get('translate.crear_fac')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('facilitadores/verfacilitadores')}}">{{ Lang::get('translate.ver_fac')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3 || Session::get('estatus') == 4) && Session::get('nivel') == 1)
            <li>
                <a href="{{URL::to('estudiantes/estatusest')}}"><em class="fa fa-address-book">&nbsp;</em>{{ Lang::get('translate.condicion_estudiante')}}</a>
            </li>
<!--             <li class="parent "><a data-toggle="collapse" href="#sub-item-5">
                <em class="fa fa-address-book">&nbsp;</em> {{ Lang::get('translate.estudiantes')}} <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-5">
                    <li>
                        <a href="{{URL::to('estudiantes/crearestudiante')}}">{{ Lang::get('translate.crear_est')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('estudiantes/datosestudiante')}}">{{ Lang::get('translate.datos_est')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('estudiantes/estatusest')}}">{{ Lang::get('translate.condicion_estudiante')}}</a>
                    </li>
                </ul>
            </li> -->
            @endif
            @if(((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3) && Session::get('nivel') == 1) || Session::get('nivel') == 2)
            <li>
                <a href="{{URL::to('grupos/grupos-asignados')}}"><em class="fa fa-users">&nbsp;</em> {{ Lang::get('translate.carga_academica')}}</a>
            </li>
            @endif
            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3 || Session::get('estatus') == 4) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-6">
                <em class="fa fa-folder-open">&nbsp;</em> {{ Lang::get('translate.reportes')}} <span data-toggle="collapse" href="#sub-item-6" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-6">
                    @if(Session::get('estatus') != 4)
                    <li>
                        <a href="{{URL::to('reportes/verdocentes')}}">{{ Lang::get('translate.facilitadores')}}</a>
                    </li>
                    @endif
                    @if(Session::get('estatus') != 4)
                    <li>
                        <a href="{{URL::to('reportes/verestudiantes')}}">{{ Lang::get('translate.estudiantes_prog')}}</a>
                    </li>
                    @endif
                    @if(Session::get('estatus') != 3)
                    <li>
                        <a href="{{URL::to('reportes/solvencia')}}">{{ Lang::get('translate.solventes')}}</a>
                    </li>
                    @endif
                    @if(Session::get('estatus') != 4)
                    <li>
                        <a href="{{URL::to('reportes/vercargas')}}">{{ Lang::get('translate.resumen_carga')}}</a>
                    </li>
                    @endif
                    <!-- 
                    <li>
                        <a href="{{URL::to('reporte/actas-validar')}}">Actas Por Validar</a>
                    </li> -->
                    <!-- <li>
                        <a href="{{URL::to('reporte/verinscritos')}}">{{ Lang::get('translate.rep_inscritos')}}</a>
                    </li> -->
                </ul>
            </li>
            @endif
            @if((Session::get('estatus') == 1 || Session::get('estatus') == 2 || Session::get('estatus') == 3) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-7">
                <em class="fa fa-line-chart">&nbsp;</em> {{ Lang::get('translate.estadisticas')}} <span data-toggle="collapse" href="#sub-item-7" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-7">
                    <li>
                        <a href="{{URL::to('estadisticas/exito-academico')}}">{{ Lang::get('translate.exito_acad')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('estadisticas/proyeccion-academica')}}">{{ Lang::get('translate.proyeccion_acad_siguiente')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('estadisticas/resumen-estadistico')}}">{{ Lang::get('translate.resumen_estadistico')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if((Session::get('estatus') == 1) && Session::get('nivel') == 1)
            <li class="parent "><a data-toggle="collapse" href="#sub-item-8">
                <em class="fa fa-star">&nbsp;</em> {{ Lang::get('translate.admin')}} <span data-toggle="collapse" href="#sub-item-8" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-8">
                    <li>
                        <a href="{{URL::to('admin/verusuarios')}}">{{ Lang::get('translate.user')}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/auditoria')}}">{{ Lang::get('translate.auditoria')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(Session::get('nivel') == 3)
            <li>
                <a href="{{URL::to('ze/verhorario')}}"><em class="fa fa-calendar-check-o">&nbsp;</em> {{ Lang::get('translate.horario')}}</a>
            </li>
            <li>
                <a href="{{URL::to('ze/vercalificaciones')}}"><em class="fa fa-percent">&nbsp;</em> {{ Lang::get('translate.calificaciones')}}</a>
            </li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-9">
                <em class="fa fa-file-o">&nbsp;</em> {{ Lang::get('translate.constancias')}} <span data-toggle="collapse" href="#sub-item-9" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-9">
                    <li>
                        <a href="{{URL::to('ze/solicitud-constancias')}}">Solicitud</a>
                    </li>
                    <li>
                        <a href="{{URL::to('ze/historialconstancias')}}">Historial</a>
                    </li>
                </ul>
            </li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-8">
                <em class="fa fa-star">&nbsp;</em> {{ Lang::get('translate.procesos_admin')}} <span data-toggle="collapse" href="#sub-item-8" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
                <ul class="children collapse" id="sub-item-8">
                    <li>
                        <a href="{{URL::to('ze/verpagoestudiante')}}">Relaci&oacute;n de Pagos del Estudiante</a>
                    </li>
                </ul>
            </li>
            @endif
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