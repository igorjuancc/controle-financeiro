<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/estiloLogin.css">
    <script type="text/javascript" src="js/validaLogin.js"></script>
    <title>Meus Gastos - Login</title>
  </head>
  <body onload="testeLogin()">
    <div class="container-fluid">
      <div class="row align-items-center fundo" id="fundo">
        <div class="col">
        </div>
        <div class="col">
          <div id="boxLogin">
            <img id="imgDim" src="css/Img/logoDin.jpg" alt="dinheiro.jpg">
              <form id="formLogin" action="php/BD/validaUsuario.php" method="post" onsubmit="return valida()">
                <div id="aviso" class="divNull">
                </div>
                <img id="logoUser" src="css/Img/logoUser.png" alt="user">
                <input id="inputUser" class="input" type="text" name="usuario" placeholder="Usuário">
                <img id="logoSenha" src="css/Img/logoSenha.png" alt="senha">
                <input id="inputSenha" class="input" type="password" name="senha" placeholder="Senha">
                <br><br>
                <a href="cadastro.php">
                  <button class="botao" type="button" name="cadastrar">Cadastrar</button>
                </a>
                <input class="botao" type="submit" value="Entrar">
              </form>
          </div>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
  </body>
</html>
