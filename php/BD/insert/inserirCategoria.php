<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";

  $novaCategoria = strtoupper($_POST["novaCategoria"]);
  $novaCategoria = sanitize($novaCategoria);
  $buscarCategoria = "SELECT NOME_CATEGORIA FROM CATEGORIA WHERE NOME_CATEGORIA = '$novaCategoria';";

  $buscarCategoria = mysqli_query($conn, $buscarCategoria);
  $buscarCategoria = mysqli_fetch_array($buscarCategoria);
  if ($buscarCategoria) {
    header("Location:/php/categoria.php?cat=ps");
  }else {
    session_start();
    $idAutor = $_SESSION["idUsuarioSessao"];
    $inserirCategoria = "INSERT INTO CATEGORIA (NOME_CATEGORIA,ID_AUTOR) VALUES ('$novaCategoria',$idAutor);";
    mysqli_query($conn, $inserirCategoria);
    header("Location:/php/categoria.php?cat=s");
  }
  mysqli_close($conn);
?>
