<?php
  session_start();
  unset($_SESSION["idUsuarioSessao"]);
  session_destroy();
  header('Location: ../index.php');
?>
