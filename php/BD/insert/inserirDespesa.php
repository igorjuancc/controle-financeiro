<?php
  include "../lib/connection.php";
  include "../lib/sanitize.php";
  session_start();

  $idAutor = $_SESSION["idUsuarioSessao"];
  $novaDespesa = strtoupper($_POST["despesa"]);
  $novaDespesa = sanitize($novaDespesa);
  $data = $_POST["data"];
  $data = sanitize($data);
  $formaPgto = $_POST["formaPgto"];
  $cartao = "NULL";
  $categoria = $_POST["categoria"];
  $valor = $_POST["valor"];
  $valor = sanitize($valor);

  if (isset($_POST["cartao"])){
    $cartao = $_POST["cartao"];
  }

  $inserirDespesa = "INSERT INTO DESPESA (ID_USUARIO,DATA,DESCRICAO,ID_CATEGORIA,VALOR,FORMA_PAGAMENTO,ID_CARTAO) VALUES ($idAutor,'$data','$novaDespesa',$categoria,$valor,$formaPgto,$cartao)";
  mysqli_query($conn, $inserirDespesa);
  mysqli_close($conn);
  header("Location:/php/despesa.php?des=s");

  /*
    des = r ---> removida ok
    des = s ---> inserida ok
    des = e ---> editada
    des = pr ---> problema ao remover ok
    des = ps ---> problema ao inserir
    des = pe ---> problema ao editar
  */
?>
