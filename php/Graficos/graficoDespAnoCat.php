<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  $data = '"'.date('Y-m-d').'"';

  $despesaAnual = "SELECT SUM(VALOR) AS VALOR,NOME_CATEGORIA AS CATEGORIA FROM DESPESA INNER JOIN CATEGORIA ON DESPESA.ID_CATEGORIA = CATEGORIA.ID_CATEGORIA WHERE ID_USUARIO = $idUsuario AND DATA <= $data GROUP BY DESPESA.ID_CATEGORIA ORDER BY VALOR LIMIT 12;";

  $despesaAnual = mysqli_query($conn, $despesaAnual);

  mysqli_close($conn);

  $printCategoria = NULL;
  $printValor = NULL;
  $teste = 1;

  while ($print = mysqli_fetch_assoc($despesaAnual)) {
    if (empty($printCategoria)) {
      $printCategoria = "'".$print['CATEGORIA']."',";
      $printValor = round($print['VALOR']).",";
    } else {
      $printCategoria = "'".$print['CATEGORIA']."',".$printCategoria;
      $printValor = round($print['VALOR']).",".$printValor;
    }
  }

  $teste8 = 0;
  if (empty($printCategoria)) {
    $teste8 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafDespCat() {
  var teste = <?php echo $teste8; ?>;

  if (teste == 0) {
    document.getElementById("avisoDespCat").style.display = "none";

    var ctx = document.getElementById("grafDespCat");
    var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: [<?php echo $printCategoria; ?>],
          datasets: [
            {
              label: ["R$"],
              data: [<?php echo $printValor; ?>],
              borderWidth:2,
              borderColor: 'rgb(2, 75, 42)',
              backgroundColor: 'rgba(2, 75, 42, 1)',
            },
          ]
      },
    });
  }
}
</script>
