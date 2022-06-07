<?php
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  if (isset($_POST['apellido'])) {
    $consultaSQL = "SELECT * FROM alumnos WHERE apellido LIKE '%" . $_POST['apellido'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM alumnos";
  }

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = isset($_POST['apellido']) ? 'Lista de alumnos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';

return $titulo
?>
