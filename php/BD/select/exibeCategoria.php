<?php
  include "BD/lib/connection.php";

  $categorias =       "SELECT ID_CATEGORIA, NOME_CATEGORIA, NOME_USUARIO FROM CATEGORIA, USUARIO WHERE ID_AUTOR = ID_USUARIO AND ID_AUTOR = 1;";
  $minhasCategorias = "SELECT ID_CATEGORIA, NOME_CATEGORIA, NOME_USUARIO FROM CATEGORIA, USUARIO WHERE ID_AUTOR = ID_USUARIO AND ID_AUTOR = ".$_SESSION["idUsuarioSessao"].";";

  $categorias = mysqli_query($conn, $categorias);
  $minhasCategorias = mysqli_query($conn, $minhasCategorias);

  mysqli_close($conn);

  while ($print2 = mysqli_fetch_assoc($minhasCategorias)) {
    echo "<tr>";
      echo "<td><span id='desc".$print2["ID_CATEGORIA"]."'>".$print2["NOME_CATEGORIA"]."</span></td>";
      echo "<td>".$print2["NOME_USUARIO"]."</td>";
      echo "<td><a href='BD/delete/removeCategoria.php?cat=".$print2["ID_CATEGORIA"]."' onclick='return removeCategoria(".$print2["ID_CATEGORIA"].")'><img class='img-responsive img-table' src='../css/Img/delete.png' alt='editar'></a></td>";
    echo "</tr>";
  }
  while ($print1 = mysqli_fetch_assoc($categorias)) {
    echo "<tr>";
      echo "<td>".$print1["NOME_CATEGORIA"]."</td>";
      echo "<td>".$print1["NOME_USUARIO"]."</td>";
      echo "<td></td>";
      echo "<td></td>";
    echo "</tr>";
  }
?>
