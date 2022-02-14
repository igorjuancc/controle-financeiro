//--------------------------Botões de seleção de pagamento--------------------//

function tipoPgto(){
  btnOriginais();

  var dinheiro = document.getElementById("radDinheiro").checked;
  var cheque = document.getElementById("radCheque").checked;
  var cartao = document.getElementById("radCartao").checked;

  if (dinheiro == true) {
    document.getElementById('label1').classList.remove('label-btn1');
    document.getElementById('img-btn1').classList.remove('img-btn');
    document.getElementById('label1').classList.add('label-btn1Atv');
    document.getElementById('img-btn1').classList.add('img-btnAtv');
    document.getElementById('img-btn1').src='../css/Img/dinA.png';
    document.getElementById('dadosCard').classList.add('divInput');
  }
  if (cheque == true) {
    document.getElementById('label2').classList.remove('label-btn2');
    document.getElementById('label2').classList.add('label-btn2Atv');
    document.getElementById('img-btn2').src='../css/Img/chequeA.png';
    document.getElementById('dadosCard').classList.add('divInput');
  }
  if (cartao == true) {
    document.getElementById('label3').classList.remove('label-btn3');
    document.getElementById('img-btn3').classList.remove('img-btn');
    document.getElementById('label3').classList.add('label-btn3Atv');
    document.getElementById('img-btn3').classList.add('img-btnAtv');
    document.getElementById('img-btn3').src='../css/Img/cardA.png';
    document.getElementById('dadosCard').disabled = false;
    document.getElementById('infoCard').classList.remove('divInput');
    document.getElementById('dadosCard').classList.remove('divInput');
    var teste = document.getElementById('dadosCard').value;
    if (teste == 0) {
      document.getElementById('dadosCard').classList.add('selectCard');
      document.getElementById('infoCard').classList.add('divInput');
    }
  }
}

function btnOriginais() {
  document.getElementById('label1').classList.remove('label-btn1Atv');
  document.getElementById('label2').classList.remove('label-btn2Atv');
  document.getElementById('label3').classList.remove('label-btn3Atv');
  document.getElementById('label1').classList.add('label-btn1');
  document.getElementById('label2').classList.add('label-btn2');
  document.getElementById('label3').classList.add('label-btn3');
  document.getElementById('img-btn1').classList.remove('img-btnAtv');
  document.getElementById('img-btn3').classList.remove('img-btnAtv');
  document.getElementById('img-btn1').classList.add('img-btn');
  document.getElementById('img-btn3').classList.add('img-btn');
  document.getElementById('img-btn1').src='../css/Img/din.png';
  document.getElementById('img-btn2').src='../css/Img/cheque.png';
  document.getElementById('img-btn3').src='../css/Img/card.png';
  document.getElementById('dadosCard').disabled = true;
  document.getElementById('infoCard').classList.add('divInput');
  document.getElementById('dadosCard').classList.remove('selectCard');
}

function atvBtn(id){
  document.getElementById(id).checked = true;
  tipoPgto();
}

//------------------------------Exibir dados cartão---------------------------//

function insereDadosCard(tipo,codFinal,bandeira){
  var doc = document.getElementById('dadosCard');
  var nome = doc.options[doc.selectedIndex].text;

  document.getElementById('nomeCard').innerHTML = nome;
  document.getElementById('tipoCard').innerHTML = tipo;
  document.getElementById('digitoCard').innerHTML = codFinal;
  document.getElementById('bandeiraCard').src = '../css/Img/Bandeiras/'+bandeira+'.png';
  document.getElementById('infoCard').classList.remove('divInput');
  document.getElementById('dadosCard').classList.remove('selectCard');
}

function limpaCard(){
  document.getElementById('opc1').classList.add('divInput');
}

//-----------------------------Valida despesa---------------------------------//

