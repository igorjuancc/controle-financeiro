<?php
  include "BD/lib/connection.php";

  //Seleção da data atual para seleção dos dados de despesa do mes atual
  $idUsuario = $_SESSION["idUsuarioSessao"];

  $balanco = "SELECT VALOR_FINAL,DATA FROM BALANCO INNER JOIN USUARIO ON USUARIO.ID_USUARIO = BALANCO.ID_USUARIO WHERE DATA > (NOW() - INTERVAL 365 DAY) AND USUARIO.ID_USUARIO = $idUsuario;";

  $balanco = mysqli_query($conn, $balanco);

  mysqli_close($conn);

  $printDescricao = NULL;
  $printValor = NULL;

  while ($print = mysqli_fetch_assoc($balanco)) {
    if (!isset($printDescricao)) {
      $printData = "'".strftime('%b',strtotime($print["DATA"]))."',";
      $printValor = $print["VALOR_FINAL"].",";
    }else {
      $printData = $printData."'".strftime('%b',strtotime($print["DATA"]))."',";
      $printValor = $printValor.$print["VALOR_FINAL"].",";
    }
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafBalanco() {
  var ctx = document.getElementById("grafBalanco");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $printData; ?>],
        datasets: [{
            label: 'Balanço Mensal',
            data: [<?php echo $printValor; ?>],
            borderWidth:2,
            backgroundColor: 'rgba(2, 57, 75, 0.6)',
            borderColor: 'rgb(2, 57, 75)'
        }]
    },
  });
}
</script>
