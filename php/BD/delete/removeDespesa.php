<?php
  include "../lib/connection.php";

  session_start();

  $despesaRemover = $_GET['des'];
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $buscaDespesa = "SELECT ID_DESPESA,ID_USUARIO FROM DESPESA WHERE ID_USUARIO = $idUsuario AND ID_DESPESA = $despesaRemover;";

  $buscaDespesa = mysqli_query($conn, $buscaDespesa);
  $buscaDespesa = mysqli_fetch_array($buscaDespesa);

  if($buscaDespesa["ID_DESPESA"]){
      $despesaRemover = "DELETE FROM DESPESA WHERE ID_DESPESA = $despesaRemover;";
      $despesaRemover = mysqli_query($conn, $despesaRemover);
      if ($despesaRemover) {
        header("Location:/php/despesa.php?des=r");
      }
    }else{
    header("Location:/php/despesa.php?des=pr");
  }
  mysqli_close($conn);

  /*
    des = r ---> removida ok
    des = s ---> inserida ok
    des = e ---> editada
    des = pr ---> problema ao remover ok
    des = ps ---> problema ao inserir
    des = pe ---> problema ao editar
  */
?>
