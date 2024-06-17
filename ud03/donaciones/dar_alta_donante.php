<?php
include "lib/base_datos.php";
include "lib/utilidades.php";

$conexion = get_conexion();
seleccionar_bd_donacion($conexion);



$mensajes = array();

$nombre = "";
$apellidos = "";
$grupoSanguineo = "";
$edad = "";
$codPostal = "";
$movil = "";


//VALIDACIONES:

if(isset($_POST['submit'])) {

    if(!empty($_POST['name'])){
        $nombre = test_input($_POST['name']);
    }else{
        $mensajes[] = array("error", "Indroduce un nombre.");
    }


    if(!empty($_POST['apellidos'])){
        $apellidos = test_input($_POST['apellidos']);
    }else{
        $mensajes[] = array("error", "Indroduce un apellido.");
    }


    if(!empty($_POST['grupos'])){
        $grupoSanguineo = test_input($_POST['grupos']);
    }else{
        $mensajes[] = array("error", "Indroduce un grupo sanguíneo.");
    }




    //VALIDAR MAYORÍA DE EDAD:
    if(!empty($_POST['edad']) && is_numeric($_POST['edad']) && $_POST['edad'] >= 18){
        $edad = test_input($_POST['edad']);
    }elseif (!empty($_POST['edad']) && $_POST['edad'] < 18){
        $mensajes[] = array("error", "Debes ser mayor de edad.");
    }else{
        $mensajes[] = array("error", "Introduce un valor numérico.");
    }

    //VALIDAR CÓDIGO POSTAL DE 5 DÍGITOS
    if(!empty($_POST['codpostal']) && is_numeric($_POST['codpostal']) && strlen($_POST['codpostal']) == 5){
        $codPostal = test_input($_POST['codpostal']);
    }else{
        $mensajes[] = array("error", "Sólo CP de 5 dígitos.");
    }

    //VALIDAR MÓVIL DE 9 DÍGITOS

    if(!empty($_POST['movil']) && is_numeric($_POST['movil']) && strlen($_POST['movil']) == 9){
        $movil = test_input($_POST['movil']);
    }else{
        $mensajes[] = array("error", "Sólo teléfonos de 9 dígitos.");
    }



    //DAR DE ALTA:
    if(count($mensajes) == 0){
        dar_alta_donante($conexion, $nombre, $apellidos, $edad, $grupoSanguineo, $codPostal, $movil);
        $mensajes[] = array("success", "Alta realizada");
    }



}

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
    <h1>Alta de donante</h1>
    <?= get_mensajes_html_format($mensajes) ?>
    <div>
        Formulario para dar de alta un donante:
        <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Nombre: <input type="text" name="name" value="<?= $nombre?>"> </br>
            Apellidos:<input type="text" name="apellidos" value="<?= $apellidos?>"> </br>
            Edad: <input type="text" name="edad" value="<? $edad ?>"> </br>
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Grupo sanguíneo:</label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="grupos">
                <option value="0-">O-</option>
                <option value="0+">O+</option>
                <option value="A-">A-</option>
                <option value="A+">A+</option>
                <option value="B-">B-</option>
                <option value="B+">B+</option>
                <option value="AB-">AB-</option>
                <option value="AB+">AB+</option>
                <option value="<? $grupoSanguineo ?>" selected><?= $grupoSanguineo ?></option>
            </select> </br>
            Código postal : <input type="text" name = "codpostal" value="<?= $codPostal  ?>"></br>
            Teléfono móvil: <input type="text" name = "movil" value="<?= $movil ?>"></br>

            <input type="submit" name="submit" value="Submit" >
        </form>
    </div>

    <footer>
        <p><a href='index.php'>Página de inicio</a></p>
    </footer>

    <?php 
    cerrar_conexion($conexion);
    ?>

</body>

</html>