<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  //Seleção da data atual para os dados da receita do mes atual
  $data = '"'.date('Y-m-t').'"';
  $dataAnterior = '"'.date('Y-m-t', strtotime('-1 months', strtotime(date('Y-m-t')))).'"';
  $anoAtual = date('Y');
  $mesAtual = date('m');

  if(!empty($_POST["filtroMeses"])){
    $data = explode("/",$_POST["filtroMeses"]);
    $anoAtual = $data[0];
    $mesAtual = $data[1];
    $data = "'".date($anoAtual."-".$mesAtual."-t")."'";
    $dataAnterior = $anoAtual."-".$mesAtual."-"."01";
    $dataAnterior = '"'.date('Y-m-t', strtotime('-1 months', strtotime($dataAnterior))).'"';
  }

  $mesesUtilizado = "(SELECT MONTH(DATA) AS MES, YEAR(DATA) AS ANO FROM RECEITA WHERE ID_AUTOR = $idUsuario AND DATA <= $dataAnterior) UNION (SELECT MONTH(DATA) AS MES,YEAR(DATA) AS ANO FROM DESPESA WHERE ID_USUARIO = $idUsuario AND DATA <= $dataAnterior) ORDER BY ANO, MES LIMIT 12;";
  $receitaAnterior = "SELECT SUM(VALOR) AS VALOR, DATA FROM RECEITA WHERE ID_AUTOR = $idUsuario AND DATA <= $dataAnterior GROUP BY MONTH(DATA) ORDER BY DATA DESC LIMIT 12;";
  $despesaAnterior = "SELECT SUM(VALOR) AS VALOR, DATA FROM DESPESA WHERE ID_USUARIO = $idUsuario AND DATA <= $dataAnterior GROUP BY MONTH(DATA) ORDER BY DATA DESC LIMIT 12;";

  $mesesUtilizado = mysqli_query($conn, $mesesUtilizado);
  $receitaAnterior = mysqli_query($conn, $receitaAnterior);
  $despesaAnterior = mysqli_query($conn, $despesaAnterior);

  $printMes = NULL;
  $printValor = NULL;

  //Informações dos meses anteriores para o grafico
  while ($meses = mysqli_fetch_assoc($mesesUtilizado)) {
    $receita = 0;
    $despesa = 0;

    while ($print = mysqli_fetch_assoc($receitaAnterior)) {
      if ( (strftime('%m',strtotime($print["DATA"])) == $meses['MES']) and (strftime('%Y',strtotime($print["DATA"])) == $meses['ANO']) ) {
        $receita = $print['VALOR'];
      }
    }

    while ($print = mysqli_fetch_assoc($despesaAnterior)) {
      if ( (strftime('%m',strtotime($print["DATA"])) == $meses['MES']) and (strftime('%Y',strtotime($print["DATA"])) == $meses['ANO']) ) {
        $despesa = $print['VALOR'];
      }
    }

    $balanco = $receita - $despesa;
    $dataPrint = $meses['ANO']."-".$meses['MES']."-01";

    if (empty($printMes)) {
      $printMes = "'".strftime('%b',strtotime($dataPrint))."/".strftime('%Y',strtotime($dataPrint))."'";
      $printValor = round($balanco,2);
    }else {
      $printMes = $printMes.",'".strftime('%b',strtotime($dataPrint))."/".strftime('%Y',strtotime($dataPrint))."'";
      $printValor = $printValor.",".round($balanco,2);
    }

    mysqli_data_seek($receitaAnterior, 0);
    mysqli_data_seek($despesaAnterior, 0);
  }

  //Informações Atuais para o grafico
  $receitaAtual = "SELECT SUM(VALOR) AS VALOR FROM RECEITA WHERE ID_AUTOR = $idUsuario AND MONTH(DATA) = $mesAtual AND YEAR(DATA) = $anoAtual;";
  $despesaAtual = "SELECT SUM(VALOR) AS VALOR FROM DESPESA WHERE ID_USUARIO = $idUsuario AND MONTH(DATA) = $mesAtual AND YEAR(DATA) = $anoAtual;";
  $receitaAtual = mysqli_query($conn, $receitaAtual);
  $despesaAtual = mysqli_query($conn, $despesaAtual);
  $receitaAtual = mysqli_fetch_assoc($receitaAtual);
  $despesaAtual = mysqli_fetch_assoc($despesaAtual);

  $receitaMes = 0;
  $despesaMes = 0;

  if(isset($receitaAtual['VALOR'])){
    $receitaMes = $receitaAtual['VALOR'];
  }
  if(isset($despesaAtual['VALOR'])){
    $despesaMes = $despesaAtual['VALOR'];
  }

  $balancoMes = $receitaMes - $despesaMes;
  $data = $anoAtual."-".$mesAtual."-01";

  if (empty($printMes)){
    $printMes = "'".strftime('%b',strtotime($data))."/".strftime('%Y',strtotime($data))."'";
    $printValor = round($balancoMes,2);
  }else {
    $printMes = $printMes.",'".strftime('%b',strtotime($data))."/".strftime('%Y',strtotime($data))."'";
    $printValor = $printValor.",".round($balancoMes,2);
  }
  mysqli_close($conn);

  $teste4 = 0;
  if(empty($printValor)){
    $teste4 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function graficoBalancoAnual() {
  var teste = <?php echo $teste4; ?>;

  if (teste == 0) {
    document.getElementById("avisoBalancoAnual").style.display = "none";

    var ctx = document.getElementById("graficoBalancoAnual");
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [<?php echo $printMes; ?>],
          datasets: [{
              label: 'Balanço Mes',
              data: [<?php echo $printValor; ?>],
              borderWidth:2,
              backgroundColor: ['rgba(238, 201, 0, 0.53)','rgba(255, 193, 37, 0.53)','rgba(238, 180, 34, 0.53)','rgba(205, 155, 29, 0.53)','rgba(139, 105, 20, 0.53)','rgba(255, 185, 15, 0.53)','rgba(238, 173, 14, 0.53)','rgba(205, 149, 12, 0.53)','rgba(205, 190, 112, 0.53)','rgba(139, 139, 0, 0.53)','rgba(255, 215, 0, 0.53)','rgba(205, 173, 0, 0.53)'],
              borderColor: ['rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)','rgb(139, 117, 0)']
          }]
      },
    });
  }
}
</script>
