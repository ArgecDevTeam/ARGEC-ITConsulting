<?php

$servidor = 'localhost';
$baseDeDatos = 'blog-argec';
$usuario = 'root';
$password = '';

try{
  
  $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
  // echo "Conexion exitosa";

}catch(Exception $error){
  echo $error->getMessage();
}

?>