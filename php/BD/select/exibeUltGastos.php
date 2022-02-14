<?php
  include "BD/lib/connection.php";

  $ultDespesa = "SELECT DESCRICAO,NOME_CATEGORIA,VALOR,DATA from DESPESA,CATEGORIA WHERE DATA > (NOW() - INTERVAL 20 DAY) AND ID_USUARIO = ".$_SESSION["idUsuarioSessao"]." AND CATEGORIA.ID_CATEGORIA = DESPESA.ID_CATEGORIA;";

  $ultDespesa = mysqli_query($conn, $ultDespesa);
  $cont = mysqli_num_rows($ultDespesa);

  mysqli_close($conn);

  if ($cont != 0) {
    while ($print = mysqli_fetch_assoc($ultDespesa)) {
      $print["DATA"] =  date('d/m/Y', strtotime($print["DATA"]));
      echo "<tr>";
        echo "<td>".$print["DESCRICAO"]."</td>";
        echo "<td>".$print["NOME_CATEGORIA"]."</td>";
        echo "<td>R$ ".round($print["VALOR"],2)."</td>";
        echo "<td>".$print["DATA"]."</td>";
      echo "</tr>";
    }
  }else {
    echo "<tr style='text-align: center'>";
      echo "<td colspan='4'>".$_SESSION["usuarioSessao"].", Você não realizou compras nos ultimos dias!</td>";
    echo "</tr>";
  }
?>
