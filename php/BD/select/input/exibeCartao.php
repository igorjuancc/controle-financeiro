<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  $cartoes = "SELECT * FROM CARTAO WHERE ID_USUARIO = $idUsuario;";

  $cartoes = mysqli_query($conn, $cartoes);

  mysqli_close($conn);

  echo "<option id='opc1' value='0'>-</option>";
  while ($print = mysqli_fetch_assoc($cartoes)) {
    $var = "'".$print['TIPO']."','".$print['DIGITO_FINAL']."',".$print['ID_BANDEIRA'];
    echo '<option onclick="insereDadosCard('.$var.')" value="'.$print['ID_CARTAO'].'">'.$print['DESCRICAO'].'</option>';
  }

?>
