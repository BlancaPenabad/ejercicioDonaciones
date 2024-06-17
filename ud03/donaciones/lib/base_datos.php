<?php

function get_conexion(){
    $servername = 'db';
    $username = 'root';
    $password = 'test';

    try{
        $con = new PDO("mysql:host=$servername", $username, $password);
        //Excepciones:
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión correcta";
        return $con;

        
    }catch(PDOException $e){
            echo "Fallo en conexión: " . $e->getMessage();
    }
}

function ejecutar_consulta($conexion, $sql){
    try{
        $conexion->query($sql);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

//CREAR BD:
function crear_bd_donacion($conexion){
    $sql = 'CREATE DATABASE IF NOT EXISTS donacion';
    ejecutar_consulta($conexion, $sql);
}


//SELECCIONAR BD:
function seleccionar_bd_donacion($conexion){
    $sql = "use donacion";
    ejecutar_consulta($conexion, $sql);

}

function crear_tabla_donantes($conexion){
    $sql = "CREATE TABLE IF NOT EXISTS donantes(
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellidos VARCHAR(30) NOT NULL,
        edad INT(3) NOT NULL,
        grupoSanguineo VARCHAR(3) NOT NULL,
        codPostal INT(5) NOT NULL,
        telefonoMovil INT(9) NOT NULL)";

        ejecutar_consulta($conexion, $sql);
}

function crear_tabla_historico($conexion){
    $sql = "CREATE TABLE IF NOT EXISTS historico(
        idDonante INT(6) PRIMARY KEY,
        fechaDonacion DATE NOT NULL,
        fechaProximaDonacion DATE NOT NULL,
        PRIMARY KEY (idDonante, fechaDonacion),
        FOREIGN KEY (idDonante) REFERENCES donantes(id) ON DELETE CASCADE";

        ejecutar_consulta($conexion, $sql);
}

function crear_tabla_administradores($conexion){
    $sql= "CREATE TABLE IF NOT EXISTS administradores(
        nombre VARCHAR(50) PRIMARY KEY,
        contrasinal VARCHAR(200) NOT NULL)";

        ejecutar_consulta($conexion, $sql);
}


function dar_alta_donante($conexion, $nombre, $apellidos, $edad, $grupoSanguineo, $codPostal, $telefonoMovil){
    $consulta = $conexion -> prepare("INSERT INTO donantes(nombre, apellidos, edad, grupoSanguineo, codPostal, telefonoMovil) VALUES (:nombre, :apellidos, :edad, :grupo, :cp, :movil)");
    $consulta->bindParam(":nombre", $nombre);
    $consulta->bindParam(":apellidos", $apellidos);
    $consulta->bindParam(":edad", $edad);
    $consulta->bindParam(":grupo", $grupoSanguineo);
    $consulta->bindParam(":cp", $codPostal);
    $consulta->bindParam(":movil", $telefonoMovil);
    $consulta->execute();


}

function get_donantes($conexion){
    $consulta = $conexion -> prepare("SELECT * FROM donantes");
    $consulta->execute();
    return $consulta;
}

function eliminar_donante($conexion, $idDonante){
    $consulta = $conexion -> prepare("DELETE FROM donantes WHERE id=$idDonante");

    return $consulta->execute();
}


function buscar_donante_cp($conexion, $codPostal){
    $consulta = $conexion -> prepare("SELECT * FROM donantes WHERE codPostal= :codigoP");
    $consulta->bindParam(":codigoP", $codPostal);
    $consulta->execute();
    return $consulta;
}


function cerrar_conexion($con){
    $con = null;
}

?>