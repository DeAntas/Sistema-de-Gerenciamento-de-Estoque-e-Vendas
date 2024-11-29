<?php
session_start();
//incluir conexão com o DB
include_once "../Model/conectdb.php";
include_once "../Controller/validaracesso.php";

//A função isset confere se o valor da variável não é nulo, ou seja, se o usuário preencheu os campos de login
if(isset($_POST["id"]) && isset($_POST['senha'])){
    $usuario=mysqli_real_escape_string(mysql: $conn,string: $_POST["id"]); //Caracteres especiais não são permitidos para impedir SQL injection no formulário
    $senha=mysqli_real_escape_string(mysql: $conn, string: $_POST["senha"]);
    //$senha=md5(string: $senha); //criptografa a senha, retirei pois ainda não apliquei a criptografia no momento do cadastro. Aplicar futuramente
//Vamos ver se o login digitado corresponde com os dados na tabela de usuários
    $consulta_usuario="SELECT * FROM `usuarios` WHERE `id`='$usuario' && senha ='$senha' LIMIT 1";
    $resultado_usuario=mysqli_query(mysql: $conn, query: $consulta_usuario);
    $resultado_consulta=mysqli_fetch_assoc(result: $resultado_usuario);

//Encontrado um usuario na tabela usuário com os mesmos dados digitados no formulário
    if(isset($resultado_consulta)){
        //esse array recebe os valores de login do usuário
        $_SESSION['usuarioID']=$resultado_consulta['id'];
        $_SESSION['usuarioNome']=$resultado_consulta['nome'];
        $_SESSION['usuarioPerfil']=$resultado_consulta['perfil'];
        $_SESSION['usuarioAcessos']=$resultado_consulta['qtt_acessos'];
        header("Location: ../View/perfis.php");

}
//Se o primeiro isset falhar, então os campos estão vazios. Este erro será retornado
else{
    $_SESSION['loginErro']="Preencha os campos do formulário.";
    echo($_SESSION['loginErro']);
    header(header: "Location: ../View/index.php");
}}