<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  //Seleção da data atual para seleção dos dados da receita do mes atual
  $dataAtual = date('Y-m-d');
  $mesAtual = date('m',strtotime($dataAtual));
  $anoAtual = date('Y',strtotime($dataAtual));

  //Seleção do mês anterior
  $dataAnterior = date('Y-m-d', strtotime('-1 months', strtotime(date('Y-m-d'))));
  $mesAnterior = date('m',strtotime($dataAnterior));
  $anoAnterior = date('Y',strtotime($dataAnterior));

  //Alteração das datas caso seja solicitado via filtro
  if(!empty($_POST["filtroMeses"])){
    $data = explode("/",$_POST["filtroMeses"]);
    $anoAtual = $data[0];
    $mesAtual = $data[1];

    $dataAnterior = $anoAtual."-".$mesAtual."-"."01";
    $dataAnterior = date('Y-m-d', strtotime('-1 months', strtotime($dataAnterior)));
    $mesAnterior = date('m',strtotime($dataAnterior));
    $anoAnterior = date('Y',strtotime($dataAnterior));
  }

  $receitaAnterior = "SELECT SUM(VALOR) FROM RECEITA WHERE ID_AUTOR = $idUsuario AND MONTH(DATA) <= $mesAnterior AND YEAR(DATA) <= $anoAnterior;";
  $despesaAnterior = "SELECT SUM(VALOR) FROM DESPESA WHERE ID_USUARIO = $idUsuario AND MONTH(DATA) <= $mesAnterior AND YEAR(DATA) <= $anoAnterior;";
  $receitaAnterior = mysqli_query($conn, $receitaAnterior);
  $despesaAnterior = mysqli_query($conn, $despesaAnterior);


  if(empty($receitaAnterior)){
    $receitaAnterior = 0;
  }else {
    $receitaAnterior = mysqli_fetch_array($receitaAnterior);
    $receitaAnterior = $receitaAnterior[0];
  }

  if (empty($despesaAnterior)) {
    $despesaAnterior = 0;
  }else {
    $despesaAnterior = mysqli_fetch_array($despesaAnterior);
    $despesaAnterior = $despesaAnterior[0];
  }
  $saldoAnterior = $receitaAnterior - $despesaAnterior;


  $receitaAtual = "SELECT ID_RECEITA,DESCRICAO,VALOR,DATA FROM RECEITA WHERE ID_AUTOR = $idUsuario AND MONTH(DATA) = $mesAtual AND YEAR(DATA) = $anoAtual;";
  $receitaAtual = mysqli_query($conn, $receitaAtual);

  mysqli_close($conn);

  echo "<tr>";
    echo "<td>SALDO ANTERIOR</td>";
    echo "<td>R$ ".number_format($saldoAnterior,2)."</td>";
    echo "<td id='dataAnterior'>01/".date('m/Y',strtotime($dataAnterior))."</td>";
    echo "<td align='center'> </td>";
    echo "<td align='center'> </td>";
  echo "<tr>";
  while ($print = mysqli_fetch_assoc($receitaAtual)) {
    $saldoAnterior  = $saldoAnterior + $print["VALOR"];
    $print["DATA"] =  date('d/m/Y', strtotime($print["DATA"]));
    echo "<tr>";
      echo "<td><span id='desc".$print["ID_RECEITA"]."'>".$print["DESCRICAO"]."</span></td>";
      echo "<td>R$ ".number_format($print["VALOR"],2)."</td>";
      echo "<td>".$print["DATA"]."</td>";
      $editarReceita = "'".number_format($print["VALOR"],2)."','".$print["ID_RECEITA"]."','".$print["DESCRICAO"]."'";
      echo '<td><a onclick="return editarReceita('.$editarReceita.')"><img class="img-responsive img-table" src="../css/Img/edit.png" alt="editar"></a></td>';
      echo "<td><a href='BD/delete/removeReceita.php?rec=".$print['ID_RECEITA']."' onclick='return removeReceita(".$print["ID_RECEITA"].")'><img class='img-responsive img-table' src='../css/Img/delete.png' alt='editar'></a></td>";
    echo "</tr>";
  }
  echo "<tr>";
    echo "<td>TOTAL</td>";
    echo "<td align='center' colspan='4'>R$ ".number_format($saldoAnterior,2)."</td>";
  echo "<tr>";
?>
