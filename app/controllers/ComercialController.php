<?php 
class ComercialController extends BaseController{

	public function getInicio()
	{

		if(Session::has('message_error_parametros') || Session::has('message_success_parametros')){
			$tab='parametros';
		}else{
			$tab='requisitos';
		}
		$consultor = array();

		$consultores = DB::select('SELECT * FROM cao_usuario cu INNER JOIN permissao_sistema ps ON cu.co_usuario = ps.co_usuario  WHERE ps.co_sistema = 1 AND ps.in_ativo LIKE "%s%" and ps.co_tipo_usuario in (0,1,2)');

		foreach ($consultores as $key => $value) {
			$consultor[$value->co_usuario] = $value->no_usuario;

		}
		
		$title = 'Consultores';

		return View::make('comercial.requisitos',array(
			'title' => $title,
			'tab' => $tab,
			'requisitos' => $consultores,
		));		
	}

	public function postAjaxbuscarrelatorio()
	{
		if (Request::ajax()) {
			$tabla = '';
			$origen = Input::get('origen');
			$destino = Input::get('destino');
			$fecha_inicio = Input::get('fecha_inicio');
			$fecha_fin = Input::get('fecha_fin');

			$count_destino = count($destino);

			if($count_destino>0){
				$sql='';
				foreach ($destino as $key => $value) {
					if (($key+1==1 && $key+1!=$count_destino) || ($key+1!=$count_destino)) {
						$sql.="'$value'".",";
					}elseif($key+1==1 && $key+1==$count_destino){
						$sql.="'$value'";
					}elseif ($key+1==$count_destino) {
						$sql.="'$value'";
					}
				}
			}

			foreach ($destino as $key => $value) {
				$tabla='<table class="table table-hover">
							<thead>
								<tr>
									<td colspan="5">'.$destino[$key].'</td>
								</tr>';
				$tabla.= '<tr class="info">
									<th class="text-center">Per&iacute;odo</th>
									<th>Receta L&iacute;quida</th>
									<th class="text-center">Custo Fixo</th>
									<th class="text-center">Comisao</th>
									<th class="text-center">Lucro</th>
								</tr>
							</thead>
							<tbody>';
			$sql_co_usuario = DB::select("SELECT co_usuario FROM cao_usuario WHERE no_usuario in($sql)");
			foreach ($sql_co_usuario as $key => $value) {
				$sql_custo = DB::select("SELECT brut_salario FROM cao_salario WHERE co_usuario = '$value->co_usuario'");
				foreach ($sql_custo as $key => $value) {
					$tabla.='<tr>
								<td class="text-center">'.$fecha_inicio.' - '.$fecha_fin.'</td> 
								<td></td> 
								<td>'.$value->brut_salario.'</td> 
								<td></td> 
								<td></td> 
							</tr>';
				}

			}
		}




	 			//$sql_custo = 
	 				//foreach($solicitudes as $value){
	 				// 	$tabla.='<tr><td class="text-center">'.$value->id_estudiante.'</td> <td>'.$value->nom_ape.'</td> <td>'.nombrePrograma($value->cod_programa).'</td> <td class="text-center"> <a type="button" title="" href="'.URL::to('admision/detallesolicitud',array('data_get' =>Crypt::encrypt($value))).'" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a> </td> </tr>';
	 				// }
	 			$tabla.='</tbody></table>';
	 		
	 	}
		return Response::json(array(
			'tabla' => $tabla));
	}

	public function postAgregarrequisito()
	{
		$cod_tip = Input::get('tipo');
		$id_requisito = mayusculas(Input::get('id_requisito'));
		$descripcion = mayusculas(Input::get('descripcion'));

		$variables = array(
			'nivel de estudios' => $cod_tip,
			'c&oacute;digo' => $id_requisito,
			'descripcion' => $descripcion
			);
    	//reglas para validar cada variable
		$rules = array(
			'nivel de estudios' => 'required|numeric',
			'c&oacute;digo' => 'required|alphanum|max:3|unique:requisitos_admision,id_requisito,NULL,NULL,tipo_programa,'.$cod_tip,
			'descripcion' => 'required|max:255'
			);

		//en el caso que alguna validacion falle retornaremos al formulario.
		$validation = Validator::make($variables, $rules);
		if ($validation->fails()){
			$message_error=Lang::get('translate.error');
			return Redirect::action('AdmisionController@getRequisitos')
			->withErrors($validation)
			->with('message_error',$message_error)
			->withInput();
		}else{

			$insert = DB::table('requisitos_admision')
			->insert(array(
					'tipo_programa' => $cod_tip,
					'id_requisito' => $id_requisito,
					'des_requisito' => $descripcion,
					'cond_requisito' => 0
			));

			$usuario = Session::get('usuario');
			$descripcion = 'añadio el requisito '.$id_requisito.' para el Nivel '.$cod_tip;
			$lapso = Session::get('lapso');
			$cod_reg = Session::get('cod_reg');

			auditoria($usuario,$descripcion,$lapso,$cod_reg);

			$message_success='Requisito añadido';
			return Redirect::action('AdmisionController@getRequisitos')
			->with('message_success',$message_success);
		}
	}

