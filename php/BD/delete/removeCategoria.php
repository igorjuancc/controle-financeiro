<?php
  include "../lib/connection.php";
  include "../select/buscarCategoria.php";

  session_start();

  $categoriaRemover = $_GET['cat'];
  $categoriaRemover = buscarCategoria($categoriaRemover, $conn);

  if(isset($categoriaRemover['ID_CATEGORIA'])){
    if ($categoriaRemover['ID_AUTOR'] == $_SESSION["idUsuarioSessao"]) {
      $categoriaRemover = "DELETE FROM CATEGORIA WHERE ID_CATEGORIA = ".$categoriaRemover['ID_CATEGORIA'].";";
      $categoriaRemover = mysqli_query($conn, $categoriaRemover);
      if ($categoriaRemover) {
        header("Location:/php/categoria.php?cat=r");
      }
    }else {
      header("Location:/php/categoria.php?cat=pr");
    }
  }else {
    header("Location:/php/categoria.php?cat=pr");
  }
  mysqli_close($conn);

  /*
    cat = s ---> inserida
    cat = r ---> removida
    cat = pr ---> problema ao remover
    cat = ps ---> problema ao inserir
  */
?>
