<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  $categorias = "SELECT * FROM CATEGORIA WHERE ID_AUTOR = 1 OR ID_AUTOR = $idUsuario;";

  $categorias = mysqli_query($conn, $categorias);

  mysqli_close($conn);

  while ($print = mysqli_fetch_assoc($categorias)) {
    echo '<option id="cat'.$print['ID_CATEGORIA'].'" value="'.$print["ID_CATEGORIA"].'">'.$print["NOME_CATEGORIA"].'</option>';
  }

?>
