<?php
// Conectar a la base de datos (reemplaza con tus propios valores)
include('../../php/bd.php');

// Obtener el nombre de la imagen desde la URL
$nombreImagen = $_GET["nom_imagen"];

// Consulta para obtener los datos de la imagen
$consulta = $conexion->prepare("SELECT tipo_imagen, datos_imagen FROM publicaciones WHERE nom_imagen = ?");
$consulta->bindParam(1, $nombreImagen);
$consulta->execute();

if ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $tipoImagen = $fila['tipo_imagen'];
    $datosImagen = $fila['datos_imagen'];

    // Mostrar la imagen al navegador
    header("Content-Type: $tipoImagen");
    echo $datosImagen;
} else {
    echo "Imagen no encontrada.";
}
?>
