<?php
  include('../../php/bd.php');
  
  if (isset($_GET['txtID'])){
    
    $txtID = (isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("SELECT * FROM `publicaciones` WHERE ID= :ID");
    $sentencia->bindParam(':ID',$txtID);
    $sentencia->execute();
    $lista = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $lista['titulo'];    
    $nombreArchivo = $lista["nom_imagen"];
    $epigrafe = $lista['epigrafe'];
    $fecha = $lista['fecha'];
    $hora = $lista['hora'];
    $contenido = $lista["contenido"];
    $resumen = $lista['resumen'];  

  }

  if ($_POST) {

    $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
    $titulo = (isset($_POST['titulo']))?$_POST['titulo']:"";
    $epigrafe = (isset($_POST['epigrafe']))?$_POST['epigrafe']:"";
    $fecha = (isset($_POST['fecha']))?$_POST['fecha']:"";
    $hora = (isset($_POST['hora']))?$_POST['hora']:"";
    $contenido = (isset($_POST['contenido']))?$_POST['contenido']:"";
    $resumen = (isset($_POST['resumen']))?$_POST['resumen']:"";

    $sentencia = $conexion->prepare("UPDATE `publicaciones` 
    SET 
    titulo=:titulo,
    epigrafe=:epigrafe,
    fecha=:fecha,
    hora=:hora,
    contenido=:contenido,
    resumen=:resumen WHERE ID= :ID;");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":epigrafe", $epigrafe);
    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->bindParam(":hora", $hora);
    $sentencia->bindParam(":contenido", $contenido);
    $sentencia->bindParam(":resumen", $resumen);
    $sentencia->bindParam(":ID", $txtID);
    $sentencia->execute();

    if ($_FILES['imagen']['name']!=""){
      
      $nombreArchivo = (isset($_FILES["imagen"]["name"])) ?$_FILES["imagen"]["name"]:"";
      $fechaImagen = new DateTime();
      $nom_archivo_imagen = ($nombreArchivo!="")?$fechaImagen->getTimestamp()."_".$nombreArchivo:"";

      $tmp_imagen = $_FILES["imagen"]["tmp_name"];

      move_uploaded_file($tmp_imagen,"../../assets/img/post-img/".$nom_archivo_imagen);
      
      // Borrado del archivo anterior 

      $sentencia = $conexion->prepare("SELECT nom_imagen FROM publicaciones WHERE ID = :ID");
      $sentencia->bindParam(':ID',$txtID);
      $sentencia->execute();
      $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
  
      if(isset($registro_imagen['nom_imagen'])){
        if (file_exists('../../assets/img/post-img/'.$registro_imagen['nom_imagen'])){
          unlink('../../assets/img/post-img/'.$registro_imagen['nom_imagen']);
        }
      }

      $sentencia = $conexion->prepare("UPDATE `publicaciones` 
      SET nom_imagen=:nom_imagen WHERE ID= :ID;");

      $sentencia->bindParam(":nom_imagen", $nom_archivo_imagen);
      $sentencia->bindParam(":ID", $txtID);
      $sentencia->execute();
    }

    $mensaje = "Registro modificado con exito";
    header("Location:index.php?mensaje=$mensaje");

  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.webp" type="image/x-icon">
  <title>Editar Publicacion</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/dashboardd.css">
  <link rel="stylesheet" href="../../assets/estilos/editar.css">
</head>
<body>
  <header class="header__dashboard">
    <div class="header__dashboard-titulo">
      <a href="./index.php" style="margin-left: 40px;">Volver</a>
    </div>
  </header>

  <section class="formulario">
    <div class="formulario__titulo">
      <h1>Editar publicacion</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="lado-1">  
        <div class="input-group">
          <label for="imagen">Imagen</label>
          <img src="../../assets/img/post-img/<?php echo $nombreArchivo?>" alt="<?php echo $titulo;?>">
          <input type="file" name="imagen" id="imagen">
        </div>
      </div>
      <div class="lado-2">
        <div class="lado-3">            
          <div class="input-group">
            <label for="txtID">ID</label>
            <input readonly value="<?php echo $txtID;?>" 
              type="text" name="txtID" id="txtID">
          </div>
          <div class="input-group">
            <label for="fecha">Fecha</label>
            <input value="<?php echo $fecha;?>"
              type="date" name="fecha" id="fecha">
          </div>
          <div class="input-group">
            <label for="hora">Hora</label>
            <input value="<?php echo $hora;?>" type="time" name="hora" id="hora">
          </div>
        </div>
        <div class="input-group">
          <label for="titulo">Titulo</label>
          <input value="<?php echo $titulo;?>" type="text" name="titulo" id="titulo" maxlength="50">
        </div>
        <div class="input-group">
          <label for="epigrafe">Epigrafe</label>
          <input value="<?php echo $epigrafe;?>" type="text" name="epigrafe" id="epigrafe" maxlength="25">
        </div>
        <div class="input-group">
          <label for="contenido">Contendio</label>
          <textarea type="text" name="contenido" id="contenido"><?php echo trim($contenido);?></textarea>
        </div>
        <div class="input-group">
          <label for="resumen">Resumen</label>
          <textarea type="text" name="resumen" id="resumen" maxlength="150"><?php echo trim($resumen);?></textarea>
        </div>
        <div class="editar__botones">
          <input type="submit" value="Actualizar" class="btn-editar">
          <a href="../admin/index.php" class="btn-cancelar">Cancelar</a>
        </div>
      </div>
    </form>
  </section>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
</body>
</html>