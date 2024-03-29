<?php
$config = include 'config.php';

// Ejecutamos un fetc para bajar cambios de la rama main
// Al ejecutar el comando anterior se crea una rama llamada upstream/main
// Hacemos checkout a la rama upstream/main
// Log pretty para guardar los datos en el archivo new.txt
// Regresamos a nuestra rama
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $git = shell_exec('fetchw.sh 2> errorfetch.txt;');
} else {
  // NOTE: Importante revisar que para linux se asignen los permisos a a carpeta necesario
    $git= shell_exec('./fetch.sh 2> errorfetch.txt;git checkout upstream/main;git log --pretty=format:"%hws-%an-%ar-%s" > new.txt;git checkout main;git status;');
}
// En este paso solo revisamos si existe un cambio ya lo descargamos pero aun no esta instalado

// Procedemos a guardar el data del new.txt que contiene informacion de los cambios
try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
  // Crearmos una variable para ignorar los cambios que nosotros tenemos
  // Se debe configura para

  // Leemos el archivo creado
  $lineas = file('./new.txt');

  foreach ($lineas as $key => $value) {
    $valores = explode('-',$value);
        $data = [
          "procs"   => $valores[0],
          "user" => $valores[1],
          "data"    => $valores[2],
          "name"     => $valores[3],
        ];
      //Buscamos si el registro a ingresar no existe
      $consultaSQLBusqueda = "SELECT 1 FROM git where procs = '$valores[0]'";
      $sentencia_busqueda = $conexion->prepare($consultaSQLBusqueda);
      $sentencia_busqueda->execute();

      $resultado_busqueda = $sentencia_busqueda->fetchAll();
      // Guerdamos si la busqueda arroja un resultado 0
      if (count($resultado_busqueda) == 0) {
        $consultaSQL = "INSERT INTO git (procs, user, data, name)";
        $consultaSQL .= "values (:" . implode(", :", array_keys($data)) . ")";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($data);
      }
  }
  // Consultamos los registros de la tabla git con status 0 ya que son estos los cambios aun no descargados
  $consultaSQL = "SELECT * FROM git where status = 0";
  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $git = $sentencia->fetchAll();

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}


return $git;

?>