function validaDespesa(){
  var formDespesa = document.forms["formDespesa"];
  var descricao = formDespesa.despesa.value;
  var data = formDespesa.data.value;
  var tipoPgto = formDespesa.formaPgto.value;
  var cartao = formDespesa.cartao.value;
  var valor = isNumber(formDespesa.valor.value);

  if (descricao == null || descricao == "") {
    document.getElementById('inputNovaDespesa').classList.add('inputErro');
    return false;
  }
  if (data == null || data == "") {
    document.getElementById('inputDataDespesa').classList.add('inputErro');
    return false;
  }
  if ((tipoPgto == 2) && (cartao == 0)) {
    document.getElementById('dadosCard').classList.add('selectCardErro');
    return false;
  }
  if (valor == null || valor == "") {
    document.getElementById('inputValorDespesa').classList.add('inputErro');
    return false;
  }
  return true;
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

//-----------------------------Aviso despesa---------------------------------//

function testeDespesa(){
  var endereco = window.location.href;
  endereco = endereco.split("?");
  endereco = endereco[1];

  if (endereco == 'des=s') {
    document.getElementById('avisoDespesa').innerHTML = 'Despesa adicionada com sucesso!';
    document.getElementById('avisoDespesa').classList.add('alert-success');
    document.getElementById('avisoDespesa').style.display = 'block';
  }
  if (endereco == 'des=r') {
    document.getElementById('avisoDespesa').innerHTML = 'Despesa removida com sucesso!';
    document.getElementById('avisoDespesa').classList.add('alert-danger');
    document.getElementById('avisoDespesa').style.display = 'block';
  }
  if (endereco == 'des=pr') {
    document.getElementById('avisoDespesa').innerHTML = 'Problema ao remover despesa!';
    document.getElementById('avisoDespesa').classList.add('alert-warning');
    document.getElementById('avisoDespesa').style.display = 'block';
  }
  if (endereco == 'des=e') {
    document.getElementById('avisoDespesa').innerHTML = 'Despesa editada com sucesso!';
    document.getElementById('avisoDespesa').classList.add('alert-info');
    document.getElementById('avisoDespesa').style.display = 'block';
  }
  if (endereco == 'des=pe') {
    document.getElementById('avisoDespesa').innerHTML = 'Problema ao editar despesa!';
    document.getElementById('avisoDespesa').classList.add('alert-warning');
    document.getElementById('avisoDespesa').style.display = 'block';
  }
}

//-----------------------------Remove despesa---------------------------------//

function removeDespesa(elm){
  var msg = document.getElementById("desc"+elm);
  var cnf = confirm("EXCLUIR DESPESA "+msg.innerHTML+"?");
  if(cnf != true){
    return false;
  }
}

//-----------------------------Editar despesa---------------------------------//

function testeEditDespesa(input){
  if (input == 1) {
    document.getElementById('btnEdit1').src = "../css/Img/btnOn.png";
    document.getElementById('btnEdit3').src = "../css/Img/btnOff.png";
    document.getElementById('btnEdit2').src = "../css/Img/btnOff.png";
    document.getElementById('dadosCardEdit').classList.add('divInput');
    document.getElementById('radDinheiroEdit').checked = true;
  }
  if (input == 2) {
    document.getElementById('btnEdit1').src = "../css/Img/btnOff.png";
    document.getElementById('btnEdit3').src = "../css/Img/btnOff.png";
    document.getElementById('btnEdit2').src = "../css/Img/btnOn.png";
    document.getElementById('dadosCardEdit').classList.remove('divInput');
    document.getElementById('radCartaoEdit').checked = true;

  }
  if (input == 3) {
    document.getElementById('btnEdit1').src = "../css/Img/btnOff.png";
    document.getElementById('btnEdit3').src = "../css/Img/btnOn.png";
    document.getElementById('btnEdit2').src = "../css/Img/btnOff.png";
    document.getElementById('dadosCardEdit').classList.add('divInput');
    document.getElementById('radChequeEdit').checked = true;
  }
}

function editarDespesa(val,idDesp,des,pgto,idCat,idCard){
  testeEditDespesa(pgto);
  optCard = "opt"+idCard;
  optCat = "cat"+idCat;
  var formEdit = document.forms["formEditDespesa"];
  var cartao = "";

  document.getElementById('indexBoxEditDespesa').style.display = 'block';
  document.getElementById('inputEditDespesa').placeholder = des;
  document.getElementById('formEditDespesa').action = "BD/update/editarDespesa.php?des="+idDesp;
  document.getElementById('inputEditValorDespesa').placeholder = val;
  document.getElementById('inputEditDespesa').value='';
  document.getElementById('inputEditValorDespesa').value='';
  document.getElementById(optCat).selected = "true";

  if (optCard != "opt") {
    document.getElementById(optCard).selected = "true";
    cartao = formEdit.cartaoEdit.value;
  }else {
    cartao = 0;
  }

  var atrib = pgto+cartao+idCat;
  document.getElementById("formEditDespesa").setAttribute('onsubmit', "return validarEdit("+atrib+")");
}

function validarEdit(verAnt){
  verAnt = verAnterior(verAnt);
  var formEdit = document.forms["formEditDespesa"];
  var valor = formEdit.valor.value;
  var data = formEdit.data.value;
  var descricao = formEdit.despesa.value;
  var verifica = valor+data+descricao;

  if ((verifica == null || verifica == "") && (verAnt == true)) {
    document.getElementById("avisoEditarDespesa").classList.add("alert");
    document.getElementById("avisoEditarDespesa").classList.add("alert-warning");
    document.getElementById('avisoEditarDespesa').style.display = 'block';
    document.getElementById('avisoEditarDespesa').innerHTML = 'Preencha/Altere os campos para atualizar!';
    return false;
  } else {
    if ((valor == null) || (valor == "")){
      return true;
    } else {
      valor = isNumber(formEdit.valor.value);
      if (valor == false) {
        document.getElementById("avisoEditarDespesa").classList.add("alert");
        document.getElementById("avisoEditarDespesa").classList.add("alert-danger");
        document.getElementById('avisoEditarDespesa').style.display = 'block';
        document.getElementById('avisoEditarDespesa').innerHTML = 'Valor invalido!';
        return false;
      }
    }
    return true;
  }
}

function verAnterior(verAnt){
  var formEdit = document.forms["formEditDespesa"];
  var pgto = formEdit.formaPgtoE.value;
  var card= formEdit.cartaoEdit.value;
  var cat = formEdit.categoria.value;

  if (pgto != 2) {
    card = 0;
  }
  var ver = pgto+card+cat;

  if (ver == verAnt) {
    return true;
  }else {
    return false;
  }
}

/* Função para atualizar tabelas e graficos */
function exibeMes(){
  document.getElementById("filtroMes").submit();
}

/* Função para modificar titulos da pagina*/
function modificaTitulo(){
  var meses = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];
  var strDataAtual = document.getElementById("dataAtual").innerHTML;
  strDataAtual = strDataAtual.split("/");
  document.getElementById("tituloDespesa").innerHTML = 'Despesa - '+meses[(strDataAtual[0]-1)]+'/'+strDataAtual[1];
  document.getElementById("tituloGrafDespesaMensal").innerHTML = 'Despesa - '+meses[(strDataAtual[0]-1)]+'/'+strDataAtual[1];
  document.getElementById("tituloGrafDespesaCategoria").innerHTML = 'Categoria - '+meses[(strDataAtual[0]-1)]+'/'+strDataAtual[1];
}

/* Função para ocultar janela/formulario */
function fecharJanela(janela,idElemento){
  document.getElementById(janela).style.display = 'none';
  document.getElementById(idElemento).style.display = 'none';
  document.getElementById(idElemento).classList.remove("alert-warning","alert-danger");
}
