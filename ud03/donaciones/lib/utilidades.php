<?php

function test_input($dato){
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

function get_mensajes_html_format($mensajes)
{
    $resultado = "";

    if (count($mensajes) > 0) {
        foreach ($mensajes as $mensaje) {
            if ($mensaje[0] == "error") {
                $resultado .= '<div class="alert alert-danger" role="alert">' . $mensaje[1] . '</div>';
            } elseif ($mensaje[0] == "success") {
                $resultado .= '<div class="alert alert-success" role="alert">' . $mensaje[1] . '</div>';
            }
        }
    }

    return $resultado;
}
?>