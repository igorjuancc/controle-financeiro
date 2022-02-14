<?php
  include "BD/lib/connection.php";

  $dataAnterior = date('Y-m-d', strtotime('-1 months', strtotime(date('Y-m-d'))));
  $codBalanco = date('Ym',strtotime($dataAnterior));
  $codBalanco = $codBalanco.$_SESSION["idUsuarioSessao"];
  $idUsuario = $_SESSION["idUsuarioSessao"];

  $idBalanco = "SELECT ID_BALANCO FROM BALANCO WHERE ID_BALANCO = ".$codBalanco.";";
  $idBalanco = mysqli_query($conn, $idBalanco);
  $idBalanco = mysqli_fetch_array($idBalanco);

  if(!isset($idBalanco['ID_BALANCO'])) {
    $mesAnterior = date('m',strtotime($dataAnterior));
    $anoAnterior = date('Y',strtotime($dataAnterior));
    $receitaAnterior = "SELECT SUM(VALOR) FROM RECEITA WHERE MONTH(DATA) = $mesAnterior AND YEAR(DATA) = $anoAnterior AND ID_AUTOR = $idUsuario;";
    $despesaAnterior = "SELECT SUM(VALOR) FROM DESPESA WHERE MONTH(DATA) = $mesAnterior AND YEAR(DATA) = $anoAnterior AND ID_USUARIO = $idUsuario;";

    $receitaAnterior = mysqli_query($conn, $receitaAnterior);
    $despesaAnterior = mysqli_query($conn, $despesaAnterior);
    $receitaAnterior = mysqli_fetch_array($receitaAnterior);
    $despesaAnterior = mysqli_fetch_array($despesaAnterior);

    $receitaAnterior = $receitaAnterior[0];
    $despesaAnterior = $despesaAnterior[0];
    $receitaAnterior = ($receitaAnterior - $despesaAnterior);

    $inserirBalanco = "INSERT INTO BALANCO VALUES ($codBalanco,$idUsuario,$receitaAnterior,'$dataAnterior');";
    mysqli_query($conn, $inserirBalanco);
  }
  mysqli_close($conn);
?>
