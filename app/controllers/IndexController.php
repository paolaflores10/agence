<?php
class IndexController extends Controller {
	//FUNCION QUE GENERA LA PAGINA DE INDEX DEL PORTAL ZONA ESTUDIANTE
	public function getIndex(){

		//Antes que nada se comprueba si está logueado, de estarlo se redirecciona al panel
		//if((Session::has('sesion_activa') && Session::get('sesion_activa') == true) && (Session::has('lapso') && Session::get('lapso') != '')){

			//return Redirect::route('inicio');
		//}else{ //de lo contrario se redirecciona al inicio de sesion

		    //Arreglo para los valores campo Idioma

			return View::make('inicio.inicio', array(
				//'nivel' => $nivel,
				//'idiomas' => $idiomas
			));
		//}
	}
}
?>