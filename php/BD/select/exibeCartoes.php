<?php
  include "BD/lib/connection.php";

  $idUsuario = $_SESSION["idUsuarioSessao"];

  $cartoes = "SELECT * FROM CARTAO, BANDEIRA_CARTAO WHERE CARTAO.ID_BANDEIRA = BANDEIRA_CARTAO.ID_BANDEIRA AND CARTAO.ID_USUARIO = $idUsuario;";

  $cartoes = mysqli_query($conn, $cartoes);

  mysqli_close($conn);

  while ($print = mysqli_fetch_assoc($cartoes)) {
    echo "<tr>";
      echo "<td><span id='desc".$print["ID_CARTAO"]."'>".$print["DESCRICAO"]."</span></td>";
      echo "<td>".$print["TIPO"]."</td>";
      echo "<td>".$print["DIGITO_FINAL"]."</td>";
      echo "<td>".$print["NOME_BANDEIRA"]."</td>";
      $editarCartao = "'".$print["DESCRICAO"]."','".$print["DIGITO_FINAL"]."','".$print["TIPO"]."','".$print["ID_CARTAO"]."','".$print["ID_BANDEIRA"]."'";
      echo '<td><a onclick="return editarCartao('.$editarCartao.')"><img class="img-responsive img-table" src="../css/Img/edit.png" alt="editar"></a></td>';
      echo "<td><a href='BD/delete/removeCartao.php?card=".$print['ID_CARTAO']."' onclick='return removeCartao(".$print["ID_CARTAO"].")'><img class='img-responsive img-table' src='../css/Img/delete.png' alt='editar'></a></td>";
    echo "</tr>";
  }
?>
