<?php
  function buscarCategoria($categoria, $conn){
    include "../lib/sanitize.php";
    $categoria = sanitize($categoria);
    $buscarCategoria = "SELECT * FROM CATEGORIA WHERE ID_CATEGORIA = $categoria;";

    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }else {
      $retornoCategoria = mysqli_query($conn, $buscarCategoria);
      $retornoCategoria = mysqli_fetch_array($retornoCategoria);
      return $retornoCategoria;
    }
    mysqli_close($conn);
  }
?>
