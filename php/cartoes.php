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
    <script type="text/javascript" src="../js/validaCartao.js"></script>
    <title>Cartoes</title>
  </head>
  <body onload="exibeBandeira(0),testeCartao()">
    <div class="container-fluid" id="indexBoxEdit">
      <div class="row boxEdit">
        <div class="col">
        </div>
        <div class="col">
          <div class="" id="divEditarCartao">
            <h5>Editar Cartao</h5>
            <div id="avisoEditar" class="alert" role="alert">
            </div>
            <form id="formEditCartao" action="" method="post" onsubmit="return cartaoEditado()">
              Nome<br>
              <input id="inputEditCartao" class="inputEditarReceita" type="text" name="cartao">
              <br>
              Digito Final<br>
              <input id="inputEditDigito" type="text" name="digito" class="inputEditarReceita">
              <br>
              <select class="" name="tipo">
                <option id="inputCredito" value="CREDITO">Crédito</option>
                <option id="inputDebito" value="DEBITO">Débito</option>
              </select>
              <select id="bandeiraEditCartao" class="" name="bandeira">
                <option value="0" onclick="exibeBandeiraEdit(0)">-</option>
                <?php include "BD/select/input/exibeBandeiraEdit.php" ?>
              </select>
              <img id="bandeiraCartaoEdit" src="" alt=""><br><br>
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
          <a class="nav-item nav-link" href="receita.php">Receita</a>
          <a class="nav-item nav-link" href="despesa.php">Despesas</a>
          <a class="nav-item nav-link" href="balanco.php">Balanço</a>
          <a class="nav-item nav-link" href="categoria.php">Categorias</a>
          <a class="nav-item nav-link active" href="cartoes.php">CARTÕES</a>
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
          <a href="categoria.php">Categorias</a>
          <a class="ativado" href="cartoes.php">CARTÕES</a>
        </div>
        <div class="col-md-10">
          <div id="avisoCartoes" class="alert divAviso" role="alert">
          </div>
          <div class="container-fluid boxConteudo2">
            <h4>Novo Cartão</h4><br>
            <form id="formCartao" class="" action="BD/insert/inserirCartao.php" method="post" onsubmit="return validaCartao()">
              <table id="tabelaInserirCartoes">
                <tr>
                  <th>Nome</th>
                  <th>Digito Final</th>
                  <th>Tipo</th>
                  <th colspan="2">Bandeira</th>
                </tr>
                <tr>
                  <td><input id="inputNovoCartao" class="inputDados" type="text" name="descricao" placeholder="Cartao"></td>
                  <td><input id="inputDigitoCartao" class="inputDados" type="text" name="digito" placeholder="Digito Final"></td>
                  <td>
                    <select class="" name="tipo">
                      <option value="CREDITO">Crédito</option>
                      <option value="DEBITO">Débito</option>
                    </select>
                  </td>
                  <td>
                    <select id="bandeiraNovoCartao" class="" name="bandeira">
                      <option value="0" onclick="exibeBandeira(0)">-</option>
                      <?php include "BD/select/input/exibeBandeira.php" ?>
                    </select>
                  </td>
                  <td><img id="bandeiraCartao" src="" alt=""></td>
                  <td><input class="btnA" type="submit" value="Inserir"></td>
                </tr>
              </table>
            </form>
          </div>
          <div class="container-fluid boxConteudo2">
            <h4>Meus Cartões</h4><br>
            <form class="" action="BD/delete/removeCategoria.php" method="post">
              <table class="table">
                <thead>
                  <tr>
                    <th>DESCRIÇÃO</th>
                    <th>TIPO</th>
                    <th>DIGITO FINAL</th>
                    <th>BANDEIRA</th>
                    <th>EDITAR</th>
                    <th>REMOVER</th>
                  </tr>
                </thead>
                <tbody>
                  <?php include "BD/select/exibeCartoes.php" ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
