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

?>
