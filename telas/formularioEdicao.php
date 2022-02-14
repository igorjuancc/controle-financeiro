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
    <title>Categorias</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row boxEdit">
        <div class="col">
        </div>
        <div class="col">
          <div class="" id="divEditarReceita">
            <h5>Editar Receita</h5><br>
            <form id="formEditReceita" action="BD/insert/editarReceita.php" method="post" onsubmit="return XXXXReceita()">
              Descrição<br>
              <input id="inputEditReceita" class="inputEditarReceita" type="text" name="novaReceita" placeholder="Nova Receita">
              <br>
              Data<br>
              <input id="inputEditDataReceita" type="date" name="data" class="inputEditarReceita">
              <br>
              Valor<br>
              R$<input id="inputEditValorReceita"  type="text" name="valor" size="3" placeholder="0,00" class="inputEditarReceita">
              <br>
              <div class="" align="right">
                <button type="button" name="cancelar" class="btnB" onclick="editarReceita()">Cancelar</button>
                <input type="submit" value="Inserir" class="btnA">
              </div>
            </form>
          </div>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
  </body>
</html>

<span id="label1" class="label-btn1"><img src="../css/Img/din.png" alt="dinheiro" id="img-btn1" class="img-btn"></span>
<span id="label2" class="label-btn2"><img src="../css/Img/cheque.png" alt="cheque" id="img-btn2" class="img-btn"></span>
<span id="label3" class="label-btn3"><img src="../css/Img/card.png" alt="cartao" id="img-btn3" class="img-btn"></span>

<span class="label-btn1Atv"><img src="../css/Img/dinA.png" alt="dinheiro" class="img-btnAtv"></span>
<span class="label-btn2Atv"><img src="../css/Img/chequeA.png" alt="cheque" class="img-btn"></span>
<span class="label-btn3Atv"><img src="../css/Img/cardA.png" alt="cartao" class="img-btnAtv"></span>
