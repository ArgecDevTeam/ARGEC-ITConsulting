<?php
  include('../../php/bd.php');

  if (isset($_GET['txtID'])){
    // Borrar registros con el ID correspondiente
    $txtID = (isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("SELECT nom_imagen FROM publicaciones WHERE ID = :ID");
    $sentencia->bindParam(':ID',$txtID);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen['nom_imagen'])){
      if (file_exists('../../assets/img/post-img/'.$registro_imagen['nom_imagen'])){
        unlink('../../assets/img/post-img/'.$registro_imagen['nom_imagen']);
      }
    }

    $sentencia = $conexion->prepare("DELETE FROM publicaciones WHERE ID = :ID");
    $sentencia->bindParam(':ID',$txtID);
    $sentencia->execute();
  }

  // Seleccionar registros
  $sentencia = $conexion->prepare("SELECT * FROM `publicaciones`");
  $sentencia->execute();
  $listaPost = $sentencia->fetchAll(PDO::FETCH_ASSOC);

  session_start();
  if (!isset($_SESSION['usuario'])){
    header("Location:../login/login.php");
  }

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.ico" type="image/x-icon">
  <title>Dashboard - ARGEC</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/dashboard.css">
</head>
<body>
  <header class="header__dashboard">
    <div class="header__dashboard-titulo">
      <img src="../../assets/img/No-background2.webp" alt="" height="100%">
      <a href="./index.php">Dashboard - ARGEC</a>
    </div>
    <div class="header__dashboard-logout">
      <a href="./agregar.php"><i class="fa-solid fa-plus"></i>Agregar</a>
      <a href="../../php/cerrar.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
  </header>

  <section class="dashboard">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Titulo</th>
          <th>Imagen</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>-</th>
        </tr>
      </thead>
      <tbody>
        
        <?php foreach ($listaPost as $publicacion) { ?>
          <tr>
            <td><?php echo $publicacion['ID'];?></td>
            <td><?php echo $publicacion['titulo'];?></td>
            <td><img src="../../assets/img/post-img/<?php echo $publicacion['nom_imagen']?>" width="50px" alt=""></td>
            <td><?php echo $publicacion['fecha'];?></td>
            <td><?php echo $publicacion['hora']?></td>
            <td>
              <a href="index.php?txtID=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-trash"></i></a>|<a href="editar.php?txtID=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-file-pen"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
</body>
</html>