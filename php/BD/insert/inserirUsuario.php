<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";

  $nome = sanitize($_POST["Nome"]);
  $nickname = sanitize($_POST["Nickname"]);
  $senha = md5($_POST["Senha"]);
  $confSenha = md5($_POST["Csenha"]);

  $buscarUsuario = 'SELECT NOME_USUARIO FROM USUARIO WHERE NOME_USUARIO = "'.$nome.'";';
  $buscarNickname = 'SELECT USER_NAME FROM USUARIO WHERE USER_NAME = "'.$nickname.'";';
  $buscarUsuario = mysqli_query($conn, $buscarUsuario);
  $buscarNickname = mysqli_query($conn, $buscarNickname);
  $buscarUsuario = mysqli_fetch_array($buscarUsuario);
  $buscarNickname = mysqli_fetch_array($buscarNickname);

  if ((!isset($buscarNickname["USER_NAME"])) && (!isset($buscarUsuario["NOME_USUARIO"]))) {
    $novoUsuario = "INSERT INTO USUARIO (NOME_USUARIO,USER_NAME,SENHA) VALUES ('$nome','$nickname','$senha');";
    mysqli_query($conn, $novoUsuario);
    header("Location:/cadastro.php?add=1");
  }
  if ((isset($buscarUsuario["NOME_USUARIO"]))) {
    header("Location:/cadastro.php?erro=2");
  }
  if ((isset($buscarNickname["USER_NAME"]))) {
    header("Location:/cadastro.php?erro=1");
  }


  mysqli_close($conn);
?>
