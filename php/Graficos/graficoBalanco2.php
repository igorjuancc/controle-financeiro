<?php
  include "BD/lib/connection.php";

  function nomeMes($numMes){
    $mes = array("-","Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez");
    return $mes[$numMes];
  }

  $idUsuario = $_SESSION["idUsuarioSessao"];

  //Seleção da data atual para seleção dos dados da receita do mes atual
  $data = '"'.date('Y-m-d').'"';

  $mesesUtilizado = "(SELECT MONTH(DATA) AS MES, YEAR(DATA) AS ANO FROM RECEITA WHERE ID_AUTOR = $idUsuario AND DATA <= $data) UNION (SELECT MONTH(DATA) AS MES,YEAR(DATA) AS ANO FROM DESPESA WHERE ID_USUARIO = $idUsuario AND DATA <= $data) ORDER BY ANO, MES LIMIT 12;";
  $receitaAnual = "SELECT SUM(VALOR) AS VALOR, DATA FROM RECEITA WHERE ID_AUTOR = $idUsuario AND DATA <= $data GROUP BY MONTH(DATA) ORDER BY DATA DESC LIMIT 12;";
  $despesaAnual = "SELECT SUM(VALOR) AS VALOR, DATA FROM DESPESA WHERE ID_USUARIO = $idUsuario AND DATA <= $data GROUP BY MONTH(DATA) ORDER BY DATA DESC LIMIT 12;";

  $mesesUtilizado = mysqli_query($conn, $mesesUtilizado);
  $receitaAnual = mysqli_query($conn, $receitaAnual);
  $despesaAnual = mysqli_query($conn, $despesaAnual);
  mysqli_close($conn);

  $printData = NULL;

  while ($print = mysqli_fetch_assoc($mesesUtilizado)) {
    $receita = 0;
    $despesa = 0;
    $balanco = 0;

    while ($print2 = mysqli_fetch_assoc($receitaAnual)) {
      if ( (strftime('%m',strtotime($print2["DATA"])) == $print['MES']) and (strftime('%Y',strtotime($print2["DATA"])) == $print['ANO']) )  {
        $receita = $print2['VALOR'];
      }
    }

    while ($print3 = mysqli_fetch_assoc($despesaAnual)) {
      if ( (strftime('%m',strtotime($print3["DATA"])) == $print['MES']) and (strftime('%Y',strtotime($print3["DATA"])) == $print['ANO']) )  {
        $despesa = $print3['VALOR'];
      }
    }

    $balanco = $receita - $despesa;

    if (empty($printData)) {
      $printData = "'".nomeMes($print['MES'])."/".$print['ANO']."',";
      $printReceita = "'".round($receita,2)."',";
      $printDespesa = "'".round($despesa,2)."',";
      $printBalanco = "'".round($balanco,2)."',";
    } else{
      $printData = $printData."'".nomeMes($print['MES'])."/".$print['ANO']."',";
      $printReceita = $printReceita."'".round($receita,2)."',";
      $printDespesa = $printDespesa."'".round($despesa,2)."',";
      $printBalanco = $printBalanco."'".round($balanco,2)."',";
    }

    mysqli_data_seek($receitaAnual, 0);
    mysqli_data_seek($despesaAnual, 0);
  }

  $teste2 = 0;
  if (empty($mesesUtilizado)) {
    $teste2 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafBalanco() {
  var teste = <?php echo $teste2; ?>;

  if (teste == 0) {
    document.getElementById("avisoBalancoAnual").style.display = "none";

    var ctx = document.getElementById("balanco");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [<?php echo $printData; ?>],
          datasets: [
            {
              label: 'Receita Mes',
              data: [<?php echo $printReceita; ?>],
              borderWidth:2,
              borderColor: 'rgb(2, 57, 75)',
              backgroundColor: 'rgba(2, 57, 75, 0.18)'
            },
            {
              label: 'Despesa Mes',
              data: [<?php echo $printDespesa; ?>],
              borderWidth:2,
              borderColor: 'rgb(75, 2, 63)',
              backgroundColor: 'rgba(75, 2, 63, 0.18)'
            },
            {
              label: 'Balanço Mes',
              data: [<?php echo $printBalanco; ?>],
              borderWidth:2,
              borderColor: 'rgb(54, 187, 159)',
              backgroundColor: 'rgba(54, 187, 159, 0.18)'
            },
          ]
      },
    });
  }
}
</script>