	public function getCambiarcondicion($id_requisito,$tipo_programa,$cond_requisito)
	{
		$id_requisito = Crypt::decrypt($id_requisito);
		$tipo_programa = Crypt::decrypt($tipo_programa);
		$cond_requisito = Crypt::decrypt($cond_requisito);

		$cond_requisito = ($cond_requisito == 1) ? 0 : 1;

		$update = DB::table('requisitos_admision')
		->where('tipo_programa','=',$tipo_programa)
		->where('id_requisito','=',$id_requisito)
		->update(array(
				'cond_requisito' => $cond_requisito
		));

		$message_success='Condici&oacute;n del requisito cambiada';
			return Redirect::action('AdmisionController@getRequisitos')
			->with('message_success',$message_success);
	}

	public function postEliminarrequisito()
	{
		$data_post = explode(" - ", Crypt::decrypt(Input::get('data_post')));
		$id_requisito = $data_post[0];
		$tipo_programa = $data_post[1];

		$delete = DB::table('requisitos_admision')
		->where('tipo_programa','=',$tipo_programa)
		->where('id_requisito','=',$id_requisito)
		->delete();

		$message_success='Requisito eliminado';
			return Redirect::action('AdmisionController@getRequisitos')
			->with('message_success',$message_success);
	}

	public function postActualizarparametros()
	{
		$cod_periodo = Input::get('cod_periodo');
		$cod_pen = Input::get('cod_pen');
		$fecha_i_solicitudes = Input::get('fecha_inicio');
		$fecha_f_solicitudes = Input::get('fecha_fin');

		$variables = array(
			'per&iacute;odo' => $cod_periodo,
			'pensum' => $cod_pen,
			'fecha_inicio' => $fecha_i_solicitudes,
			'fecha_fin' => $fecha_f_solicitudes
			);
    	//reglas para validar cada variable
		$rules = array(
			'per&iacute;odo' => 'required|numeric',
			'pensum' => 'required|numeric',
			'fecha_inicio' => 'required|date',
			'fecha_fin' => 'required|date|after:fecha_inicio'
			);

		//en el caso que alguna validacion falle retornaremos al formulario.
		$validation = Validator::make($variables, $rules);
		if ($validation->fails()){
			$message_error=Lang::get('translate.error');
			return Redirect::action('AdmisionController@getRequisitos')
			->withErrors($validation)
			->with('message_error_parametros',$message_error)
			->withInput();
		}else{

			$fecha_i_solicitudes = date_format(date_create($fecha_i_solicitudes),'Y-m-d');
			$fecha_f_solicitudes = date_format(date_create($fecha_f_solicitudes),'Y-m-d');

			$insert = DB::table('parametros_solicitante')
			->update(array(
					'cod_periodo' => $cod_periodo,
					'cod_pen' => $cod_pen,
					'fecha_i_solicitudes' => $fecha_i_solicitudes,
					'fecha_f_solicitudes' => $fecha_f_solicitudes
			));

			$message_success='Parametros actualizados';
			return Redirect::action('AdmisionController@getRequisitos')
			->with('message_success_parametros',$message_success);
		}
	}

	public function getSolicitudes()
	{
		$solicitudes = DB::table('solicitante')
		->where('cod_periodo','=',Session::get('lapso'))
		->get();

		$title = 'Solicitudes - '.Session::get('lapso_mostrar');

		$estados = array(0 => 'Todos las solicitudes',1 => 'Por solvencia de documentos',2 => 'Por solvencia administrativa',3 => 'Por Traslado');

		return View::make('admision.solicitudes',array(
			'title' => $title,
			'solicitudes' => $solicitudes,
			'estados' => $estados
		));	
		
	}

	public function postAjaxbuscarsolicitudes()
	{
		if (Request::ajax()) {
			$estado = Input::get('estado');

			$parametros = ParametrosSolicitante();

			$solicitudes = DB::table('solicitante')
				->where('cod_periodo','=',Session::get('lapso'));

			if ($estado == 1) {
				$solicitudes = $solicitudes->where('solvencia_doc','=',0)->get();
			} elseif ($estado == 2) {
				$solicitudes = $solicitudes->where('solvencia_admin','=',0)->get();
			} elseif ($estado == 3)  {
				$solicitudes = $solicitudes->where('solvencia_doc','=',1)->where('solvencia_admin','=',1)->get();
			} else {
				$solicitudes = $solicitudes->get();
			}

			$tabla = '<table id="tabla_requisitos" class="table table-hover">
						<thead>
							<tr class="info">
								<th class="text-center">ID</th>
								<th>Apellidos y Nombres</th>
								<th class="text-center">Programa</th>
								<th class="text-center">Detalles</th>
							</tr>
						</thead>
						<tbody>';
				foreach($solicitudes as $value){
					$tabla.='<tr><td class="text-center">'.$value->id_estudiante.'</td> <td>'.$value->nom_ape.'</td> <td>'.nombrePrograma($value->cod_programa).'</td> <td class="text-center"> <a type="button" title="" href="'.URL::to('admision/detallesolicitud',array('data_get' =>Crypt::encrypt($value))).'" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a> </td> </tr>';
				}
			$tabla.='</tbody></table>';

			return Response::json(array('tabla' => $tabla));
		}
	}

