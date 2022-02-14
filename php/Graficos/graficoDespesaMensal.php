<?php
  include "BD/lib/connection.php";

  //Seleção da data atual para seleção dos dados de despesa do mes atual
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $dataAtual = date('Y-m-d');
  $mesAtual = date('m',strtotime($dataAtual));
  $anoAtual = date('Y',strtotime($dataAtual));

  //Alteração das datas caso seja solicitado via filtro
  if(!empty($_POST["filtroMeses"])){
    $data = explode("/",$_POST["filtroMeses"]);
    $anoAtual = $data[0];
    $mesAtual = $data[1];
  }

  $despesa = "SELECT DESCRICAO,VALOR FROM DESPESA WHERE ID_USUARIO = $idUsuario AND MONTH(DATA) = $mesAtual AND YEAR(DATA) = $anoAtual ORDER BY VALOR DESC LIMIT 10;";

  $despesa = mysqli_query($conn, $despesa);

  mysqli_close($conn);

  $printDescricao = NULL;
  $printValor = NULL;

  while ($print2 = mysqli_fetch_assoc($despesa)) {
    if (!isset($printDescricao)) {
      $printDescricao = "'".$print2["DESCRICAO"]."',";
      $printValor = $print2["VALOR"].",";
    }else {
      $printDescricao = $printDescricao."'".$print2["DESCRICAO"]."',";
      $printValor = $printValor.$print2["VALOR"].",";
    }
  }

  $teste5 = 0;
  if (empty($printDescricao)) {
    $teste5 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafDespesaMensal() {
  var teste = <?php echo $teste5; ?>;

  if(teste == 0){
    document.getElementById("avisoDespesaMensal").style.display = "none";

    var ctx = document.getElementById("grafDespesaMensal");
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: [<?php echo $printDescricao; ?>],
          datasets: [{
              label: 'R$',
              data: [<?php echo $printValor; ?>],
              backgroundColor: [
                  '#02394b',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  '#77C9D4',
                  '#57BC90',
                  '#015249',
                  '#3a0152',
                  '#64d500',
                  '#181f3b',
                  '#460c0c'
              ],
              borderColor: [
                  '#02394b',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  '#77C9D4',
                  '#57BC90',
                  '#015249',
                  '#3a0152',
                  '#64d500',
                  '#181f3b',
                  '#460c0c'
              ],
              borderWidth: 1
          }]
      },
    });
  }
}
</script>
