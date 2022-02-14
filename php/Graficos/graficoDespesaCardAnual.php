<?php
  include "BD/lib/connection.php";

  //Seleção da data atual para seleção dos dados de despesa do mes atual
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $dataAtual = '"'.date('Y-m-d').'"';

  $despesaCard = "SELECT SUM(VALOR) AS VALOR, CARTAO.DESCRICAO AS CARTAO, TIPO FROM DESPESA INNER JOIN CARTAO ON DESPESA.ID_CARTAO = CARTAO.ID_CARTAO WHERE DESPESA.ID_USUARIO = $idUsuario AND DATA <= $dataAtual GROUP BY DESPESA.ID_CARTAO ORDER BY VALOR DESC LIMIT 12;";

  $despesaCard = mysqli_query($conn, $despesaCard);
  mysqli_close($conn);

  $printCard = NULL;
  $printValor = NULL;

  while ($print1 = mysqli_fetch_assoc($despesaCard)) {
    if (empty($printCard)) {
      $printCard = "'".$print1["CARTAO"]."',";
      $printValor = $print1["VALOR"].",";
    }else {
      $printCard = $printCard."'".$print1["CARTAO"]."',";
      $printValor = $printValor.$print1["VALOR"].",";
    }
  }

  $teste10 = 0;
  if (empty($printCard)) {
    $teste10 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafDespCard() {
  var teste = <?php echo $teste10; ?>;

  if (teste == 0) {
    document.getElementById("avisoDespCardAno").style.display = "none";

    var ctx = document.getElementById("grafDespCard");
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [<?php echo $printCard; ?>],
          datasets: [{
              label: ["R$"],
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
          },
        ]
      },
    });
  }
}
</script>
