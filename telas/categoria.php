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
      <div class="row">
        <div class="menuHor container-fluid">
          <a href="#">Home</a>
          <a href="#">Receita</a>
          <a href="#">Despesas</a>
          <a href="#">Balanço</a>
          <a class="ativado2" href="#">CATEGORIAS</a>
          <a href="#">Cartões</a>
        </div>
        <div class="menuVert col-md-2">
          <a href="#">Home</a>
          <a href="#">Receita</a>
          <a href="#">Despesas</a>
          <a href="#">Balanço</a>
          <a class="ativado" href="#">CATEGORIAS</a>
          <a href="#">Cartões</a>
        </div>
        <div class="col-md-10">
          <div class="container-fluid boxConteudo2">
            <h4>Nova Categoria</h4><br>
            <form class="" action="" method="post">
              Nome:
              <input class="input" type="text" name="" value="">
              <input class="btn" type="submit" value="+">
            </form>
          </div>
          <div class="container-fluid boxConteudo2">
            <h4>Categorias</h4><br>
            <table class="table table-striped">
              <?php include "BD/selectCategorias.php" ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
