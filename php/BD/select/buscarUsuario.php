<?php
  function buscarUsuario($login, $senha){
    include "lib/connection.php";
    include "lib/sanitize.php";
    $login = sanitize($login);
    $senha = sanitize($senha);
    $buscarUsuario = "SELECT * FROM USUARIO WHERE USER_NAME = '$login' AND SENHA = '$senha';";

    $retornoUsuario = mysqli_query($conn, $buscarUsuario);
    $retornoUsuario = mysqli_fetch_array($retornoUsuario);
    if(isset($retornoUsuario['SENHA'])){
      $retornoUsuario['SENHA'] = "";
    }
    mysqli_close($conn);
    return $retornoUsuario;
  }
?>
