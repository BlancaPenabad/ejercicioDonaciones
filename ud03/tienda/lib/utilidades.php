<?php
//Todos los métodos que validan en formulario:

//Función que verifica los registros requeridos:
function registroObligatorio($reg){

    return !empty($reg) && isset($reg);
}



//Función que verifican la longitud del nombre y de los apellidos:
function longitudNombre($nombre){
    return strlen($nombre) > 0 &&  strlen($nombre) <=50;
}

function longitudApellido($apellidos){
    return strlen($apellidos) > 0 &&  strlen($apellidos) <=100;

}



//Función que verifica si un campo es un string
function validarString($reg){
    return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ]+$/', $reg);
}



//Función que verifica si un campo es un número
function validarDigito($dig){
    return is_numeric($dig);
}


//Función que valida el límite de edad
function validarEdad($edad){
    return $edad>=0 && $edad<=100;
}

?>