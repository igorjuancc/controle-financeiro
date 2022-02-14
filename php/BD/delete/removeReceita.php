<?php
  include "../lib/connection.php";

  session_start();

  $receitaRemover = $_GET['rec'];
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $buscaReceita = "SELECT ID_RECEITA,ID_AUTOR FROM RECEITA WHERE ID_AUTOR = $idUsuario AND ID_RECEITA = $receitaRemover;";

  $buscaReceita = mysqli_query($conn, $buscaReceita);
  $buscaReceita = mysqli_fetch_array($buscaReceita);

  if($buscaReceita["ID_RECEITA"]){
      $receitaRemover = "DELETE FROM RECEITA WHERE ID_RECEITA = $receitaRemover;";
      $receitaRemover = mysqli_query($conn, $receitaRemover);
      if ($receitaRemover) {
        header("Location:/php/receita.php?rec=r");
      }
    }else{
    header("Location:/php/receita.php?rec=pr");
  }
  mysqli_close($conn);

  /*
    rec = r ---> removida ok
    rec = s ---> inserida ok
    rec = e ---> editada
    rec = pr ---> problema ao remover ok
    rec = ps ---> problema ao inserir
    rec = pe ---> problema ao editar
  */
?>
