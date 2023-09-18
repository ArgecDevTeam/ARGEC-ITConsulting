<?php 
  session_start();
  if ($_POST){
    include('../../php/bd.php');

    $usuario = (isset($_POST['usuario'])) ?$_POST['usuario'] : '';
    $password = (isset($_POST['password'])) ?$_POST['password'] : '';
    
    // Seleccionar registros
    $sentencia = $conexion->prepare("SELECT *, count(*) as usuario FROM `admin` 
    WHERE usuario = :usuario
    AND password= :password
    ");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();
    $listaUser = $sentencia->fetch(PDO::FETCH_LAZY);

    print_r($listaUser);

    if ($listaUser['usuario'] > 0){
      print_r("Usuario y contraseña correctos");
      $_SESSION['usuario'] = $listaUser['usuario'];
      $_SESSION['logueado'] = true;
      header("Location: ../admin/index.php");
    }else{
      echo "Usuario y contraseña incorrectos";
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.webp" type="image/x-icon">
  <title>ARGEC - IT Consulting</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/login.css">
  <!-- <link rel="stylesheet" href="../../assets/estilos/dashboardd.css"> -->
</head>
<body>
  <div id="Login">
    <section class="login">
      <div class="imagen">
        <img src="../../assets/img/argec-header-no-background.webp" alt="" width="100%">
      </div>
      <div class="login__contenedor">
        <h1>Login</h1>
        <form class="loginForm" action="" method="post">
          <div class="input-group">
            <input type="text" id="usuario" name="usuario" placeholder="Usuario">
            <span class="error-message"></span>
          </div>
          <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Contraseña">
            <span class="error-message"></span>
          </div>
          <input type="submit" value="Iniciar Secion">
        </form>
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
  <!-- <script src="../../assets/scripts/login.js"></script> -->
</body>
</html>