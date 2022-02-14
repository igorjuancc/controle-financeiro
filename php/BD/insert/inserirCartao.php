<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";
  session_start();

  $idAutor = $_SESSION["idUsuarioSessao"];
  $novoCartao = strtoupper($_POST["descricao"]);
  $novoCartao = sanitize($novoCartao);
  $digito = sanitize($_POST["digito"]);
  $tipo = $_POST["tipo"];
  $bandeira = $_POST["bandeira"];

  $inserirCartao = "INSERT INTO CARTAO (ID_USUARIO,TIPO,ID_BANDEIRA,DESCRICAO,DIGITO_FINAL) VALUES ($idAutor,'$tipo',$bandeira,'$novoCartao',$digito);";

  mysqli_query($conn, $inserirCartao);
  mysqli_close($conn);
  header("Location:/php/cartoes.php?card=s");
?>
