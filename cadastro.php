<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/estiloCadastro.css">
    <script type="text/javascript" src="js/validaCadastro.js"></script>
    <title>Meus Gastos - Cadastro</title>
  </head>
  <body onload="testeCadastro()">
    <div class="cadastroOk">
      <div class="cadastroAviso">
        <h4>Cadastro Efetuado com Sucesso!</h4>
        <p>Clique no botão para seguir até página de login.</p>
        <a href="index.php"><button class="btnSalvar" type="button" id="btnContinuar">Continuar</button></a>
      </div>
    </div>
    <div class="back"></div>
    <div class="row conteudo">
      <div class="col-md-4">
      </div>
      <div class="col-md-4">
        <div class="fundo">
          <div class="divForm">
            <h4>Novo Usuário</h4>
            <div id="divAviso" class="alert aviso" role="alert">
            </div>
            <form id="formCadastro" class="formulario" action="php/BD/insert/inserirUsuario.php" method="post" onsubmit="return validaCadastro()">
              <div class="dadosInput" id="input1">Nome</div>
              <input type="text" name="Nome" class="input" placeholder="Nome" onfocus="dadosInput(1)" onfocusout="dadosInputExit(1)">
              <div class="dadosInput" id="input2">Nickname</div>
              <input type="text" name="Nickname" class="input" placeholder="Nickname" onfocus="dadosInput(2)" onfocusout="dadosInputExit(2)">
              <div class="dadosInput" id="input3">Senha</div>
              <input type="password" name="Senha" class="input" placeholder="Senha" onfocus="dadosInput(3)" onfocusout="dadosInputExit(3)">
              <div class="dadosInput" id="input4">Confirmar Senha</div>
              <input type="password" name="Csenha" class="input" placeholder="Confirmar Senha" onfocus="dadosInput(4)" onfocusout="dadosInputExit(4)">
              <br><br>
              <a href="index.php"><button class="btnVoltar" type="button">Voltar</button></a>
              <input class="btnSalvar" type="submit" value="Criar">
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
      </div>
    </div>
  </body>
</html>
