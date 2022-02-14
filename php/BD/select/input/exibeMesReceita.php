<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];
  $meses = "SELECT DISTINCT MONTH(DATA) AS MES, YEAR(DATA) AS ANO, ID_AUTOR FROM RECEITA WHERE ID_AUTOR = $idUsuario GROUP BY DATA DESC LIMIT 12;";

  $meses = mysqli_query($conn, $meses);
  mysqli_close($conn);

  $dataAtual = date('Y-m-d');
  $mesAtual = date('m',strtotime($dataAtual));
  $anoAtual = date('Y',strtotime($dataAtual));

  echo "<option>-</option>";

  while ($print = mysqli_fetch_assoc($meses)) {
    $link = $print['ANO']."/".$print['MES'];
    echo "<option onclick='exibeMes()' value='".$link."'>".$link."</option>";
  }
?>
