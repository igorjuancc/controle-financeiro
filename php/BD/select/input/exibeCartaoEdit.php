<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  $cartoes = "SELECT * FROM CARTAO WHERE ID_USUARIO = $idUsuario;";

  $cartoes = mysqli_query($conn, $cartoes);

  mysqli_close($conn);

  while ($print = mysqli_fetch_assoc($cartoes)) {
    echo '<option id="opt'.$print['ID_CARTAO'].'" value="'.$print['ID_CARTAO'].'">'.$print['DESCRICAO'].'</option>';
  }

?>
