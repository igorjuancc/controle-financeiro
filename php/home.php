<?php
  session_start();
  if(!isset($_SESSION["idUsuarioSessao"])) {
    header("Location:../index.php");
  }
?>
<!DOCTYPE html>
<html>
<?php include "BD/insert/inserirBalanco.php" ?>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <?php include "Graficos/graficoReceitaMensal.php" ?>
    <?php include "Graficos/graficoDespesaMensalCategoria.php" ?>
    <?php include "Graficos/graficoBalanco2.php" ?>
    <title>Home - Meus Gastos</title>
  </head>
  <body  onload="grafReceitaMensal(),grafDespesaCategoria(),grafBalanco()">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand img-responsive" href="home.php"><img src="../css/Img/logoT.png" alt="inicio" id="logoMenu"></a>
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="home.php">HOME</a>
          <a class="nav-item nav-link" href="receita.php">Receita</a>
          <a class="nav-item nav-link" href="despesa.php">Despesas</a>
          <a class="nav-item nav-link" href="balanco.php">Balanço</a>
          <a class="nav-item nav-link" href="categoria.php">Categorias</a>
          <a class="nav-item nav-link" href="cartoes.php">Cartões</a>
        </div>
      </div>
      <a class="navbar-brand img-responsive" href="../sair.php"><img src="../css/Img/logofT.png" alt="sair" class="logoff"></a>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="menuVert col-md-2">
          <a class="ativado" href="home.php">HOME</a>
          <a href="receita.php">Receita</a>
          <a href="despesa.php">Despesas</a>
          <a href="balanco.php">Balanço</a>
          <a href="categoria.php">Categorias</a>
          <a href="cartoes.php">Cartões</a>
        </div>
        <div class="col-md-10">
          <div class="container-fluid boxConteudo">
            <div class="row">
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoReceitaMensal">
                <canvas id="grafReceita" class="grafico">
                </canvas>
                <br>
                <h5>Receita Mensal</h5>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoCatMensal">
                <canvas id="grafDespesaCategoria" class="grafico">
                </canvas>
                <br>
                <h5>Despesa Mensal Categoria</h5>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoBalancoAnual">
                <canvas id="balanco" class="grafico">
                </canvas>
                <br>
                <h5>Balanço Anual</h5>
              </div>
            </div>
          </div>
          <div class="container-fluid boxConteudo2">
            <h4>Compras ultimos 20 Dias</h4><br>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">DESCRIÇÃO</th>
                  <th scope="col">CATEGORIA</th>
                  <th scope="col">VALOR</th>
                  <th scope="col">DATA</th>
                </tr>
              </thead>
              <tbody>
                <?php include "BD/select/exibeUltGastos.php" ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
