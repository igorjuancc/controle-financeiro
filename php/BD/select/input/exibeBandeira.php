<?php
  include "BD/lib/connection.php";

  $cartoes = "SELECT * FROM BANDEIRA_CARTAO;";

  $cartoes = mysqli_query($conn, $cartoes);

  mysqli_close($conn);

  while ($print = mysqli_fetch_assoc($cartoes)) {
    echo '<option onclick="exibeBandeira('.$print['ID_BANDEIRA'].')" id="opt'.$print['ID_BANDEIRA'].'" value="'.$print['ID_BANDEIRA'].'">'.$print['NOME_BANDEIRA'].'</option>';
  }

?>
