<?php
  session_start();
  if(!isset($_SESSION["idUsuarioSessao"])) {
    header("Location:../index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <script type="text/javascript" src="../js/validaCategoria.js"></script>
    <title>Categorias</title>
  </head>
  <body onload="testeCategoria()">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand img-responsive" href="home.php"><img src="../css/Img/logoT.png" alt="inicio" id="logoMenu"></a>
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="home.php">Home</a>
          <a class="nav-item nav-link" href="receita.php">Receita</a>
          <a class="nav-item nav-link" href="despesa.php">Despesas</a>
          <a class="nav-item nav-link" href="balanco.php">Balanço</a>
          <a class="nav-item nav-link active" href="categoria.php">CATEGORIAS</a>
          <a class="nav-item nav-link" href="cartoes.php">Cartões</a>
        </div>
      </div>
      <a class="navbar-brand img-responsive" href="../sair.php"><img src="../css/Img/logofT.png" alt="sair" class="logoff"></a>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="menuVert col-md-2">
          <a href="home.php">Home</a>
          <a href="receita.php">Receita</a>
          <a href="despesa.php">Despesas</a>
          <a href="balanco.php">Balanço</a>
          <a class="ativado" href="categoria.php">CATEGORIAS</a>
          <a href="cartoes.php">Cartões</a>
        </div>
        <div class="col-md-10">
          <div id="avisoCategoria" class="alert divAviso" role="alert">
          </div>
          <div class="container-fluid boxConteudo2">
            <h4>Nova Categoria</h4><br>
            <form id="formCategoria" class="" action="BD/insert/inserirCategoria.php" method="post" onsubmit="return validaCategoria()">
              Nome:
              <input id="inputNovaCategoria" class="inputDados" type="text" name="novaCategoria" value="" placeholder="Nova Categoria">
              <input class="btnA" type="submit" value="Inserir">
            </form>
          </div>
          <div class="container-fluid boxConteudo2">
            <h4>Categorias</h4><br>
            <form class="" action="BD/delete/removeCategoria.php" method="post">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">AUTOR</th>
                    <th scope="col">REMOVER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php include "BD/select/exibeCategoria.php" ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
