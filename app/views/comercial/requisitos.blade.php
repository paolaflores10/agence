@extends('layouts.master')

@section('css')
{{ HTML::style('css/jquery_ui.css')}}
{{ HTML::style('css/datatable/dataTables.bootstrap.css')}}
{{ HTML::style('css/datepicker.css')}}
@stop

@section('content')
@if(Session::has('message_success'))
<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
	<div class="alert alert-success success-msg centrado"><strong>{{ Session::get('message_success') }}</strong></div>
	</div>
</div>
@endif
@if(Session::has('message_error'))
<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
	<div class="alert alert-danger error-msg centrado"><strong>{{ Session::get('message_error') }}</strong></div>
	</div>
</div>
@endif
@if(Session::has('message_success_parametros'))
<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
	<div class="alert alert-success success-msg centrado"><strong>{{ Session::get('message_success_parametros') }}</strong></div>
	</div>
</div>
@endif
@if(Session::has('message_error_parametros'))
<div class="row">
	<div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
	<div class="alert alert-danger error-msg centrado"><strong>{{ Session::get('message_error_parametros') }}</strong></div>
	</div>
</div>
@endif
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<ul class="nav nav-tabs nav-justified" role="tablist">
		<li class="@if($tab=='requisitos'){{'active'}}@endif" ><a href="#requisitos" data-toggle="tab"><span class="negrita">Por consultor</span></a></li>
		<li class="@if($tab=='parametros'){{'active'}}@endif"><a href="#parametros" data-toggle="tab"><span class="negrita">Por cliente</span></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade @if($tab=='requisitos'){{'in active'}}@endif" id="requisitos">
			<br>
			@if(count($requisitos)>0)
			<div class="panel-body">
				<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<label>Per&iacute;odo:</label>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12" >
						<div class="input-group date">
								{{ Form::text('fecha_inicio', '' , $attributes = array('class' => 'form-control', 'id'=>'fecha_inicio','placeholder'=>'00-00-0000', 'readonly'=>'readonly'))}}
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
						<div class="text-danger">
							@if($errors->has('fecha_inicio'))   {{ $errors->first('fecha_inicio') }}    @else {{ "&nbsp;" }} @endif
						</div>
					</div>
					<div class=" form-groupcol-lg-4 col-md-4 col-sm-12 col-xs-12" >
						<div class="input-group date">
							{{ Form::text('fecha_fin', '' , $attributes = array('class' => 'form-control', 'id'=>'fecha_fin','placeholder'=>'00-00-0000', 'readonly'=>'readonly'))}}
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
						<div class="text-danger">
							@if($errors->has('fecha_fin'))   {{ $errors->first('fecha_fin') }}    @else {{ "&nbsp;" }} @endif
						</div>
					</div>
			</div>
			<div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
				<table class="table table-borderless">
					<thead>
							<th class="col-lg-4">Consultores</th>
							<th>&nbsp;</th>
							<th class="col-lg-4">&nbsp;</th>
							<th class="col-lg-4">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<td class="col-lg-4">
							<select name="origen[]" id="origen" multiple="multiple" size="8">
								@foreach($requisitos as $value)
									<option {{$value->co_usuario}} > {{$value->no_usuario}} </option>
								@endforeach
							</select>
						</td>
						<td class="col-lg-2">
							<input type="button" class="pasar izq" value=">>"></br>
							<input type="button" class="quitar der" value="<<">
						</td>
						<td class="col-lg-4">
							<select name="destino[]" id="destino" multiple="multiple" size="8"></select>
							<div id="msg_destino" class="text-danger">&nbsp;</div> 
						</td>
					</tbody>
				</table>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<input type="submit" class="btn btn-primary" value="Relatorio" name="relatorio" id="relatorio"  ></br>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<input type="submit" class="btn btn-success" value="Gr&aacute;fico  " name="grafico" id="grafico"  ></br>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
				<input type="submit" class="btn btn-warning" value="Pizza    " name="pizza" id="pizza"  >
			</div>
			</br>
				<div> 
        			<div id="tabla_relatorio"></div>
    			</div>

				

			@else
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
					<div class="alert alert-warning warning-msg centrado">No hay requisitos cargados</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>

@stop

@section('postscript')
<!-- Incluyo Javascript de la libreria Datatable -->
{{ HTML::script('js/jquery_ui.js') }}
{{ HTML::script('js/datepicker/bootstrap-datepicker.js') }}
{{ HTML::script('js/datepicker/locales/bootstrap-datepicker.es.js') }}
{{ HTML::script('js/datatable/jquery.dataTables.js') }}
{{ HTML::script('js/datatable/dataTables.bootstrap.js') }}
<script type="text/javascript" language="javascript">
$().ready(function() 
	{
		$('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#destino'); });  
		$('.quitar').click(function() { return !$('#destino option:selected').remove().appendTo('#origen'); });
	});

	$('#fecha_inicio,#fecha_fin').datepicker({
		language: "{{ App::getLocale(); }}",
		format: "mm-yyyy"
	});

	$("#relatorio").click(function(){
            var origen = $("#origen").val();
            var destino = $("#destino").val();
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();


            if (origen!='' && destino!='' && fecha_inicio!='' && fecha_fin!='')
            {
                $.ajax({
                    type: "POST",
                    url: "{{URL::action('ComercialController@postAjaxbuscarrelatorio')}}", 
                    dataType: "json",
                    data: {
                        origen: origen, destino: destino, fecha_inicio: fecha_inicio, fecha_fin: fecha_fin 
                    },
                    cache: false,
                    success: function(data)
                    {         
                        $("#destino" ).removeClass( "has-error" );
                        $("#origen" ).removeClass( "has-error" );
                        $("#fecha_fin" ).removeClass( "has-error" );
                        $("#fecha_inicio").html('');

                        $("#tabla_relatorio").html(data.tabla);                                
                    }
                });
            }else{
                if (destino=='') {
                    $("#destino" ).addClass( "has-error" );
                    $("#msg_destino").html('Requerido');
                }
            }      
        })
</script>
@stop