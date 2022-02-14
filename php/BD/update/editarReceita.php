<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";

  session_start();

  $receitaEditar = $_GET['rec'];
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $buscaReceita = "SELECT * FROM RECEITA WHERE ID_AUTOR = $idUsuario AND ID_RECEITA = $receitaEditar;";

  $buscaReceita = mysqli_query($conn, $buscaReceita);
  $buscaReceita = mysqli_fetch_array($buscaReceita);

  if($buscaReceita["ID_RECEITA"]){
    $descricao = $buscaReceita["DESCRICAO"];
    $data = $buscaReceita["DATA"];
    $valor = $buscaReceita["VALOR"];

    if (!empty($_POST["receita"])) {
      $descricao = strtoupper($_POST["receita"]);
      $descricao = sanitize($descricao);
    }
    if (!empty($_POST["data"])) {
      $data = sanitize($_POST["data"]);
    }
    if (!empty($_POST["valor"])) {
      $valor = $_POST["valor"];
    }

    $receitaEdit = "UPDATE RECEITA SET DESCRICAO = '$descricao', DATA = '$data', VALOR = $valor WHERE ID_AUTOR = $idUsuario AND ID_RECEITA = $receitaEditar;";

    $result = mysqli_query($conn, $receitaEdit);

    if($result > 0){
      header("Location:/php/receita.php?rec=e");
    }else {
      header("Location:/php/receita.php?rec=pe");
    }
  }else {
    header("Location:/php/receita.php?rec=pe");
  }
mysqli_close($conn);
?>
