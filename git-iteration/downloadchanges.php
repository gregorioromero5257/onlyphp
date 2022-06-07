<?php
  $var = shell_exec('git merge remotes/origin/main 2> errordownload.txt;');
  header('Location: ../index.php');
  // return true;
 ?>
