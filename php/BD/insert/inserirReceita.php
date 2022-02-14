<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";
  session_start();

  $novaReceita = strtoupper($_POST["novaReceita"]);
  $novaReceita = sanitize($novaReceita);
  $data = $_POST["data"];
  $data = sanitize($data);
  $valor = $_POST["valor"];
  $valor = sanitize($valor);
  $idAutor = $_SESSION["idUsuarioSessao"];
  $inserirReceita = "INSERT INTO RECEITA (DESCRICAO,DATA,VALOR,ID_AUTOR) VALUES ('$novaReceita','$data',$valor,$idAutor)";
  mysqli_query($conn, $inserirReceita);
  mysqli_close($conn);
  header("Location:/php/receita.php?rec=s");
?>
