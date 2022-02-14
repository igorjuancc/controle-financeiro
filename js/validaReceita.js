function validaReceita() {
  var formReceita = document.forms["formReceita"];
  var novaReceita = formReceita.novaReceita.value;
  var data = formReceita.data.value;
  var valor = isNumber(formReceita.valor.value);

  if (novaReceita == null || novaReceita == "")  {
    document.getElementById("inputNovaReceita").classList.add('inputErro');
    return false;
  }
  if (data == null || data == "")  {
    document.getElementById("inputDataReceita").classList.add('inputErro');
    return false;
  }
  if (valor == null || valor == ""){
    document.getElementById("inputValorReceita").classList.add('inputErro');
    return false;
  }
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function removeReceita(elm){
  var msg = document.getElementById("desc"+elm);
  var cnf = confirm("EXCLUIR RECEITA "+msg.innerHTML+"?");
  if(cnf != true){
    return false;
  }
}

/* Função para exibir aviso de acordo com a operação de inserção de receita no BD*/
function testeReceita(){
  var endereco = window.location.href;
  endereco = endereco.split("?");
  endereco = endereco[1];

  if (endereco == 'rec=s') {
    document.getElementById('avisoReceita').innerHTML = 'Receita adicionada com sucesso!';
    document.getElementById('avisoReceita').classList.add('alert-success');
    document.getElementById('avisoReceita').style.display = 'block';
  }
  if (endereco == 'rec=r') {
    document.getElementById('avisoReceita').innerHTML = 'Receita removida com sucesso!';
    document.getElementById('avisoReceita').classList.add('alert-danger');
    document.getElementById('avisoReceita').style.display = 'block';
  }
  if (endereco == 'rec=pr') {
    document.getElementById('avisoReceita').innerHTML = 'Problema ao remover receita!';
    document.getElementById('avisoReceita').classList.add('alert-warning');
    document.getElementById('avisoReceita').style.display = 'block';
  }
  if (endereco == 'rec=e') {
    document.getElementById('avisoReceita').innerHTML = 'Receita editada com sucesso!';
    document.getElementById('avisoReceita').classList.add('alert-info');
    document.getElementById('avisoReceita').style.display = 'block';
  }
  if (endereco == 'rec=pe') {
    document.getElementById('avisoReceita').innerHTML = 'Problema ao editar receita!';
    document.getElementById('avisoReceita').classList.add('alert-warning');
    document.getElementById('avisoReceita').style.display = 'block';
  }
}

/* Função para exibir div com formulario de edicao */
function editarReceita(val,id,des){
  document.getElementById('indexBoxEdit').style.display = 'block';
  document.getElementById('inputEditReceita').placeholder = des;
  document.getElementById('formEditReceita').action = "BD/update/editarReceita.php?rec="+id;
  document.getElementById('inputEditValorReceita').placeholder = val;
  document.getElementById('inputEditReceita').value='';
  document.getElementById('inputEditValorReceita').value='';
}

/* Função para verificação de dados de edição de receita a serem submetidos */
function receitaEditada(){
  var formEdit = document.forms["formEditReceita"];
  var valor = formEdit.valor.value;
  var data = formEdit.data.value;
  var descricao = formEdit.receita.value;
  var verifica = valor+data+descricao;


  if (verifica == null || verifica == "") {
    document.getElementById("avisoEditar").classList.add("alert-warning");
    document.getElementById('avisoEditar').style.display = 'block';
    document.getElementById('avisoEditar').innerHTML = 'Preencha os campos para atualizar!';
    return false;
  } else {
    if ((valor == null) || (valor == "")){
      return true;
    } else {
      valor = isNumber(formEdit.valor.value);
      if (valor == false) {
        document.getElementById("avisoEditar").classList.add("alert-danger");
        document.getElementById('avisoEditar').style.display = 'block';
        document.getElementById('avisoEditar').innerHTML = 'Valor invalido!';
        return false;
      }
    }
  }
  return true;
}

/* Função para atualizar tabelas e graficos */
function exibeMes(){
  document.getElementById("filtroMes").submit();
}

function modificaTitulo(){
  var meses = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];
  var strDataAnterior = document.getElementById("dataAnterior").innerHTML;
  strDataAnterior = strDataAnterior.split("/");
  var dataAnterior = new Date();
  var dataAtual = new Date();
  dataAnterior.setFullYear(strDataAnterior[2],(strDataAnterior[1]-1),strDataAnterior[0]);
  dataAtual.setFullYear(strDataAnterior[2],(strDataAnterior[1]-1),strDataAnterior[0]);
  dataAtual.setMonth(dataAnterior.getMonth() + 1);

  document.getElementById("tituloReceita").innerHTML = 'Receita - '+meses[dataAtual.getMonth()]+'/'+dataAtual.getFullYear();
  document.getElementById("tituloGrafReceitaMes").innerHTML = 'Receita - '+meses[dataAtual.getMonth()]+'/'+dataAtual.getFullYear();
}


/* Função para ocultar janela/formulario */
function fecharJanela(janela,idElemento){
  document.getElementById(janela).style.display = 'none';
  document.getElementById(idElemento).style.display = 'none';
  document.getElementById(idElemento).classList.remove("alert-warning","alert-danger");
}
