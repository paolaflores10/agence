<?php
class InicioController extends BaseController{
	//FUNCION QUE GENERA LA PAGINA DE INICIO
	public function Inicio(){

		//$title = Lang::choice('translate.inicio_tit',Session::get('nivel'));
		
		return View::make('inicio.inicio', array(
			//'title' => $title
		));
	}	
}
?>