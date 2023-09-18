<?php
  include('../../php/bd.php');
  
  if ($_POST) {

    $titulo = (isset($_POST['titulo']))?$_POST['titulo']:"";
    $nombreArchivo = $_FILES["imagen"]["name"];
    $tipoArchivo = $_FILES["imagen"]["type"];
    $tamañoArchivo = $_FILES["imagen"]["size"];
    $tempArchivo = $_FILES["imagen"]["tmp_name"];
    $epigrafe = (isset($_POST['epigrafe']))?$_POST['epigrafe']:"";
    $fecha = (isset($_POST['fecha']))?$_POST['fecha']:"";
    $hora = (isset($_POST['hora']))?$_POST['hora']:"";
    $contenido = (isset($_POST['contenido']))?$_POST['contenido']:"";
    $resumen = (isset($_POST['resumen']))?$_POST['resumen']:"";
    $carpetaDestino = "../../assets/img/post-img";

    $allowedTypes = array("image/jpeg", "image/png", "image/gif", "image/webp");
    if(!in_array($tipoArchivo, $allowedTypes)) {
      print_r("Error: Solo se permiten archivos de imagen (JPEG, PNG, GIF, WEBP).");
    } else {
      $datosImagen = file_get_contents($tempArchivo);
      if(move_uploaded_file($tempArchivo, $carpetaDestino . $nombreArchivo)) {
        echo "Imagen subida exitosamente.";
      } else {
        echo "Error al subir la imagen.";
      }

      $sentencia = $conexion->prepare("INSERT INTO `publicaciones` (`ID`, `titulo`, `nom_imagen`, `tipo_imagen`, `datos_imagen`, `epigrafe`, `fecha`, `hora`, `contenido`, `resumen`) VALUES (NULL, :titulo, :nom_imagen, :tipo_imagen, :datos_imagen, :epigrafe, :fecha, :hora, :contenido, :resumen);");

      $sentencia->bindParam(":titulo", $titulo);        
      $sentencia->bindParam(":nom_imagen", $nombreArchivo);
      $sentencia->bindParam(":tipo_imagen", $tipoArchivo);
      $sentencia->bindParam(":datos_imagen", $datosImagen, PDO::PARAM_LOB);
      $sentencia->bindParam(":epigrafe", $epigrafe);
      $sentencia->bindParam(":fecha", $fecha);
      $sentencia->bindParam(":hora", $hora);
      $sentencia->bindParam(":contenido", $contenido);
      $sentencia->bindParam(":resumen", $resumen);
      if($sentencia->execute()) {  
        $mensaje = "Registro agregado con exito";
        header("Location:form.php?mensaje=$mensaje");
      } else {
        echo "Error al crear y guardar el post en la base de datos.";
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.webp" type="image/x-icon">
  <title>Nueva Publicacion</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/dashboardd.css">
  <link rel="stylesheet" href="../../assets/estilos/editar.css">
</head>
<body>
  <header class="header__dashboard">
    <div class="header__dashboard-titulo">
      <a href="../admin/index.php" style="margin-left: 40px;">Volver</a>
    </div>
  </header>

  <section class="formulario">
    <div class="formulario__titulo">
      <h1>Agregar publicacion</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="lado-1">  
        <div class="input-group">
          <label for="imagen">Imagen</label>
          <input type="file" name="imagen" id="imagen">
        </div>
        <div class="input-group">
          <label for="fecha">Fecha</label>
          <input type="date" name="fecha" id="fecha">
        </div>
        <div class="input-group">
          <label for="hora">Hora</label>
          <input type="time" name="hora" id="hora">
        </div>
      </div>
      <div class="lado-2">
        <div class="lado-3">
        </div>
        <div class="input-group">
          <label for="titulo">Titulo</label>
          <input type="text" name="titulo" id="titulo" maxlength="50" required>
        </div>
        <div class="input-group">
          <label for="epigrafe">Epigrafe</label>
          <input type="text" name="epigrafe" id="epigrafe" maxlength="25">
        </div>
        <div class="input-group">
          <label for="contenido">Contendio</label>
          <textarea type="text" name="contenido" id="contenido" required></textarea>
        </div>
        <div class="input-group">
          <label for="resumen">Resumen</label>
          <textarea type="text" name="resumen" id="resumen" maxlength="150"></textarea>
        </div>
        <div class="editar__botones">
          <input type="submit" value="Enviar" class="btn-editar">
          <a href="../admin/index.php" class="btn-cancelar">Cancelar</a>
        </div>
      </div>
    </form>
  </section>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
</body>
</html>