<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";

  session_start();

  $despesaEditar = $_GET['des'];
  $idUsuario = $_SESSION["idUsuarioSessao"];
  $buscaDespesa = "SELECT * FROM DESPESA WHERE ID_USUARIO = $idUsuario AND ID_DESPESA = $despesaEditar;";

  $buscaDespesa = mysqli_query($conn, $buscaDespesa);
  $buscaDespesa = mysqli_fetch_array($buscaDespesa);

  if($buscaDespesa["ID_DESPESA"]){
    $descricao = $buscaDespesa["DESCRICAO"];
    $data = $buscaDespesa["DATA"];
    $card = $buscaDespesa["ID_CARTAO"];
    $categoria = $buscaDespesa["ID_CATEGORIA"];
    $formaPgto = $buscaDespesa["FORMA_PAGAMENTO"];
    $valor = $buscaDespesa["VALOR"];

    if (!empty($_POST["despesa"])) {
      $descricao = strtoupper($_POST["despesa"]);
      $descricao = sanitize($descricao);
    }
    if (!empty($_POST["data"])) {
      $data = sanitize($_POST["data"]);
    }
    if (!empty($_POST["categoria"])) {
      $categoria = $_POST["categoria"];
    }
    if (!empty($_POST["formaPgtoE"])) {
      $formaPgto = $_POST["formaPgtoE"];
      if ($formaPgto == 2) {
        if (!empty($_POST["cartaoEdit"])) {
          $card = $_POST["cartaoEdit"];
        }
      }else {
        $card = "NULL";
      }
    }
    if (!empty($_POST["valor"])) {
      $valor = $_POST["valor"];
    }

    $despesaEdit = "UPDATE DESPESA SET DESCRICAO = '$descricao', DATA = '$data', ID_CARTAO = $card, ID_CATEGORIA = '$categoria', FORMA_PAGAMENTO = '$formaPgto', VALOR = '$valor' WHERE ID_USUARIO = $idUsuario AND ID_DESPESA = $despesaEditar;";

    $result = mysqli_query($conn, $despesaEdit);

    if($result > 0){
      header("Location:/php/despesa.php?des=e");
    }else {
      header("Location:/php/despesa.php?des=pe");
    }
  }else {
    header("Location:/php/despesa.php?des=pe");
  }
mysqli_close($conn);
?>
