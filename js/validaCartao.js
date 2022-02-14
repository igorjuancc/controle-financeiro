//------------------------------Exibir bandeira cartão------------------------//

function exibeBandeira(idBandeira){
  document.getElementById('bandeiraCartao').src = '../css/Img/Bandeiras/'+idBandeira+'.png';
}

function exibeBandeiraEdit(idBandeira) {
  document.getElementById('bandeiraCartaoEdit').src = '../css/Img/Bandeiras/'+idBandeira+'.png';
}

//-----------------------------Valida Cartão----------------------------------//

function validaCartao(){
  var formCartao = document.forms["formCartao"];
  var descricao = formCartao.descricao.value;
  var bandeira = formCartao.bandeira.value;
  var digito = isNumber(formCartao.digito.value);

  if (descricao == null || descricao == "") {
    document.getElementById('inputNovoCartao').classList.add('inputErro');
    return false;
  }
  if (digito == null || digito == "") {
    document.getElementById('inputDigitoCartao').classList.add('inputErro');
    return false;
  }
  if (bandeira == 0) {
    document.getElementById('bandeiraNovoCartao').classList.add('selectCardErro');
    return false;
  }

  return true;
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

//-----------------------------Editar Cartão----------------------------------//

function editarCartao(desc,digito,tipo,idCartao,bandeira){
  exibeBandeiraEdit(bandeira);
  var optBand = "opt"+bandeira;

  document.getElementById('indexBoxEdit').style.display = 'block';
  document.getElementById('inputEditCartao').placeholder = desc;
  document.getElementById('inputEditDigito').placeholder = digito;
  document.getElementById('inputEditCartao').value='';
  document.getElementById('inputEditDigito').value='';
  document.getElementById(optBand).selected = "true";

  if (tipo == "DEBITO") {
    document.getElementById('inputDebito').selected = "true";
  }else {
    document.getElementById('inputCredito').selected = "true";
  }

  document.getElementById('formEditCartao').action = "BD/update/editarCartao.php?card="+idCartao;

  var atrib = "'"+tipo+"',"+bandeira;

  document.getElementById("formEditCartao").setAttribute('onsubmit', "return validarEdit("+atrib+")");
}

function validarEdit(tipo,band) {
  verAnt = verAnterior(tipo,band);
  var formEdit = document.forms["formEditCartao"];
  var nome = formEdit.cartao.value;
  var digito = formEdit.digito.value;
  var verifica = nome+digito;

  if ((verifica == null || verifica == "") && (verAnt == true))  {
    document.getElementById("avisoEditar").classList.add("alert");
    document.getElementById("avisoEditar").classList.add("alert-warning");
    document.getElementById('avisoEditar').style.display = 'block';
    document.getElementById('avisoEditar').innerHTML = 'Preencha/Altere os campos para atualizar!';
    return false;
  }else {
    if ((digito == null) || (digito == "")){
      return true;
    } else {
      digito = isNumber(formEdit.digito.value);
      if (digito == false) {
        document.getElementById("avisoEditar").classList.add("alert");
        document.getElementById("avisoEditar").classList.add("alert-danger");
        document.getElementById('avisoEditar').style.display = 'block';
        document.getElementById('avisoEditar').innerHTML = 'Valor invalido!';
        return false;
      }
    }
    return true;
  }
}

function verAnterior(tipo,band) {
  var formEdit = document.forms["formEditCartao"];
  var tipoEdit = formEdit.tipo.value;
  var bandeira = formEdit.bandeira.value;


  if ((tipoEdit == tipo) && (bandeira == band)) {
    return true;
  }
  return false;
}

//-----------------------------Aviso Cartao---------------------------------//

function testeCartao(){
  var endereco = window.location.href;
  endereco = endereco.split("?");
  endereco = endereco[1];

  if (endereco == 'card=s') {
    document.getElementById('avisoCartoes').innerHTML = 'Novo cartao adicionado com sucesso!';
    document.getElementById('avisoCartoes').classList.add('alert-success');
    document.getElementById('avisoCartoes').style.display = 'block';
  }
  if (endereco == 'card=r') {
    document.getElementById('avisoCartoes').innerHTML = 'Cartao removido com sucesso!';
    document.getElementById('avisoCartoes').classList.add('alert-danger');
    document.getElementById('avisoCartoes').style.display = 'block';
  }
  if (endereco == 'card=pr') {
    document.getElementById('avisoCartoes').innerHTML = 'Problema ao remover cartão!';
    document.getElementById('avisoCartoes').classList.add('alert-warning');
    document.getElementById('avisoCartoes').style.display = 'block';
  }
  if (endereco == 'card=e') {
    document.getElementById('avisoCartoes').innerHTML = 'Dados editados com sucesso!';
    document.getElementById('avisoCartoes').classList.add('alert-info');
    document.getElementById('avisoCartoes').style.display = 'block';
  }
  if (endereco == 'card=pe') {
    document.getElementById('avisoCartoes').innerHTML = 'Problema ao editar dados do cartão!';
    document.getElementById('avisoCartoes').classList.add('alert-warning');
    document.getElementById('avisoCartoes').style.display = 'block';
  }
}

//-----------------------------Remove Cartao----------------------------------//

function removeCartao(cat){
  var msg = document.getElementById("desc"+cat);
  var cnf = confirm("EXCLUIR CARTAO "+msg.innerHTML+"?");
  if(cnf != true){
    return false;
  }
}

/* Função para ocultar janela/formulario */
function fecharJanela(janela,idElemento){
  document.getElementById(janela).style.display = 'none';
  document.getElementById(idElemento).style.display = 'none';
  document.getElementById(idElemento).classList.remove("alert-warning","alert-danger");
}
