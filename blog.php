<?php
  include('./php/bd.php');


  $limitePagina = 6;

  $sentencia = $conexion->prepare("SELECT * FROM `publicaciones` ORDER BY ID DESC LIMIT $limitePagina");
  $sentencia->execute();
  $listaPost = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/No-background2.webp" type="image/x-icon">
  <title>ARGEC - IT Consulting </title>
  <link rel="stylesheet" href="./assets/estilos/main.css">
  <link rel="stylesheet" href="./assets/estilos/blog.css">
  <link rel="stylesheet" href="./assets/estilos/tablet/blog-tablet.css">
  <link rel="stylesheet" href="./assets/estilos/mobile/blog-mobile.css">
</head>
<body>
  <header class="header">
    <div class="header__menu">
    <a href="./index.html"><img src="./assets/img/argec-header-no-background.webp" alt="ARGEC - IT Consulting" class="header__menu-logo"></a>
      <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
          <i class="fas fa-bars"></i>
        </label>

        <ul class="header__menu-items">
          <li class="header__menu-links"><a href="./index.html">Inicio</a></li>
          <li class="header__menu-links"><a href="./about.html">Acerca Nuestro</a></li>
          <li class="header__menu-links header__menu-links--active"><a href="./blog.php">Blog</a></li>
          <li class="header__menu-links"><a href="./contact.html">Contáctenos</a></li>
        </ul>
      </nav>
    </div>
    <div class="header__titulo">
      <div class="header__fondo">
        <h1>Blog</h1>
      </div>
    </div>
  </header>

  <section class="blog">
    <div class="blog__contenedor">
      <?php foreach ($listaPost as $publicacion) { ?>
        <div class="blog__tarjeta" id="Tarjeta">
          <div class="blog__imagen">
            <img src="./assets/img/post-img/<?php echo $publicacion['nom_imagen'];?>" alt="<?php echo $publicacion['titulo'];?>" height="100%" width="100%">
          </div>
          <div class="blog__texto">
            <h3><?php echo $publicacion['titulo'];?></h3>
            <p>
              <?php echo $publicacion['resumen'];?>
            </p>
          </div>
          <div class="blog__botones" id="Boton">
            <a href="./post.php?txtID=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      <?php }?>
    </div>
    <div class="blog__boton">
      <input type="submit" name="paginas" style="border: 1px red solid; " value="Cargar mas">
    </div>
  </section>

  <footer class="footer">
    <img src="./assets/img/argec-header-no-background.webp" alt="ARGEC - IT Consulting" class="footer__logo">
    <div class="footer__redes">
      <a href="https://www.linkedin.com/company/argec-itconsulting/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-linkedin"></i>
      </a>
      <a href="https://www.instagram.com/argec_itconsulting/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a href="https://www.facebook.com/argecitconsulting/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-facebook"></i>
      </a>
      <a href="mailto:rrhh@argec.net" target="_blank" rel="noopener noreferrer">
        <i class="fa-solid fa-envelope"></i>
      </a>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
</body>
</html>