<?php
class ExitController extends BaseController {
	//FUNCION QUE DESLOGUEA AL USUARIO
	public function getExit()
	{
		$usuario = Session::get('usuario');
		$descripcion = 'Salida del sistema';
		$lapso = Session::get('lapso');
		$cod_reg = Session::get('cod_reg'); 

		//registrando auditoria
        auditoria($usuario,$descripcion,$lapso,0);

		Session::flush();
		return Redirect::action('IndexController@getIndex');
	}
}

?>