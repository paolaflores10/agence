<?php
class IndexController extends Controller {
	//FUNCION QUE GENERA LA PAGINA DE INDEX DEL PORTAL ZONA ESTUDIANTE
	public function getIndex(){
		return View::make('inicio.inicio', array());
	}
}
?>
