<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Florida Global University</title>
  	{{ HTML::style('css/bootstrap.min.css')}}
    {{ HTML::style('css/font-awesome.min.css')}}
    {{ HTML::style('css/styles.css')}}
    {{ HTML::style('css/estilo.css')}}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="{{ URL::to('images/favicon.ico')}}">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
	<div class="conteiner">
		<!-- Master Header -->
		<header id="master-header">
			<div id="master-header-bg"></div>
			<div id="master-header-wrap">
				<!-- Navi -->
			</div>
		</header>
		<!-- ..Master Header -->
		<section>
		<!-- Section -->  
			<div class="container">    
				<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="margin-top:10%;">     
					@if(Session::has('message_error'))
						<div class="alert alert-danger error-msg centrado negrita">{{ Session::get('message_error') }}</div>
					@endif              
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="panel-title text-center">{{ Lang::get('translate.login_form_tit_lapso')}}</div>
						</div>     
						<div style="padding-top:40px" class="panel-body">
							<form id="loginform" class="form-horizontal" method="post" action="{{ URL::to('login/guardarlapso') }}">
								<div class="text-danger">
                                    @if($errors->has('lapso'))   {{ $errors->first('lapso') }} @endif
                                </div>
								<div style="margin-bottom: 25px" class="input-group  @if($errors->has('lapso')){{'has-error'}} @endif">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									{{ Form::select('lapso',$lapso_mostrar, NULL, $attributes = array('class' => 'form-control','required'=>'required','placeholder'=>'Indique el lapso acad&eacute;mico')) }}
								</div>
								<div style="margin-top:10px" class="form-group">
									<!-- Button -->
									<div class="col-sm-12 text-center">
										{{ Form::submit(Lang::get('translate.login_form_btn'), array('class' => 'btn btn-success')) }}
									</div>
								</div>
							</form>     
						</div>                     
					</div>  
				</div>
			</div>
		<!-- Section -->
		</section>
	</div>
	
    <!-- jQuery -->
    {{ HTML::script('plugins/jquery/dist/jquery.min.js')}}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('plugins/bootstrap/dist/js/bootstrap.min.js')}}
    <!-- Metis Menu Plugin JavaScript -->
    {{ HTML::script('plugins/metisMenu/dist/metisMenu.min.js')}}
    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/sb-admin-2.js')}}

    {{ HTML::script('js/jquery_ui.js') }}
    
    </body>
</html>
