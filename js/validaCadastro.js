function dadosInput(idInput){
  var input = 'input'+idInput;
  var name = "";

  switch (idInput) {
    case 1:
      name = "Nome";
    break;
    case 2:
      name = "Nickname";
    break;
    case 3:
      name = "Senha";
    break;
    case 4:
      name = "Csenha"
    break;
  }

  var dados = document.getElementsByName(name)[0].value;
  document.getElementById(input).classList.add('exibirDados');
  document.getElementById(input).style.color = "#074267";
}

function dadosInputExit(idInput){
  var input = 'input'+idInput;
  var name = "";

  switch (idInput) {
    case 1:
      name = "Nome";
    break;
    case 2:
      name = "Nickname";
    break;
    case 3:
      name = "Senha";
    break;
    case 4:
      name = "Csenha"
    break;
  }

  var dados = document.getElementsByName(name)[0].value;

  if ((dados == "") || (dados == null)) {
    document.getElementById(input).classList.remove('exibirDados');
    document.getElementsByName(name)[0].classList.remove('dadosInputAtv');
  }else {
    document.getElementById(input).style.color = "rgb(101,101,101)";
    document.getElementsByName(name)[0].classList.add('dadosInputAtv');
  }
}

function validaCadastro(){
  var formCadastro = document.forms["formCadastro"];
  var nome = formCadastro.Nome.value;
  var nickName = formCadastro.Nickname.value;
  var senha = formCadastro.Senha.value;
  var cSenha = formCadastro.Csenha.value;
  var teste = 1;


  if (cSenha != senha) {
    document.getElementsByName("Csenha")[0].classList.add("inputErro");
    document.getElementById('input4').style.color = "red";
    document.getElementById('input4').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-danger");
    document.getElementById('divAviso').innerHTML = "Senha e confirmação não coincidem";
    teste = 0;
  }
  if (cSenha == "" || cSenha == null) {
    document.getElementsByName("Csenha")[0].classList.add("inputErro");
    document.getElementById('input4').style.color = "red";
    document.getElementById('input4').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.remove("alert-danger");
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Insira a confirmação da senha!";
    teste = 0;
  }
  if (senha.length < 6) {
    document.getElementsByName("Senha")[0].classList.add("inputErro");
    document.getElementById('input3').style.color = "red";
    document.getElementById('input3').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "A senha deve ter no minimo 6 caracteres";
    teste = 0;
  }
  if (senha == "" || senha == null) {
    document.getElementsByName("Senha")[0].classList.add("inputErro");
    document.getElementById('input3').style.color = "red";
    document.getElementById('input3').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Insira uma senha!";
    teste = 0;
  }
  if (nickName == "" || nickName == null) {
    document.getElementsByName("Nickname")[0].classList.add("inputErro");
    document.getElementById('input2').style.color = "red";
    document.getElementById('input2').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Insira um Nickname para acessar o sistema!";
    teste = 0;
  }
  if (nome.search(/[^a-z /\s/g]/i) != -1) {
    document.getElementsByName("Nome")[0].classList.add("inputErro");
    document.getElementById('input1').style.color = "red";
    document.getElementById('input1').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Utilize apenas letras no campo Nome!";
    teste = 0;
  }
  if (nome == "" || nome == null) {
    document.getElementsByName("Nome")[0].classList.add("inputErro");
    document.getElementById('input1').style.color = "red";
    document.getElementById('input1').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Digite um nome para usuário!";
    teste = 0;
  }

  if (teste == 0) {
    return false;
  } else {
    return true;
  }
}

function testeCadastro(){
  var endereco = window.location.href;
  endereco = endereco.split("?");
  endereco = endereco[1];

  if (endereco == 'erro=1') {
    document.getElementsByName("Nickname")[0].classList.add("inputErro");
    document.getElementById('input2').style.color = "red";
    document.getElementById('input2').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Nickname indisponivel!";
  }
  if (endereco == 'erro=2') {
    document.getElementsByName("Nome")[0].classList.add("inputErro");
    document.getElementById('input1').style.color = "red";
    document.getElementById('input1').style.display = "block";
    document.getElementById('divAviso').style.display = "block";
    document.getElementById('divAviso').classList.add("alert-warning");
    document.getElementById('divAviso').innerHTML = "Nome de usuário indisponivel!";
  }
  if (endereco == 'add=1') {
    document.getElementsByClassName('cadastroOk')[0].style.display = "block";
  }
}
