<?php
    include "select/buscarUsuario.php";

    $login = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $usuario = buscarUsuario($login, $senha);

    if($usuario){
        session_start();
        $_SESSION["usuarioSessao"] = $usuario["NOME_USUARIO"];
        $_SESSION["idUsuarioSessao"] = $usuario["ID_USUARIO"];
        $_SESSION["userNameSessao"] = $usuario["USER_NAME"];

        header("Location:../home.php");
    }else{
      header("Location:/index.php?erro=1");
    }
?>
