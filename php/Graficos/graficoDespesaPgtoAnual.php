<?php
  include "BD/lib/connection.php";

  //Seleção da data atual para seleção dos dados de despesa do mes atual
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $dataAtual = '"'.date('Y-m-d').'"';

  $despesa = "SELECT SUM(VALOR) AS VALOR, FORMA_PAGAMENTO AS PAGAMENTO FROM DESPESA WHERE ID_USUARIO = $idUsuario AND DATA <= $dataAtual AND FORMA_PAGAMENTO <> 2 GROUP BY FORMA_PAGAMENTO;";
  $despesaCard = "SELECT SUM(VALOR) AS VALOR, FORMA_PAGAMENTO AS PAGAMENTO, TIPO FROM DESPESA INNER JOIN CARTAO ON DESPESA.ID_CARTAO = CARTAO.ID_CARTAO WHERE DESPESA.ID_USUARIO = $idUsuario AND DATA <= $dataAtual AND FORMA_PAGAMENTO = 2 GROUP BY TIPO LIMIT 12;";

  $despesa = mysqli_query($conn, $despesa);
  $despesaCard = mysqli_query($conn, $despesaCard);
  mysqli_close($conn);

  $printDescricao = NULL;
  $printValor = NULL;

  while ($print2 = mysqli_fetch_assoc($despesa)) {
    if(isset($print2["PAGAMENTO"])){
      if (empty($printDescricao)) {
        if($print2["PAGAMENTO"] == 1){
          $printDescricao = "'DINHEIRO',";
        }else {
          $printDescricao = "'CHEQUE',";
        }
        $printValor = $print2["VALOR"].",";
      }else {
        if($print2["PAGAMENTO"] == 1){
          $printDescricao = $printDescricao."'DINHEIRO',";
        }else {
          $printDescricao = $printDescricao."'CHEQUE',";
        }
        $printValor = $printValor.$print2["VALOR"].",";
      }
    }
  }

  while ($print1 = mysqli_fetch_assoc($despesaCard)) {
    if (empty($printDescricao)) {
      $printDescricao = "'".$print1["TIPO"]."',";
      $printValor = $print1["VALOR"].",";
    }else {
      $printDescricao = $printDescricao."'".$print1["TIPO"]."',";
      $printValor = $printValor.$print1["VALOR"].",";
    }
  }

  $teste9 = 0;
  if(empty($printDescricao)){
    $teste9 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafFormaPagamento() {
  var teste = <?php echo $teste9; ?>;

  if (teste == 0) {
    document.getElementById("avisoDespPgtoAno").style.display = "none";

    var ctx = document.getElementById("grafFormaPagamento");
    var myChart = new Chart(ctx, {
      type: 'doughnut',
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
