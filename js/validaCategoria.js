//-----------------------------Remove Categoria-------------------------------//

function removeCategoria(cat){
  var msg = document.getElementById("desc"+cat);
  var cnf = confirm("EXCLUIR CATEGORIA "+msg.innerHTML+"?");
  if(cnf != true){
    return false;
  }
}

//-----------------------------Teste Categoria--------------------------------//

function testeCategoria(){
  var endereco = window.location.href;
  endereco = endereco.split("?");
  endereco = endereco[1];

  if (endereco == 'cat=s') {
    document.getElementById('avisoCategoria').innerHTML = 'Categoria adicionada com sucesso!';
    document.getElementById('avisoCategoria').classList.add('alert-success');
    document.getElementById('avisoCategoria').style.display = 'block';
  }
  if (endereco == 'cat=ps') {
    document.getElementById('avisoCategoria').innerHTML = 'Problema ao inserir categoria!';
    document.getElementById('avisoCategoria').classList.add('alert-warning');
    document.getElementById('avisoCategoria').style.display = 'block';
  }
  if (endereco == 'cat=r') {
    document.getElementById('avisoCategoria').innerHTML = 'Categoria removida com sucesso!';
    document.getElementById('avisoCategoria').classList.add('alert-danger');
    document.getElementById('avisoCategoria').style.display = 'block';
  }
  if (endereco == 'cat=pr') {
    document.getElementById('avisoCategoria').innerHTML = 'Problema ao remover categoria';
    document.getElementById('avisoCategoria').classList.add('alert-warning');
    document.getElementById('avisoCategoria').style.display = 'block';
  }
}

//-----------------------------Valida Categoria-------------------------------//

function validaCategoria() {
  var formCategoria = document.forms["formCategoria"];
  var novaCategoria = formCategoria.novaCategoria.value;

  if (novaCategoria == null || novaCategoria == "")  {
    document.getElementById("inputNovaCategoria").classList.add('inputErro');
    return false;
  }
}
