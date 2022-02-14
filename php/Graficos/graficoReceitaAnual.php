<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  //Seleção da data atual para seleção dos dados da receita do mes atual
  $data = '"'.date('Y-m-d').'"';

  if(!empty($_POST["filtroMeses"])){
    $data = explode("/",$_POST["filtroMeses"]);
    $anoAtual = $data[0];
    $mesAtual = $data[1];
    $data = '"'.$anoAtual.'-'.$mesAtual.'-'.'31"';
  }

  $receitaAnual = "SELECT SUM(VALOR) AS VALOR, DATA FROM RECEITA WHERE ID_AUTOR = $idUsuario AND DATA <= $data GROUP BY MONTH(DATA) ORDER BY DATA DESC LIMIT 12;";

  $receitaAnual = mysqli_query($conn, $receitaAnual);
  mysqli_close($conn);

  $printData = NULL;
  $printValor = NULL;

  while ($print = mysqli_fetch_assoc($receitaAnual)) {
    if (empty($printData)) {
      $printData = "'".strftime('%b',strtotime($print["DATA"]))."/".strftime('%Y',strtotime($print["DATA"]))."',";
      $printValor = round($print["VALOR"],2).",";
    } else{
      $printData = "'".strftime('%b',strtotime($print["DATA"]))."/".strftime('%Y',strtotime($print["DATA"]))."',".$printData;
      $printValor = round($print["VALOR"],2).",".$printValor;
    }
  }

  $teste3 = 0;
  if (empty($printData)) {
    $teste3 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafReceitaAnual() {
  var teste = <?php echo $teste3; ?>;

  if (teste == 0) {
    document.getElementById("avisoReceitaAnual").style.display = "none";

    var ctx = document.getElementById("grafReceitaAnual");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [<?php echo $printData; ?>],
          datasets: [{
              label: 'Receita Mes',
              data: [<?php echo $printValor; ?>],
              borderWidth:2,
              backgroundColor: 'rgba(2, 57, 75, 0.53)',
              borderColor: 'rgb(2, 57, 75)'
          }]
      },
    });
  }
}
</script>
