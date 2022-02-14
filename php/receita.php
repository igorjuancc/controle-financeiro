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
    <script type="text/javascript" src="../js/validaReceita.js"></script>
    <?php include "Graficos/graficoReceitaMensal.php" ?>
    <?php include "Graficos/graficoReceitaAnual.php" ?>
    <?php include "Graficos/graficoBalancoAnual.php" ?>
    <title>Receitas</title>
  </head>
  <body onload="testeReceita(),grafReceitaMensal(),modificaTitulo(),grafReceitaAnual(),graficoBalancoAnual()">
    <div class="container-fluid" id="indexBoxEdit">
      <div class="row boxEdit">
        <div class="col">
        </div>
        <div class="col">
          <div class="" id="divEditarReceita">
            <h5>Editar Receita</h5>
            <div id="avisoEditar" class="alert" role="alert">
            </div>
            <form id="formEditReceita" action="" method="post" onsubmit="return receitaEditada()">
              Descrição<br>
              <input id="inputEditReceita" class="inputEditarReceita" type="text" name="receita">
              <br>
              Data<br>
              <input id="inputEditDataReceita" type="date" name="data" class="inputEditarReceita">
              <br>
              Valor<br>
              R$<input id="inputEditValorReceita"  type="text" name="valor" size="3" class="inputEditarReceita">
              <br>
              <div class="" align="right">
                <button type="button" name="cancelar" class="btnB" onclick="fecharJanela('indexBoxEdit','avisoEditar')">Cancelar</button>
                <input type="submit" value="Salvar" class="btnA">
              </div>
            </form>
          </div>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand img-responsive" href="home.php"><img src="../css/Img/logoT.png" alt="inicio" id="logoMenu"></a>
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="home.php">Home</a>
          <a class="nav-item nav-link active" href="receita.php">RECEITA</a>
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
          <a href="home.php">Home</a>
          <a class="ativado" href="receita.php">RECEITA</a>
          <a href="despesa.php">Despesas</a>
          <a href="balanco.php">Balanço</a>
          <a href="categoria.php">Categoria</a>
          <a href="cartoes.php">Cartões</a>
        </div>
        <div class="col-md-10">
          <div id="avisoReceita" class="alert divAviso" role="alert">
          </div>
          <div class="container-fluid boxConteudo2">
            <h5>Nova Receita</h5><br>
            <form id="formReceita" action="BD/insert/inserirReceita.php" method="post" onsubmit="return validaReceita()">
              Descrição:
              <input id="inputNovaReceita" class="inputDados" type="text" name="novaReceita" placeholder="Nova Receita">
              Data:
              <input id="inputDataReceita" type="date" name="data" class="inputDados">
              R$
              <input id="inputValorReceita"  type="text" name="valor" size="3" placeholder="0,00" class="inputDados">
              <input type="submit" value="Inserir" class="btnA">
            </form>
          </div>
          <div class="container-fluid boxConteudo">
            <div class="row">
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoReceitaMensal">
                <canvas id="grafReceita" class="grafico">
                </canvas>
                <br>
                <h5 id="tituloGrafReceitaMes">Receita Atual</h5>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoReceitaAnual">
                <canvas id="grafReceitaAnual" class="grafico">
                </canvas>
                <br>
                <h5>Receita Anual</h5>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoBalancoAnual">
                <canvas id="graficoBalancoAnual" class="grafico">
                </canvas>
                <br>
                <h5>Balanço Anual</h5>
              </div>
            </div>
          </div>
          <div class="container-fluid boxConteudo2">
            <h4 id="tituloReceita">Receitas</h4>
            <div class="filtro">
              <form id="filtroMes" class="" action="receita.php" method="post">
                <select class="" name="filtroMeses">
                  <?php include "BD/select/input/exibeMesReceita.php" ?>
                </select>
              </form>
            </div><br>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">DESCRIÇÃO</th>
                  <th scope="col">VALOR</th>
                  <th scope="col">DATA</th>
                  <th scope="col">EDITAR</th>
                  <th scope="col">EXCLUIR</th>
                </tr>
              </thead>
              <tbody>
                <?php include "BD/select/exibeReceita.php" ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </body>
</html>
