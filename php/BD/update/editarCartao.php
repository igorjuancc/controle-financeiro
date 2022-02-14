<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";

  session_start();

  $cartaoEditar = sanitize($_GET['card']);
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $buscaCartao = "SELECT * FROM CARTAO WHERE ID_USUARIO = $idUsuario AND ID_CARTAO = $cartaoEditar;";

  $buscaCartao = mysqli_query($conn, $buscaCartao);
  $buscaCartao = mysqli_fetch_array($buscaCartao);


  if($buscaCartao["ID_CARTAO"]){
    $descricao = $buscaCartao["DESCRICAO"];
    $digito = $buscaCartao["DIGITO_FINAL"];
    $tipo = $buscaCartao["TIPO"];
    $bandeira = $buscaCartao["ID_BANDEIRA"];

    if (!empty($_POST["cartao"])) {
      $descricao = strtoupper($_POST["cartao"]);
      $descricao = sanitize($descricao);
    }
    if (!empty($_POST["digito"])) {
      $digito = sanitize($_POST["digito"]);
    }
    if (!empty($_POST["tipo"])) {
      $tipo = $_POST["tipo"];
    }
    if (!empty($_POST["bandeira"])) {
      $bandeira = $_POST["bandeira"];
    }

    $cartaoEdit = "UPDATE CARTAO SET DESCRICAO = '$descricao', DIGITO_FINAL = $digito, TIPO = '$tipo', ID_BANDEIRA = $bandeira WHERE ID_USUARIO = $idUsuario AND ID_CARTAO = $cartaoEditar;";

    echo $result = mysqli_query($conn, $cartaoEdit);

    if($result > 0){
      header("Location:/php/cartoes.php?card=e");
    }else {
      header("Location:/php/cartoes.php?card=pe");
    }
  }else {
    header("Location:/php/cartoes.php?card=pe");
  }
mysqli_close($conn);
?>
