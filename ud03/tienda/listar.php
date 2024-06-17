<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda IES San Clemente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <h1>Lista de usuarios</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <p>Lista de usuarios con enlaces para borrar y editar</p>
    <table>
        <tr>
            <td><b>id</b></td>
            <td><b>Nombre</b></td>
            <td><b>Apellidos</b></td>
            <td><b>Edad</b></td>
            <td><b>Provincia</b></td>
        </tr>
        <?php require_once 'lib/base_datos.php';
            get_connection();
            seleccionar_bd_tienda();

            //Función listar
            echo listarUsuarios();
            del_connection();
        ?>
    </table>
    <footer>
        <p>
            <a href='index.php'>Página de inicio</a>
        </p>
    </footer>
</body>

</html>