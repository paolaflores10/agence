<?php
//funcion para obviar el tiempo por defecto de ejecuciÃ³n de un archivo php
function max_execution_time(){
    //cero igual a tiempo ilimitado
    return ini_set('max_execution_time', 0);
}

//funcion para aumentar el tamaño limite del archivo php generado
function memory_limit(){
    //cero igual a tiempo ilimitado
    return ini_set('memory_limit','512M');
}

//funcion para cambiar el idioma
function cambiarIdioma($x){
    if ($x == 1) {
        Session::put('locale','en');
    } else {
        Session::put('locale','es');
    }
}

//FUNCION PARA OBTENER LA IP DEL USUARIO
function getRealIP(){
    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }
}

function pcUser(){
    return get_current_user();
}

//funcion para transformar un string de minuscula a mayuscula
function mayusculas($x){
    $may=array('Á','É','Í','Ó','Ú','Ñ');
    $min= array('á','é','í','ó','ú','ñ');
    $acentos=str_replace($min, $may, $x);
    $mayuscula=mb_strtoupper($acentos);
    return $mayuscula;
}

//funcion para transformar un string de mayuscula a minuscula
function minusculas($x){
    $min= array('á','é','í','ó','ú','ñ');
    $may=array('Á','É','Í','Ó','Ú','Ñ');
    $acentos=str_replace($may, $min, $x);
    $minuscula=ucwords(mb_strtolower($acentos));
    return $minuscula;
}

function eliminarAcentos($x){
    $may_a=array('Á','É','Í','Ó','Ú');
    $may_sa=array('A','E','I','O','U');
    $min_a= array('á','é','í','ó','ú');
    $min_sa= array('a','e','i','o','u');
    $cadena=str_replace($may_a, $may_sa, $x);
    $string=str_replace($min_a, $min_sa, $cadena);

    return $string;
}
?>