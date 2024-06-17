<?php
include("lib/base_datos.php");
include("lib/utilidades.php");
get_connection();
crear_bd_tienda();
seleccionar_bd_tienda();
crear_tabla_usuarios();

$nombre = $apellidos = $edad = $provincia = $resultado = "";
$nombreErr = $apellidosErr = $edadErr = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $provincia = $_POST["provincia"];
}


//Validaciones:

if(!registroObligatorio($nombre) || !longitudNombre($nombre) || !validarString($nombre)){
    $nombreErr = "En nombre introducido no es válido";
    
}

if(!registroObligatorio($apellidos) || !longitudApellido($apellidos) || !validarString($apellidos)){
    $apellidosErr = "Los apellidos introducidos no son válidos";

}


if(!registroObligatorio($edad) || !validarEdad($edad) || !validarDigito($edad)){
    $edadErr = "Edad no válida.";
}

if(empty($nombreErr) && empty($apellidosErr) && empty($edadErr)){
    $resultado = crearUsuario($nombre, $apellidos, $edad, $provincia);
}



?>






<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda IES San Clemente </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <h1>Alta de usuario </h1>
    <?php
        //Comprobar se veñen datos polo $_POST
        //Conexión
        //Seleccionar bd
        //Executar o INSERT
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <p>Formulario de alta</p>
    <!-- o "action" chama a dar_de_alta.php de xeito reflexivo-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    Nombre: <input type="text" id="nombre" name ="nombre"> </br>
    <span class="error"><?php echo $nombreErr; ?></span>

    Apellidos: <input type="text" id="apellidos" name ="apellidos"> </br>
    <span class="error"><?php echo $apellidosErr; ?></span>

    Edad: <input type="number" id="edad" name = "edad"> </br>
    <span class="error"><?php echo $edadErr; ?></span>

    Provincia: </br>
    <select name="provincia" id="provincia">
        <option value="ACoruna">A Coruña</option>
        <option value="Lugo">Lugo</option>
        <option value="Ourense">Ourense</option>
        <option value="Pontevedra">Pontevedra</option>
        </select></br>
        <input type="submit" name="submit" value="Registrar">
    
    </form>
    <div class="resultado">
        <?php 
        if($resultado){
            echo $resultado;
        }
        ?>
    </div>
    <footer>
        <p>
            <a href='index.php'>Página de inicio</a>
        </p>
    </footer>
</body>

</html>
<?php del_connection(); ?>