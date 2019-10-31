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
}
?>
