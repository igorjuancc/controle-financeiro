<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  //Seleção da data atual para seleção dos dados da despesa do mes atual
  $dataAtual = date('Y-m-d');
  $mesAtual = date('m',strtotime($dataAtual));
  $anoAtual = date('Y',strtotime($dataAtual));

  //Alteração das datas caso seja solicitado via filtro
  if(!empty($_POST["filtroMeses"])){
    $data = explode("/",$_POST["filtroMeses"]);
    $anoAtual = $data[0];
    $mesAtual = $data[1];
  }

  $despesa = "SELECT ID_DESPESA,DESCRICAO,VALOR,DATA,FORMA_PAGAMENTO,ID_CATEGORIA,ID_CARTAO FROM DESPESA INNER JOIN USUARIO ON DESPESA.ID_USUARIO = USUARIO.ID_USUARIO WHERE USUARIO.ID_USUARIO = $idUsuario AND MONTH(DATA) = $mesAtual AND YEAR(DATA) = $anoAtual;";

  $despesa = mysqli_query($conn, $despesa);

  mysqli_close($conn);

  $total = 0;

  while ($print = mysqli_fetch_assoc($despesa)) {
    $print["DATA"] =  date('d/m/Y', strtotime($print["DATA"]));
    $total = $total+$print["VALOR"];
    echo "<tr>";
      echo "<td><span id='desc".$print["ID_DESPESA"]."'>".$print["DESCRICAO"]."</span></td>";
      echo "<td>R$ ".number_format($print["VALOR"],2)."</td>";
      echo "<td>".$print["DATA"]."</td>";
      $editarDespesa = "'".number_format($print["VALOR"],2)."','".$print["ID_DESPESA"]."','".$print["DESCRICAO"]."','".$print["FORMA_PAGAMENTO"]."','".$print["ID_CATEGORIA"]."','".$print["ID_CARTAO"]."'";
      echo '<td><a onclick="return editarDespesa('.$editarDespesa.')"><img class="img-responsive img-table" src="../css/Img/edit.png" alt="editar"></a></td>';
      echo "<td><a href='BD/delete/removeDespesa.php?des=".$print['ID_DESPESA']."' onclick='return removeDespesa(".$print["ID_DESPESA"].")'><img class='img-responsive img-table' src='../css/Img/delete.png' alt='editar'></a></td>";
    echo "</tr>";
  }
  echo "<tr>";
    echo "<td>TOTAL</td>";
    echo "<td align='center' colspan='4'>R$ ".number_format($total,2)."</td>";
  echo "</tr>";
  echo "<p class='divAviso' id='dataAtual'>".$mesAtual."/".$anoAtual."</p>";
?>
