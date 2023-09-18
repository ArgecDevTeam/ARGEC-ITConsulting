<?php

$carpeta_destino = '../../assets/img/post-img';
$nombre_archivo = $_FILES['imagen']['name'];

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_archivo)) {
    echo 'Imagen subida exitosamente.';
} else {
    echo 'Error al subir la imagen.';
}


?>