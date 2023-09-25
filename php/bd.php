<?php
$servidor = 'localhost';
$baseDeDatos = 'blog-argec';
$usuario = 'root';
$password = '1234';

try{
  $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
  // echo "Conexion exitosa";
}catch(Exception $error){
  header('Location: ../404.html');
}
?>