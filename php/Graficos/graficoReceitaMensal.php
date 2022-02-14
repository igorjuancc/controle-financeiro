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
    $receitaAnterior = round($receitaAnterior[0],2);
  }

  if (empty($despesaAnterior)) {
    $despesaAnterior = 0;
  }else {
    $despesaAnterior = mysqli_fetch_array($despesaAnterior);
    $despesaAnterior = round($despesaAnterior[0],2);
  }
  $saldoAnterior = $receitaAnterior - $despesaAnterior;
  $teste = $saldoAnterior;

  $receitaAtual = "SELECT ID_RECEITA,DESCRICAO,VALOR,DATA FROM RECEITA WHERE ID_AUTOR = $idUsuario AND MONTH(DATA) = $mesAtual AND YEAR(DATA) = $anoAtual;";
  $receitaAtual = mysqli_query($conn, $receitaAtual);

  mysqli_close($conn);

  $printValor = NULL;
  $printDescricao = NULL;

  while ($print = mysqli_fetch_assoc($receitaAtual)) {
    $teste = 1;
    if (!isset($printDescricao)) {
      $printDescricao = "'".$print["DESCRICAO"]."',";
      $printValor = round($print["VALOR"],2).",";
    }else {
      $printDescricao = $printDescricao."'".$print["DESCRICAO"]."',";
      $printValor = $printValor.round($print["VALOR"],2).",";
    }
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafReceitaMensal() {
  var teste = <?php echo $teste; ?>;

  if (teste != 0) {
    document.getElementById("avisoReceitaMensal").style.display = "none";

    var ctx = document.getElementById("grafReceita");
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['MÊS ANT',<?php echo $printDescricao; ?>],
            datasets: [{
                label:'R$',
                data: [<?php echo $saldoAnterior.","?><?php echo $printValor; ?>],
                backgroundColor: [
                    '#02394b',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    '#77C9D4',
                    '#57BC90',
                    '#015249'
                ],
                borderColor: [
                    '#02394b',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    '#77C9D4',
                    '#57BC90',
                    '#015249'
                ],
                borderWidth: 1
            }]
        },
      });
    }
  }
</script>
