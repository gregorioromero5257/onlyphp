<?php
  $config = include 'config.php';
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      $var = shell_exec('mergew.sh');
    }else {
      $var = shell_exec('git merge upstream/main 2> errordownload.txt;');
    }
    $consultaSQL = "UPDATE git SET
        status = 1
        WHERE status = 0";
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($alumno);
    header('Location: ../index.php');
  } catch(PDOException $error) {
    return var_dump($error->getMessage());
  }
 ?>
