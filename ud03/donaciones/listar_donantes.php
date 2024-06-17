<?php

include "lib/base_datos.php";
include "lib/utilidades.php";

$conexion = get_conexion();
seleccionar_bd_donacion($conexion);

$resultado_consulta = get_donantes($conexion);


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donación Sangre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <br>
    <h1>Gestión donacion de Sangre</h1>
    <h1>Listado de donantes:</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Grupo Sanguíneo</th>
            <th>Código Postal</th>
            <th>Teléfono Móvil</th>
        </tr>   
        
        <?php  
            while($fila = $resultado_consulta->fetch()){
                echo "<tr>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellidos'] . "</td>";
                echo "<td>" . $fila['edad'] . "</td>";
                echo "<td>" . $fila['grupoSanguineo'] . "</td>";
                echo "<td>" . $fila['codPostal'] . "</td>";
                echo "<td>" . $fila['telefonoMovil'] . "</td>";
                echo "<td> <a class='btn btn-primary' href=borrar_donante.php?id=" . $fila['id'] . ">Borrar</a> </td>" ;

            }
        ?>
    </table>

    <footer>
        <p><a href='index.php'>Página de inicio</a></p>
    </footer>
    
    <?php
        cerrar_conexion($conexion);
    ?>
</body>

</html>