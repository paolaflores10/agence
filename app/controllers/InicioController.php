<?php
class InicioController extends BaseController{
	//FUNCION QUE GENERA LA PAGINA DE INICIO
	public function Inicio(){
		
		return View::make('inicio.inicio', array(

		));
	}	
}
?>
