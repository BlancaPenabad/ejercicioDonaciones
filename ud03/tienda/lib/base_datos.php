<?php

global $connection;


/*Función para establecer la conexión con la BD (MySQL orientado a objetos) y 
control de posibles errores */
function get_connection(){
    global $connection;
    @$connection = new mysqli('db', 'root', 'test', 'dbname');
    $error = $connection->connect_errno;
    if($connection->connect_error){
        die("</br>Fallo en la conexión: ".$connection->connect_error." con número ".$error);
    }
    //echo "</br>Conexión correcta.";
    
}

//Función para cerrar la conexión
function del_connection(){
    global $connection;
    if($connection){
        $connection->close();
    }
}


//Función para crear la base de datos 'tienda'
function crear_bd_tienda(){
    global $connection;
    $sql = "CREATE DATABASE IF NOT EXISTS tienda";
    if($connection->query($sql)){
        //echo "</br>La base de datos 'tienda' ha sido creada.";
    }else{
        echo "</br>¡ERROR! La base de datos no ha podido crearse: ".$connection->error;
    }
}


function seleccionar_bd_tienda(){
    global $connection;
    if($connection->select_db('tienda')){
        //echo "</br> Se ha seleccionado la base de datos 'tienda'.";
    }else{
        echo "</br>Error al seleccionar la base de datos: ".$connection->error;
    }
}

//Función para crear la tabla 'usuarios'
function crear_tabla_usuarios(){
    global $connection;
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellidos VARCHAR(100) NOT NULL,
        edad INT NOT NULL,
        provincia VARCHAR(50) NOT NULL)";

    if($connection->query($sql)){
        //echo "</br>La tabla 'usuarios' ha sido creada.";
    }else{
        echo "</br>¡ERROR! La tabla 'usuarios' no ha podido crearse: ".$connection->error;
    }
}


//Función para dar de alta un usuario
function crearUsuario($nombre, $apellidos, $edad, $provincia){
    global $connection;

    $stmt = $connection->prepare("INSERT INTO usuarios (nombre, apellidos, edad, provincia) VALUES (?,?,?,?)");
    if(!$stmt){
        die("</br>Error al crear el nuevo usuario. ".$connection->error);

    }
    $stmt->bind_param("ssis", $nombre, $apellidos, $edad, $provincia);
    $stmt->execute();

    return "<p>El nuevo usuario ha sido dado de alta.</p>";
    $stmt.close();
}

//Función que muestra los usuarios en una tabla con opciones de edición y eliminación
function listarUsuarios(){
    global $connection;
    $sql = "SELECT * FROM usuarios";

    $resultado = $connection->query($sql);

    if ($resultado-> num_rows > 0) {
        while($row = $resultado->fetch_assoc()){
            echo "<tr>";
            echo "<td>" .$row["id"]."</td>";
            echo "<td>" .$row["nombre"]."</td>";
            echo "<td>" .$row["apellidos"]."</td>";
            echo "<td>" .$row["provincia"]."</td>";
            echo "<td> <a class='btn btn-primary' href=editar.php?id=".$row['id'].">Editar</a> </td>";
            echo "<td> <a class='btn btn-primary' href=borrar.php?id=".$row['id'].">Eliminar</a> </td>";
            echo "</tr>";
        }
    }else{
        echo "No hay resultados";
    }
}

//Función que elimina un usuario segun su id
function eliminarUsuario($idUsuario){
    global $connection;

    //Crear la consulta
    $stmt = $connection->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt->bind_param("i", $idUsuario);

    if ($stmt->execute()){
        return "<p>Usuario con id=".$idUsuario." eliminado.</p>";

    }else{
        return "</br>¡ERROR! No se ha podido eliminar al usuario. Error: ".$connection->error;
    }
    $stmt.close();
}

//Función que modifica un usuario
function modificaUsuario($id, $nombre, $apellidos, $edad, $provincia){
    global $connection;

    $stmt = $connection->prepare("UPDATE usuarios SET nombre=?, apellidos=?, edad=?, provincia=? WHERE id=?");
    $stmt->bind_param("ssisi", $nombre, $apellidos, $edad, $provincia, $id);

    if($stmt->execute()){
        return "<p>El usuario ha sido modificado correctamente.</p>";
    }else{
        return "</br>¡ERROR! No se ha podido modificar el usuario. Error nº ".$connection->error;

    }
    $stmt->close();
}