	public function getDetallesolicitud($data_get)
	{
		$data_get = Crypt::decrypt($data_get);

		$datos = DB::table('solicitante')
		->where('id','=',$data_get->id)
		->first();

		$cod_periodo = $datos->cod_periodo;
		$cod_programa = $datos->cod_programa;
		$cod_pen = $datos->cod_pen;
		$id_estudiante = $datos->id_estudiante;
		$estatus_convenio = $datos->ingresa_convenio;
		$estatus_credito = $datos->aplica_credito;

		//TAB DE DOCUMENTOS
		$requisitos = DB::table('requisitos_admision')
			->where('tipo_programa','=',tipPrograma($cod_programa))
			->orderBy('des_requisito')
			->get();

		$t_documentos = '<div class="table-responsive"><table class="table table-bordered"><thead><tr class="info"><th>Documento</th><th class="text-center">Acciones</th></thead></tr><tbody>';

		foreach ($requisitos as $value) {
			
			if (file_exists(public_path().'/requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_'.$value->id_requisito.'.pdf')) {
				
				$t_documentos.='<tr><td>'.$value->des_requisito.'</td><td class="text-center"><a target="_blank" href="'.URL::to('/requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_'.$value->id_requisito.'.pdf').'" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></a></td></tr>';

			} else {
				$t_documentos.='<tr><td>'.$value->des_requisito.'</td><td class="text-center"><a href="#" class="btn btn-primary btn-sm" disabled><i class="fa fa-search"></i></a></td></tr>';
			}
			
		}

		$t_documentos.='</tbody></table></div>';

		//FIN TAB DE DOCUMENTOS

		//TAB DE PAGOS

		//SQL para buscar la deuda del estudiante
			$sql_deuda=DB::select('SELECT *, (SELECT nom_ape FROM estudiantes WHERE id = pagos_estudiantes.id_estudiante ) AS nom_ape, (SELECT des_concepto FROM conceptos_admon WHERE id_concepto = pagos_estudiantes.id_concepto ) AS des_concepto FROM pagos_estudiantes WHERE id_estudiante = ? and id_concepto = 0 ORDER BY fecha_pago',array($id_estudiante));

			$tabla_deuda = '<div class="table-responsive"><table class="table table-bordered">
                            <thead>
                            <tr class="info">                                               
                                <th class="text-center">Concepto de Pago</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">N° Referencia</th>                        
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Opci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>';

            if (count($sql_deuda)>0) {
            	$array_deuda = array();
            	foreach ($sql_deuda as $key => $value) {
            		$deuda_estudiante = new Stdclass();

            		$deuda_estudiante->monto= $value->monto_pago;
            		$deuda_estudiante->referencia = $value->referencia;
            		$deuda_estudiante->fecha_pago = $value->fecha_pago;
            		$deuda_estudiante->des_concepto = $value->des_concepto;
            		$nombres = $value->nom_ape;
            		$deuda_estudiante->des_concepto = $value->des_concepto;

            		$array_deuda[] = $deuda_estudiante;
            	}

            	if (count($sql_deuda)>0) {
            		foreach ($array_deuda as $key => $value) {
            			$tabla_deuda.= '<tr><td class="text-center">'.$value->des_concepto.'</td>
            							 <td class="text-center">'.$value->monto.'</td>
            							 <td class="text-center">'.$value->referencia.'</td>
            							 <td class="text-center">'.$value->fecha_pago.'</td>
            							 <td class="text-center"><a target="_blank" href="'.URL::to('/requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_TAS.pdf').'" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></a></td></tr>';
            		}
            	}
            }

            $tabla_deuda.='</tbody></table></div>';

            //buscando la proyeccion de pago del solicitante
            if ($estatus_convenio == 0 && $estatus_credito == 0) {
            	$tip_finanza = 'A';
            } elseif ($estatus_convenio == 0 && $estatus_credito == 1) {
            	$tip_finanza = 'B';
            }elseif ($estatus_convenio == 1 && $estatus_credito == 0) {
            	$tip_finanza = 'C';
            }elseif ($estatus_convenio == 1 && $estatus_credito == 1) {
            	$tip_finanza = 'D';
            }else{
            	$tip_finanza = '';
            }

            //proyeccion de contado
            $tabla_contado = '<div class="table-responsive"><table class="table table-bordered"><caption><strong>Contado</strong></caption>
                            <thead>
                            <tr class="info">                                        
                                <th class="text-center">Concepto de Pago</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Fecha de Vencimiento</th>                        
                            </tr>
                            </thead>
                            <tbody>';

            $proy_contado = DB::table('proyecion_concepto')
            ->select(DB::raw('(SELECT des_concepto FROM conceptos_admon WHERE id_concepto = 3 ) AS des_concepto,monto_cont,fecha_vencimiento'))
            ->where('cod_programa','=',$cod_programa)
            ->where('cod_periodo','=',$cod_periodo)
            ->where('tipo_finanza','=',$tip_finanza)
            ->get();

            foreach ($proy_contado as $value) {
            	$tabla_contado.='<tr><td>'.$value->des_concepto.'</td><td>'.$value->monto_cont.'</td><td>'.$value->fecha_vencimiento.'</td></tr>';
            }

            $tabla_contado.='</tbody></table></div>';
            //proyeccion a credito
            $tabla_credito = '<div class="table-responsive"><table class="table table-bordered"><caption><strong>Credito</strong></caption>
                            <thead>
                            <tr class="info">                                         
                                <th class="text-center">Concepto de Pago</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Fecha de Vencimiento</th>                        
                            </tr>
                            </thead>
                            <tbody>';

            $proy_credito_i = DB::table('proyecion_concepto')
            ->select(DB::raw('(SELECT des_concepto FROM conceptos_admon WHERE id_concepto = 1 ) AS des_concepto,inicial,fecha_vencimiento'))
            ->where('cod_programa','=',$cod_programa)
            ->where('cod_periodo','=',$cod_periodo)
            ->where('tipo_finanza','=',$tip_finanza)
            ->get();

            foreach ($proy_credito_i as $value) {
            	$tabla_credito.='<tr><td>'.$value->des_concepto.'</td><td>'.$value->inicial.'</td><td>'.$value->fecha_vencimiento.'</td></tr>';
            }

            $proy_credito_n = DB::table('proyecion_concepto')
            ->select(DB::raw('(SELECT des_concepto FROM conceptos_admon WHERE id_concepto = 2 ) AS des_concepto,num_cuotas,monto,fecha_vencimiento'))
            ->where('cod_programa','=',$cod_programa)
            ->where('cod_periodo','=',$cod_periodo)
            ->where('tipo_finanza','=',$tip_finanza)
            ->get();

            foreach ($proy_credito_n as $value) {
            	for ($i=0; $i < $value->num_cuotas ; $i++) {
            		$fecha = $value->fecha_vencimiento;
					$nuevafecha = strtotime('+'.$i.' month' , strtotime($fecha));
					$nuevafecha = date('Y-m-d', $nuevafecha ); 
            		$tabla_credito.='<tr><td>'.$value->des_concepto.'</td><td>'.$value->monto.'</td><td>'.$nuevafecha.'</td></tr>';
            	}
            	
            }

            $tabla_credito.='</tbody></table></div>';
            
            $tablas_pagos = $tabla_contado.$tabla_credito;

            $meto_pago = array(""=>"")+DB::table('metodo_pago')
            ->orderBy('id_pago')
            ->lists('des_pago','id_pago');

            $tipo_pago = array(""=>"",0 => "Contado",1 => "Credito");

            //verificando si el solicitante realizo el pago de la tariga y escogio los metodos de pago

            if (count($sql_deuda)>0) {
            	$pago = 1;
            } else {
            	$pago = 0;
            }            

        //FIN TAB DE PAGOS

        $tipo_doc = DB::table('documento_tipo')
			->lists('des_doc','id_doc');

		$convenio = array('' => '')+DB::table('convenio')
		->lists('des_convenio','cod_convenio');

		$origen_racial = array("" => '')+DB::table('origen_racial')
		->lists('des_origen','id');

		$idiomas = array("" => "", 'en' => 'English', 'es' => 'Spanish');

		$lang = getUserLanguage();

		if ($lang == 'es') {
			$tsexo = array("" => "Seleccionar...", "M" => "Masculino", "F" => "Femenino");
			$paises = array("" => "Seleccionar...")+DB::table('paises')
				->orderBy('pais')
				->lists('pais','codigo');
			$op = array("" => "Seleccionar...", "1" => "Si", "0" => "No");
		} else {
			$tsexo = array("" => "Select...", "M" => "Male", "F" => "Female");
			$paises = array("" => "Select...")+DB::table('paises')
				->orderBy('pais')
				->lists('pais','codigo');
			$op = array("" => "Select...", "1" => "Yes", "0" => "No");
		}

		if (file_exists(public_path().'/requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_ENROLLMENT.pdf')) {
			$acuerdo = URL::to('requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_ENROLLMENT.pdf');
		}else{
			$acuerdo = '#';
		}

		if(Session::has('message_error_ad') || Session::has('message_success_ad')){
			$tab='administrativo';
		}elseif(Session::has('message_error_tr') || Session::has('message_success_tr')){
			$tab = 'traslado';
		}else{
			$tab='admision';
		}

		$title = 'Solicitudes - '.Session::get('lapso_mostrar');

		return View::make('admision.detalle_solicitud',array(
			'title' => $title,
			'tab' => $tab,
			'datos' => $datos,
			't_documentos' => $t_documentos,
			'tsexo' => $tsexo,
			'paises' => $paises,
			'op' => $op,
			'tipo_doc' => $tipo_doc,
			'convenio' => $convenio,
			'tabla_deuda' => $tabla_deuda,
			'tablas_pagos' => $tablas_pagos,
			'tipo_pago' => $tipo_pago,
			'meto_pago' => $meto_pago,
			'pago' => $pago,
			'origen_racial' => $origen_racial,
			'idiomas' => $idiomas,
			'acuerdo' => $acuerdo
		));	
	}

