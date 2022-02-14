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
    <?php include "Graficos/graficoDespesaMensal.php" ?>
    <?php include "Graficos/graficoDespesaMensalCategoria.php" ?>
    <?php include "Graficos/graficoDespesaPgto.php" ?>
    <title>Despesas</title>
  </head>
  <body onload="tipoPgto(),testeDespesa(),modificaTitulo(),grafDespesaMensal(),grafDespesaCategoria(),grafFormaPagamento()">
    <div class="divInput container-fluid" id="indexBoxEditDespesa">
      <div class="row boxEdit">
        <div class="col">
        </div>
        <div class="col">
          <div class="" id="divEditarDespesa">
            <h5>Editar Despesa</h5>
            <div id="avisoEditarDespesa" class="" role="alert">
            </div>
            <form id="formEditDespesa" action="" onsubmit="" method="post">
              Descrição<br>
              <input id="inputEditDespesa" class="inputEditarReceita" type="text" name="despesa">
              <br>
              Data<br>
              <input id="inputEditDataDespesa" type="date" name="data" class="inputEditarReceita">
              <br>
              <table id="btnOn">
                <tr>
                  <th>Dinheiro</th>
                  <th>Cheque</th>
                  <th>Cartão</th>
                  <th colspan="3"></th>
                </tr>
                <tr>
                  <td><label onclick="testeEditDespesa(1)" for="radDinheiroEdit"><img id="btnEdit1" class="btnSts" src="../css/Img/btnOff.png" alt="dinheiro"></label></td>
                  <td><label onclick="testeEditDespesa(3)" for="radChequeEdit"><img id="btnEdit3" class="btnSts" src="../css/Img/btnOff.png" alt="cheque"></label></td>
                  <td><label onclick="testeEditDespesa(2)" for="radCartaoEdit"><img id="btnEdit2" class="btnSts" src="../css/Img/btnOff.png" alt="cartao"></label></td>
                  <td colspan="3">
                    <select id="dadosCardEdit" class="divInput" name="cartaoEdit" onchange="">
                      <?php include "BD/select/input/exibeCartaoEdit.php" ?>
                    </select>
                  </td>
                </tr>
              </table>
              <div class="">
                  <select id="inputCategoria" name="categoria">
                    <?php include "BD/select/input/exibeCategoria.php" ?>
                  </select>
              </div>
              <div class="divInput">
                <input id="radDinheiroEdit" type="radio" name="formaPgtoE" value="1" checked="checked">
                <input id="radChequeEdit" type="radio" name="formaPgtoE" value="3">
                <input id="radCartaoEdit" type="radio" name="formaPgtoE" value="2">
              </div>
              Valor<br>
              R$<input id="inputEditValorDespesa"  type="text" name="valor" size="3" class="inputEditarReceita">
              <br>
              <div class="" align="right">
                <button type="button" name="cancelar" class="btnB" onclick="fecharJanela('indexBoxEditDespesa','avisoEditarDespesa')">Cancelar</button>
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
          <a class="nav-item nav-link" href="receita.php">Receita</a>
          <a class="nav-item nav-link active" href="despesa.php">DESPESAS</a>
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
          <a href="receita.php">Receita</a>
          <a class="ativado" href="despesa.php">DESPESAS</a>
          <a href="balanco.php">Balanço</a>
          <a href="categoria.php">Categoria</a>
          <a href="cartoes.php">Cartões</a>
        </div>
        <div class="col-md-10">
          <div id="avisoDespesa" class="alert divAviso" role="alert">
          </div>
          <div class="container-fluid boxConteudo2">
            <h5>Nova Despesa</h5><br>
            <form id="formDespesa" action="BD/insert/inserirDespesa.php" method="post" onsubmit="return validaDespesa()">
              Descrição:
              <input id="inputNovaDespesa" class="inputDados" type="text" name="despesa" placeholder="Nova Despesa">
              Data:
              <input id="inputDataDespesa" type="date" name="data" class="inputDados">
              <span id="label1" class="label-btn1" onclick="atvBtn('radDinheiro')"><img src="../css/Img/din.png" alt="dinheiro" id="img-btn1" class="img-btn"></span>
              <span id="label2" class="label-btn2" onclick="atvBtn('radCheque')"><img src="../css/Img/cheque.png" alt="cheque" id="img-btn2" class="img-btn"></span>
              <span id="label3" class="label-btn3" onclick="atvBtn('radCartao')"><img src="../css/Img/card.png" alt="cartao" id="img-btn3" class="img-btn"></span>
              <div class="divInput">
                <input id="radDinheiro" type="radio" name="formaPgto" value="1" checked="checked">
                <input id="radCheque" type="radio" name="formaPgto" value="3">
                <input id="radCartao" type="radio" name="formaPgto" value="2">
              </div>
              <span>
                <select id="dadosCard" class="" name="cartao" onchange="limpaCard()" disabled>
                  <?php include "BD/select/input/exibeCartao.php" ?>
                </select>
              </span>
              <span>
                <select id="inputCategoria" name="categoria">
                  <?php include "BD/select/input/exibeCategoria.php" ?>
                </select>
              </span>
              R$
              <input id="inputValorDespesa"  type="text" name="valor" size="3" placeholder="0,00" class="inputDados">
              <br><br>
              <div id="infoCard">
                <img class="cartao" src="../css/Background/card.png" alt="">
                <span id="nomeCard"></span>
                <span id="tipoCard"></span>
                <span id="digitoCard"></span>
                <img id="bandeiraCard" src="" alt="">
              </div>
              <div class="divBtn">
                <input type="submit" value="Inserir" class="btnA">
              </div>
            </form>
          </div>
          <div class="container-fluid boxConteudo">
            <div class="row">
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoDespesaMensal">
                <canvas id="grafDespesaMensal" class="grafico">
                </canvas>
                <br>
                <h5 id="tituloGrafDespesaMensal"></h5>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoCatMensal">
                <canvas id="grafDespesaCategoria" class="grafico">
                </canvas>
                <br>
                <h5 id="tituloGrafDespesaCategoria"></h5>
              </div>
              <div class="col-md-4 boxGraf">
                <img src="../css/Background/semDados.png" alt="Sem Dados" class="aviso" id="avisoDespPgto">
                <canvas id="grafFormaPagamento" class="grafico">
                </canvas>
                <br>
                <h5>Forma Pagamento</h5>
              </div>
            </div>
          </div>
          <div class="container-fluid boxConteudo2">
            <h4 id="tituloDespesa">Despesas</h4><br>
            <div class="filtro">
              <form id="filtroMes" class="" action="despesa.php" method="post">
                <select class="" name="filtroMeses">
                  <?php include "BD/select/input/exibeMesDespesa.php" ?>
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
                <?php include "BD/select/exibeDespesa.php" ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </body>
</html>
