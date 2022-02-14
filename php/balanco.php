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
    <script type="text/javascript" src="../js/validaDespesa.js"></script>
    <?php include "Graficos/graficoBalanco2.php" ?>
    <?php include "Graficos/graficoBalancoTotal.php" ?>
    <?php include "Graficos/graficoDespAnoCat.php" ?>
    <?php include "Graficos/graficoDespesaPgtoAnual.php" ?>
    <?php include "Graficos/graficoDespesaCardAnual.php" ?>
    <title>Balanço</title>
  </head>
  <body onload="grafBalanco(),grafTotal(),grafDespCat(),grafFormaPagamento(),grafDespCard()">
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
          <a class="nav-item nav-link active" href="balanco.php">BALANÇO</a>
          <a class="nav-item nav-link" href="categoria.php">Categorias</a>
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
          <a class="ativado" href="balanco.php">BALANÇO</a>
          <a href="categoria.php">Categoria</a>
          <a href="cartoes.php">Cartões</a>
        </div>
        <div class="col-md-10">
          <div class="container-fluid boxConteudo2">
            <h4>Balanço</h4><br>
            <div class="row">
              <div class="col-md-6 graf2">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso2" id="avisoBalancoAnual">
                <canvas id="balanco">
                </canvas>
                <h5>Anual</h5>
              </div>
              <div class="col-md-6 graf2">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso2" id="avisoBalancoTotal">
                <canvas id="total">
                </canvas>
                <h5>Total</h5>
              </div>
            </div>
          </div>
          <div class="container-fluid boxConteudo">
            <div class="row">
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoDespCat">
                <canvas id="grafDespCat" class="grafico">
                </canvas>
                <br>
                <h6>Despesa anual por categoria</h6>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoDespPgtoAno">
                <canvas id="grafFormaPagamento" class="grafico">
                </canvas>
                <br>
                <h6>Forma de pagamento anual</h6>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoDespCardAno">
                <canvas id="grafDespCard" class="grafico">
                </canvas>
                <br>
                <h6>Despesa anual por cartão</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
