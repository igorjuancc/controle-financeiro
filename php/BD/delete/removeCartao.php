<?php
  include "../lib/connection.php";
  include "../select/buscarCategoria.php";

  session_start();

  $cartaoRemover = $_GET['card'];
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $buscaCartao = "SELECT ID_CARTAO FROM CARTAO WHERE ID_CARTAO = $cartaoRemover and ID_USUARIO = $idUsuario;";

  $buscaCartao = mysqli_query($conn, $buscaCartao);
  $buscaCartao = mysqli_fetch_array($buscaCartao);

  if(isset($buscaCartao['ID_CARTAO'])){
    $cartaoRemover = "DELETE FROM CARTAO WHERE ID_CARTAO = $cartaoRemover;";
    $cartaoRemover = mysqli_query($conn, $cartaoRemover);
    if ($cartaoRemover) {
      header("Location:/php/cartoes.php?card=r");
    }
  }else{
    header("Location:/php/cartoes.php?card=pr");
  }
  mysqli_close($conn);

  /*
    card = s ---> inserida
    card = r ---> removida
    card = pr ---> problema ao remover
    card = ps ---> problema ao inserir
  */
?>
