<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  //Seleção da data atual para seleção dos dados da receita do mes atual

  $receitaTotal = "SELECT SUM(VALOR) AS VALOR FROM RECEITA WHERE ID_AUTOR = $idUsuario;";
  $despesaTotal = "SELECT SUM(VALOR) AS VALOR FROM DESPESA WHERE ID_USUARIO = $idUsuario;";

  $receitaTotal = mysqli_query($conn, $receitaTotal);
  $despesaTotal = mysqli_query($conn, $despesaTotal);
  $receitaTotal = mysqli_fetch_assoc($receitaTotal);
  $despesaTotal = mysqli_fetch_assoc($despesaTotal);

  mysqli_close($conn);

  $receita = 0;
  $despesa = 0;

  if (isset($receitaTotal["VALOR"])) {
    $receita = round($receitaTotal["VALOR"],2);
  }
  if (isset($despesaTotal["VALOR"])) {
    $despesa = round($despesaTotal["VALOR"],2);
  }

  $balanco = round(($receita - $despesa),2);

  $teste7 = 0;
  if (empty($receitaTotal) && empty($despesaTotal)) {
    $teste7 = 1;
  }
?>

<script type="text/javascript" src="../js/Chart.js"></script>
<script type="text/javascript">
function grafTotal() {
  var teste = <?php echo $teste7; ?>;

  if (teste == 0) {
    document.getElementById("avisoBalancoTotal").style.display = "none";

    var ctx = document.getElementById("total");
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ["Receita","Despesa","Balanço"],
          datasets: [
            {
              label: ["R$"],
              data: [<?php echo $receita.",".$despesa.",".$balanco; ?>],
              borderWidth:2,
              borderColor: ['rgb(5, 77, 16)','rgb(75, 2, 2)','rgb(5, 38, 77)'],
              backgroundColor: ['rgba(0, 210, 32, 0.42)','rgba(255, 0, 0, 0.42)','rgba(0, 126, 196, 0.42)']
            },

          ]
      },
    });
  }
}
</script>
