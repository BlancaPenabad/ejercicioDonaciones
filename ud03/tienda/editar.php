<?php
include("lib/base_datos.php");
get_connection();
seleccionar_bd_tienda();

$id = 0;

$nombre = $apellidos = $edad = $provincia = "";

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $provincia = $_POST["provincia"];


    modificaUsuario($id, $nombre, $apellidos, $edad, $provincia);

}


del_connection();

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
    <h1>Editar usuario </h1>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <p>Formulario de edición</p>
    <!-- o "action" chama a editar.php de xeito reflexivo-->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    Nombre: <input type="text" name ="nombre" value="<?= $nombre?>"> </br>
    
    Apellidos: <input type="text" name ="apellidos" value="<?= $apellidos?>"> </br>

    Edad: <input type="number"  name = "edad" value="<?= $edad?>"> </br>

    Provincia: </br>
    <select name="provincia" id="provincia">
        <option value="ACoruna">A Coruña</option>
        <option value="Lugo">Lugo</option>
        <option value="Ourense">Ourense</option>
        <option value="Pontevedra">Pontevedra</option>
        </select></br>
        <input type="submit" name="submit" value="Registrar">
    
        <input type="hidden" name="id" value="<?= $id?>" />
        <input type="submit" name="submit" value="Modificar usuario"/> 
    </form>
    <div class="resultado">

    <footer>
        <p>
            <a href='index.php'>Página de inicio</a>
        </p>
    </footer>
</body>

</html>