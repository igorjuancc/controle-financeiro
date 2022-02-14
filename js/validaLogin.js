function valida() {
  var formLogin = document.forms["formLogin"];
  var login = formLogin.usuario.value;
  var senha = formLogin.senha.value;

  if (login == null || login == "") {
    document.getElementById('inputUser').classList.add('inputNull');
    document.getElementById('imgDim').src = 'css/Img/anonimo.png';
    document.getElementById('logoUser').src = 'css/Img/logoUserNull.png';
    document.getElementById('aviso').innerHTML = 'Insira um nome de usuário!';
    return false;
  }
  if (senha == null || senha == "") {
    document.getElementById('inputSenha').classList.add('inputNull');
    document.getElementById('imgDim').src = 'css/Img/anonimoSenha.png';
    document.getElementById('logoSenha').src = 'css/Img/logoSenhaNull.png';
    document.getElementById('aviso').innerHTML = 'Insira a senha!';
    return false;
  }
}

function testeLogin() {
  var endereco = window.location.href;
  endereco = endereco.split("?");
  endereco = endereco[1];

  if (endereco == 'erro=1') {
    document.getElementById('imgDim').src = 'css/Img/userErro.jpg';
    document.getElementById('aviso').innerHTML = 'Usuário ou senha inválido!';
    document.getElementById('fundo').classList.remove('fundo');
    document.getElementById('fundo').classList.add('fundoErro');
    document.getElementById('aviso').classList.add('divErro');
    document.getElementById('formLogin').style.border = "2px solid #CD0000";
  }
}