	public function postObservacionesdoc()
	{

		$datos = Crypt::decrypt(Input::get('data_ob'));
		$obs = Input::get('observaciones_doc');

		$insert = DB::table('observaciones_solicitante')
		->insert(array(
			'id_solicitante' => $datos->id,
			'observaciones' => $obs
		));

		$update = DB::table('solicitante')
		->where('id','=',$datos->id)
		->update(array(
			'solvencia_doc' => 2
		));

		$datos = DB::table('solicitante')
		->where('id','=',$datos->id)
		->first();

		$contenido='<h3>Dear: '.minusculas($datos->nom_ape).'</h3> <br /><br /><div>'.$obs.'<div>';

		$cabeceras = 'From: Florida Global University <no-reply@fgu-edu.com>' . "\r\n" .
				    'Reply-To: no-reply@fgu-edu.com ' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$mensaje='<html>
		<head>
		<title>Dpto. de Admisi&oacute;n | FGU</title>
		</head>
		<body>'.$contenido.'</body>
		</html>';

		mail($datos->email,"Notification | FGU",$mensaje,$cabeceras);
		return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))->with('message_success','Notificaci&oacute;n enviada al solicitante, estatus cambiado a: En revisi&oacute;n');
	}

	public function getAprobardocumentos($data_get)
	{
		$datos = Crypt::decrypt($data_get);

		$update = DB::table('solicitante')
		->where('id','=',$datos->id)
		->update(array(
			'solvencia_doc' => 1
		));

		$datos = DB::table('solicitante')
		->where('id','=',$datos->id)
		->first();

		$msj = 'Felicidades! Usted cumple con todos los documentos necesarios para su inscripci&oacute;n, por favor haga <a target="_blank" href="'.URL::to('solicitante/pago',array('data_get' => Crypt::encrypt($datos))).'">click aqu&iacute;</a> para proceder a enviar el pago de la tasa de inscripci&oacute;n';

		$contenido='<h3>Dear: '.minusculas($datos->nom_ape).'</h3> <br /><br /><div>'.$msj.'<div>';

		$cabeceras = 'From: Florida Global University <no-reply@fgu-edu.com>' . "\r\n" .
				    'Reply-To: no-reply@fgu-edu.com ' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$mensaje='<html>
		<head>
		<title>Dpto. de Admisi&oacute;n | FGU</title>
		</head>
		<body>'.$contenido.'</body>
		</html>';

		mail($datos->email,"Notification | FGU",$mensaje,$cabeceras);
		return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))->with('message_success','Notificaci&oacute;n enviada al solicitante, estatus cambiado a: Aprobado');
	}

	public function postObservacionesadmon()
	{
		$datos = Crypt::decrypt(Input::get('data_admon'));
		$obs = Input::get('observaciones_admon');

		$insert = DB::table('observaciones_solicitante')
		->insert(array(
			'id_solicitante' => $datos->id,
			'observaciones' => $obs
		));

		$update = DB::table('solicitante')
		->where('id','=',$datos->id)
		->update(array(
			'solvencia_admin' => 2
		));

		$datos = DB::table('solicitante')
		->where('id','=',$datos->id)
		->first();

		$contenido='<h3>Dear: '.minusculas($datos->nom_ape).'</h3> <br /><br /><div>'.$obs.'<div>';

		$cabeceras = 'From: Florida Global University <no-reply@fgu-edu.com>' . "\r\n" .
				    'Reply-To: no-reply@fgu-edu.com ' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$mensaje='<html>
		<head>
		<title>Dpto. de Administraci&oacute;n | FGU</title>
		</head>
		<body>'.$contenido.'</body>
		</html>';

		mail($datos->email,"Notification | FGU",$mensaje,$cabeceras);
		return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))->with('message_success_ad','Notificaci&oacute;n enviada al solicitante, estatus cambiado a: En revisi&oacute;n');
	}

	public function getAprobaradmon($data_get)
	{
		$datos = Crypt::decrypt($data_get);

		$update = DB::table('solicitante')
		->where('id','=',$datos->id)
		->update(array(
			'solvencia_admin' => 1
		));

		$datos = DB::table('solicitante')
		->where('id','=',$datos->id)
		->first();

		$msj = 'Felicidades! Usted cumple con todos los requisitos administrativos de su solicitud de inscripci&oacute;n, en las pr&oacute;ximas horas a usted se le estar&aacute; enviando el acuerdo de inscripci&oacute;n para finalizar el proceso de la solicitud.</p>
		';

		$contenido='<h3>Dear: '.minusculas($datos->nom_ape).'</h3> <br /><br /><div>'.$msj.'<div>';

		$cabeceras = 'From: Florida Global University <no-reply@fgu-edu.com>' . "\r\n" .
				    'Reply-To: no-reply@fgu-edu.com ' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$mensaje='<html>
		<head>
		<title>Dpto. de Admisi&oacute;n | FGU</title>
		</head>
		<body>'.$contenido.'</body>
		</html>';

		mail($datos->email,"Notification | FGU",$mensaje,$cabeceras);
		return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))->with('message_success_ad','Notificaci&oacute;n enviada al solicitante, estatus cambiado a: Aprobado');
	}

	public function getGenerarenrollment($data_get)
	{
		max_execution_time();
		memory_limit();

		$data_get = Crypt::decrypt($data_get);

		$datos = DB::table('solicitante')
		->where('id','=',$data_get->id)
		->first();
		
		$id_estudiante = $datos->id_estudiante;
		$cod_periodo = $datos->cod_periodo;
		$cod_programa = $datos->cod_programa;

		$idiomas = array('en' => 'English', 'es' => 'Spanish');

		$origen_racial = DB::table('origen_racial')->orderBy('id')->get();

		$meto_pago = DB::table('metodo_pago')->orderBy('id_pago')->get();

		$cod_tip = tipPrograma($datos->cod_programa);

		$requisitos = DB::table('requisitos_admision')
		->where('tipo_programa','=',$cod_tip)
		->get();

		$programas = DB::table('programas')
		->where('tip_programa','=',$cod_tip)
		->get();

		$periodo = DB::table('periodo_academico')
		->where('cod_periodo','=',$datos->cod_periodo)
		->first();

		$startdate = $periodo->des_periodo.' ('.date_format(date_create($periodo->i_periodo),'F').' - '.date_format(date_create($periodo->f_periodo),'F').')';
		$year = $periodo->ano_periodo;

    	$html = View::make("admision.enrollment", array(
    		'datos' => $datos,
    		'idiomas' => $idiomas,
    		'origen_racial' => $origen_racial,
    		'meto_pago' => $meto_pago,
    		'cod_tip' => $cod_tip,
    		'requisitos' => $requisitos,
    		'programas' => $programas,
    		'startdate' => $startdate,
    		'year' => $year
		));

		$headers = array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'letter', 'portrait')
			->show($filename = 'Enrollment_Agreement_P-'.$cod_periodo.'_PR-'.$cod_programa.'_ID-'.$id_estudiante), 200, $headers);
	}

	public function postCargaracuerdo($data_get)
	{
		$acuerdo = Input::file('acuerdo');

		$variables = array(
            'acuerdo de inscripci&oacute;n' => $acuerdo
        );
        //reglas para validar cada variable
		$rules = array(
            'acuerdo de inscripci&oacute;n' => 'required|mimes:pdf'
        );

        $validation = Validator::make($variables, $rules);
        if ($validation->fails()){
            $message_error= Lang::get('translate.error');
            return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get' => $data_get))
                ->withErrors($validation)
                ->with('message_error_tr',$message_error)
                ->withInput();
		}else{

			$datos = Crypt::decrypt($data_get);
			$id_estudiante = $datos->id_estudiante;
			$cod_programa = $datos->cod_programa;
			$cod_periodo = $datos->cod_periodo;
			$cod_pen = $datos->cod_pen;

			if (Input::hasFile('acuerdo')) {
				if (file_exists(public_path().'/requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_ENROLLMENT.pdf')) {
					unlink(public_path().'/requisitos/'.$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_ENROLLMENT.pdf');
				}
				$acuerdo->move(public_path().'/requisitos',$id_estudiante.'_'.$cod_programa.'_'.$cod_periodo.'_'.$cod_pen.'_ENROLLMENT.pdf');
			}

			$message_success= 'Acuerdo de Inscripci&oacute;n cargado';
            return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get' => $data_get))
                ->with('message_success_tr',$message_success);
		}
	}

	public function getTrasladar($data_get)
	{
		max_execution_time();
		memory_limit();
		
		$datos = Crypt::decrypt($data_get);

		//verificar si el estudiante existe en estudiantes
		$estudiantes = DB::table('estudiantes')
		->where('id','=',$datos->id_estudiante)
		->count();

		$estatus_convenio = $datos->ingresa_convenio;
		$estatus_credito = $datos->aplica_credito;

		//buscando la proyeccion de pago del solicitante
        if ($estatus_convenio == 0 && $estatus_credito == 0) {
        	$tip_finanza = 'A';
        } elseif ($estatus_convenio == 0 && $estatus_credito == 1) {
        	$tip_finanza = 'B';
        }elseif ($estatus_convenio == 1 && $estatus_credito == 0) {
        	$tip_finanza = 'C';
        }elseif ($estatus_convenio == 1 && $estatus_credito == 1) {
        	$tip_finanza = 'D';
        }else{
        	$tip_finanza = '';
        }

		//verificar si existe en estudiantes_programas
		$estudiantes_programas = DB::table('estudiante_programas')
		->where('id_estudiante','=',$datos->id_estudiante)
		->where('cod_programa','=',$datos->cod_programa)
		->where('cod_pen','=',$datos->cod_pen)
		->count();

		if ($estudiantes > 0 && $estudiantes_programas > 0) {
			$message_error = 'Los datos del estudiante ya se encuentran asignados al programa';
			return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))
				->with('message_error_tr',$message_error);
		} elseif($estudiantes > 0 && $estudiantes_programas == 0) {
			
			$update_est = DB::table('estudiantes')
			->where('id_estudiante','=',$id_estudiante)
			->update(array(
				'dir_estudiante' => $datos->dir_estudiante,
				'tlf_estudiante' => $datos->tlf_estudiante,
				'tlf_estudiante_o' => $datos->tlf_estudiante_o,
				'email' => $datos->email,
				'pais' => $datos->pais,
				'estado' => $datos->estado,
				'cod_postal' => $datos->cod_postal,
				'fax' => $datos->fax,
				'origen_racial' => $datos->origen_racial,
				'idioma' => $datos->idioma,
				'nom_secu' => $datos->nom_secu,
				'pais_secu' => $datos->pais_secu,
				'estado_secu' => $datos->estado_secu,
				'titulo_secu' => $datos->titulo_secu,
				'ano_secu' => $datos->ano_secu,
				'nom_uni' => $datos->nom_uni,
				'pais_uni' => $datos->pais_uni,
				'estado_uni' => $datos->estado_uni,
				'titulo_uni' => $datos->titulo_uni,
				'ano_uni' => $datos->ano_uni
			));

			$estudiantes_programas_insert = DB::table('estudiante_programas')
			->insert(array(
				'id_estudiante' => $datos->id_estudiante,
				'cod_programa' => $datos->cod_programa,
				'cod_pen' => $datos->cod_pen,
				'fecha_inicio' => date('Y-m-d'),
				'estatus' => 1,
				'tipo_pago' => $datos->tipo_pago,
				'meto_pago' => $datos->meto_pago,
				'tip_finanza' => $tip_finanza
			));

			$delete = DB::table('deudas_estudiantes')
			->where('id_estudiante','=',$datos->id_estudiante)
			->whereIn('concepto',array(1,2))
			->where('cod_programa','=',$datos->cod_programa)
			->delete();
			
			if ($datos->tipo_pago == 0) {            
            
	            $proy_contado = DB::table('proyecion_concepto')
	            ->select(DB::raw('3 AS id_concepto,monto_cont,fecha_vencimiento'))
	            ->where('cod_programa','=',$datos->cod_programa)
	            ->where('cod_periodo','=',$datos->cod_periodo)
	            ->where('tipo_finanza','=',$tip_finanza)
	            ->get();

	            foreach ($proy_contado as $value) {
	            	$insert = DB::table('deudas_estudiantes')
						->insert(array(
								'id_estudiante' => $datos->id_estudiante,
								'concepto' => $value->id_concepto,
								'monto' => $value->monto_cont,
								'fecha_pago' => $value->fecha_vencimiento,
								'estatus_pago' => 2,
								'cod_programa' => $datos->cod_programa
						));
	            }

           	} elseif($datos->tipo_pago == 1) {
            	
	            $proy_credito_i = DB::table('proyecion_concepto')
	            ->select(DB::raw('1 AS id_concepto,inicial,fecha_vencimiento'))
	            ->where('cod_programa','=',$datos->cod_programa)
	            ->where('cod_periodo','=',$datos->cod_periodo)
	            ->where('tipo_finanza','=',$tip_finanza)
	            ->get();

	            foreach ($proy_credito_i as $value) {
	            	$insert = DB::table('deudas_estudiantes')
						->insert(array(
								'id_estudiante' => $datos->id_estudiante,
								'concepto' => $value->id_concepto,
								'monto' => $value->inicial,
								'fecha_pago' => $value->fecha_vencimiento,
								'estatus_pago' => 2,
								'cod_programa' => $datos->cod_programa
						));
	            }

	            $proy_credito_n = DB::table('proyecion_concepto')
	            ->select(DB::raw('2 AS id_concepto,num_cuotas,monto,fecha_vencimiento'))
	            ->where('cod_programa','=',$datos->cod_programa)
	            ->where('cod_periodo','=',$datos->cod_periodo)
	            ->where('tipo_finanza','=',$tip_finanza)
	            ->get();

	            foreach ($proy_credito_n as $value) {
	            	for ($i=0; $i < $value->num_cuotas ; $i++) {
	            		$fecha = $value->fecha_vencimiento;
						$nuevafecha = strtotime('+'.$i.' month' , strtotime($fecha));
						$nuevafecha = date('Y-m-d', $nuevafecha ); 

						$insert = DB::table('deudas_estudiantes')
						->insert(array(
								'id_estudiante' => $datos->id_estudiante,
								'concepto' => $value->id_concepto,
								'monto' => $value->monto,
								'fecha_pago' => $nuevafecha,
								'estatus_pago' => 2,
								'cod_programa' => $datos->cod_programa
						));
	            	}
	            	
	            }
	        }


			$message_success = 'Los datos del estudiante fueron actualizados y se le agrego la carrera solicitada';
			return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))
				->with('message_success_tr',$message_success);

		} else{
			$insert_est = DB::table('estudiantes')
			->insert(array(
				'id' => $datos->id_estudiante,
				'cod_periodo' => $datos->cod_periodo,
				'nom_ape' => $datos->nom_ape,
				'fecha_nac' => $datos->fecha_nac,
				'genero' => $datos->genero,
				'dir_estudiante' => $datos->dir_estudiante,
				'tlf_estudiante' => $datos->tlf_estudiante,
				'tlf_estudiante_o' => $datos->tlf_estudiante_o,
				'email' => $datos->email,
				'pais' => $datos->pais,
				'estado' => $datos->estado,
				'cod_postal' => $datos->cod_postal,
				'fax' => $datos->fax,
				'origen_racial' => $datos->origen_racial,
				'idioma' => $datos->idioma,
				'nom_secu' => $datos->nom_secu,
				'pais_secu' => $datos->pais_secu,
				'estado_secu' => $datos->estado_secu,
				'titulo_secu' => $datos->titulo_secu,
				'ano_secu' => $datos->ano_secu,
				'nom_uni' => $datos->nom_uni,
				'pais_uni' => $datos->pais_uni,
				'estado_uni' => $datos->estado_uni,
				'titulo_uni' => $datos->titulo_uni,
				'ano_uni' => $datos->ano_uni,
				'clave' => md5($datos->id_estudiante)
			));

			$estudiantes_programas_insert = DB::table('estudiante_programas')
			->insert(array(
				'id_estudiante' => $datos->id_estudiante,
				'cod_programa' => $datos->cod_programa,
				'cod_pen' => $datos->cod_pen,
				'fecha_inicio' => date('Y-m-d'),
				'estatus' => 1,
				'tipo_pago' => $datos->tipo_pago,
				'meto_pago' => $datos->meto_pago,
				'tip_finanza' => $tip_finanza
			));

			$delete = DB::table('deudas_estudiantes')
			->where('id_estudiante','=',$datos->id_estudiante)
			->whereIn('concepto',array(1,2))
			->where('cod_programa','=',$datos->cod_programa)
			->delete();
			
			if ($datos->tipo_pago == 0) {            
            
	            $proy_contado = DB::table('proyecion_concepto')
	            ->select(DB::raw('3 AS id_concepto,monto_cont,fecha_vencimiento'))
	            ->where('cod_programa','=',$datos->cod_programa)
	            ->where('cod_periodo','=',$datos->cod_periodo)
	            ->where('tipo_finanza','=',$tip_finanza)
	            ->get();

	            foreach ($proy_contado as $value) {
	            	$insert = DB::table('deudas_estudiantes')
						->insert(array(
								'id_estudiante' => $datos->id_estudiante,
								'concepto' => $value->id_concepto,
								'monto' => $value->monto_cont,
								'fecha_pago' => $value->fecha_vencimiento,
								'estatus_pago' => 2,
								'cod_programa' => $datos->cod_programa
						));
	            }

           	} elseif($datos->tipo_pago == 1) {
            	
	            $proy_credito_i = DB::table('proyecion_concepto')
	            ->select(DB::raw('1 AS id_concepto,inicial,fecha_vencimiento'))
	            ->where('cod_programa','=',$datos->cod_programa)
	            ->where('cod_periodo','=',$datos->cod_periodo)
	            ->where('tipo_finanza','=',$tip_finanza)
	            ->get();

	            foreach ($proy_credito_i as $value) {
	            	$insert = DB::table('deudas_estudiantes')
						->insert(array(
								'id_estudiante' => $datos->id_estudiante,
								'concepto' => $value->id_concepto,
								'monto' => $value->inicial,
								'fecha_pago' => $value->fecha_vencimiento,
								'estatus_pago' => 2,
								'cod_programa' => $datos->cod_programa
						));
	            }

	            $proy_credito_n = DB::table('proyecion_concepto')
	            ->select(DB::raw('2 AS id_concepto,num_cuotas,monto,fecha_vencimiento'))
	            ->where('cod_programa','=',$datos->cod_programa)
	            ->where('cod_periodo','=',$datos->cod_periodo)
	            ->where('tipo_finanza','=',$tip_finanza)
	            ->get();

	            foreach ($proy_credito_n as $value) {
	            	for ($i=0; $i < $value->num_cuotas ; $i++) {
	            		$fecha = $value->fecha_vencimiento;
						$nuevafecha = strtotime('+'.$i.' month' , strtotime($fecha));
						$nuevafecha = date('Y-m-d', $nuevafecha ); 

						$insert = DB::table('deudas_estudiantes')
						->insert(array(
								'id_estudiante' => $datos->id_estudiante,
								'concepto' => $value->id_concepto,
								'monto' => $value->monto,
								'fecha_pago' => $nuevafecha,
								'estatus_pago' => 2,
								'cod_programa' => $datos->cod_programa
						));
	            	}
	            	
	            }
	        }

			$message_success = 'El estudiante fue trasladado exitosamente a la base de datos';
			return Redirect::action('AdmisionController@getDetallesolicitud',array('data_get'=>Crypt::encrypt($datos)))
				->with('message_success_tr',$message_success);
		}
	}
}
?>