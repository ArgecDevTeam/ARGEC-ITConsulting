<?php
$servidor = '********';
$baseDeDatos = '********';
$usuario = '******';
$password = '******';

try{
  $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
  // echo "Conexion exitosa";
}catch(Exception $error){
  header('Location: ../404.php');
}
?>
