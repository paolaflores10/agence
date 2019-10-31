<?php
class ExitController extends BaseController {
	//FUNCION QUE DESLOGUEA AL USUARIO
	public function getExit()
	{
		Session::flush();
		return Redirect::action('IndexController@getIndex');
	}
}

?>
