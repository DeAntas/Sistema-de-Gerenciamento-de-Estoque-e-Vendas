<?php
include_once "../Model/conectdb.php";
include_once "../Controller/auth.php";
include_once "../View/header.php";
require_once "../Model/queries.php";
if(!isset($_SESSION['produtosvender'])){
    $_SESSION['produtosvender']=[];
    $_SESSION['totalvenda']=0;
    $_SESSION['totalcompra']=0;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
</body>
<style>
    button{
        background-color: rgb(25, 170, 40);
        color:white;
        font-weight: 900;
        border-radius:4px;  
        border-style: solid;
        border-width: 3px;
        border-color:black;
        }
    section{
        border-radius:4px;  
        border-style: solid;
        border-width: 3px;
        border-color:black;
    }
    h1{
        color:white;
        font-weight: 900;
    }
</style>
</html>

<?php

$consultar= new Queries(); 
//o objetivo dessas funções é exibir as rotinas de acesso para diferentes perfis de usuário
//o programa decidirá quais funções exibir com base no perfil do usuário atual
function cadastrar_armazem(): string{
    return"
    <section id='cadastro_armazem' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>CADASTRO DE ARMAZEM</b></p>
    <form method='POST' action='../Model/cadastrar_armazem.php'>
    <input type='text' placeholder='Endereco' name='endereco' required>
    <button type='submit'>Cadastrar</button>
    </form>
    <br></section>
    ";
}
function cadastrar_produto(): string{
    return"
    <section id='cadastro_produto' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>CADASTRO DE PRODUTO</b></p>
    <form method='POST' action='../Model/cadastrar_produto.php'>
    <input type='text' placeholder='Nome' name='nome' required>
    <input type='text' placeholder='Descrição' name='descricao' required>
    <input type='number' placeholder='Armazem' name='armazem' required>
    <input type='number' placeholder='Quantidade' name='quantidade' required>
    <input type='number' step='0.01' placeholder='Preço' name='preco' required>
    <input type='text' placeholder='Código de Barras' name='codigo_barras' required>
    <button type='submit'>Cadastrar</button>
    </form>
    <br>
    </section>
    ";

}
function baixar_produto(): string{
    return"
    <section id='cadastro_produto' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>BAIXA DE PRODUTO</b></p>
    <form method='POST' action='../Model/baixar_produto.php'>
    <input type='number' placeholder='Armazem' name='armazem' required>
    <input type='number' placeholder='Quantidade' name='quantidade' required>
    <input type='text' placeholder='ID Produto' name='idproduto' required>
    <button type='submit'>Baixar</button>
    </form>
    <br>
    </section>
    ";

}
function subir_produto(): string{
    return"
    <section id='cadastro_produto' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>SUBIR PRODUTO</b></p>
    <form method='POST' action='../Model/subir_produto.php'>
    <input type='number' placeholder='Armazem' name='armazem' required>
    <input type='number' placeholder='Quantidade' name='quantidade' required>
    <input type='text' placeholder='ID Produto' name='idproduto' required>
    <button type='submit'>Subir</button>
    </form>
    <br>
    </section>
    ";

}
function atualizar_preco_produto(): string{
    return"
    <section id='cadastro_produto' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>ATUALIZAR PREÇO</b></p>
    <form method='POST' action='../Model/atualizar_preco.php'>
    <input type='number' placeholder='Novo Preço' step='0.01' name='novopreco' required>
    <input type='text' placeholder='ID Produto' name='idproduto' required>
    <button type='submit'>Atualizar</button>
    </form>
    <br>
    </section>
    ";

}
function atualizar_senha(): string{
    return"
    <section id='cadastro_produto' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>ALTERAR SENHA</b></p>
    <form method='POST' action='../Model/atualizar_senha.php'>
    <input type='number' placeholder='ID' step='0.01' name='idusuario' required>
    <input type='password' placeholder='Senha Atual' name='senhaantiga' required>
        <input type='password' placeholder='Nova Senha' name='novasenha' required>
    <button type='submit'>Atualizar</button>
    </form>
    <br>
    </section>
    ";

}
function vender_produto(){
    echo"
    <section id='vender_produto' class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'>
    <p><b>VENDA DE PRODUTO</b></p>
    <form method='POST' action='../Model/vender_produto.php'>
    <input type='text' placeholder='Código de Barras' name='codigobarras' required>
    <input type='number' placeholder='Quantidade' name='quantidade' required>
    <button type='submit'>Vender</button>
    </form>
    <br>
    ";
    
    echo"
    <p classs='w3-display-center'><b>LISTA DE PRODUTOS</b></p> 
    <table class='w3-table w3-striped w3-bordered w3-amber w3-centered w3-half w3-hoverable w3-margin'> 
    
    <th>Código de Barras</th>
    <th>Nome do Produto</th>
    <th>Quantidade Produto</th>
    <th>Valor da Venda</th>
    ";
    if(isset($_SESSION['tabelaprodutosvender'])){
        echo $_SESSION['tabelaprodutosvender'] ;}

    echo "</table><br>";
    
    if(isset($_SESSION['produtosvender'])){
    $total_venda=1;
    echo'

    <form action="../Model/vender_produto.php" method="post">
        <input type="hidden" value="'.$total_venda.'" name="totalvenda">
        <button type="submit"><h1>Efetuar Venda</h1></button>
    </form></section>
';
echo "<section class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'><p><b>Total da Compra: R\$ ".$_SESSION['totalcompra']."</b></p></section>";}
    

}
// decidimos aqui qual frontend será exibido ao usuário, a depender de seu perfil de acesso
if(isset($_SESSION['usuarioPerfil'])){

if($_SESSION['usuarioPerfil']==1){
    ?><title>Gerente</title><?php
    echo $consultar->sair();
    echo cadastrar_armazem();
    echo cadastrar_produto();
    echo baixar_produto();
    echo subir_produto();
    echo atualizar_preco_produto();
    
    vender_produto();
    echo "<div class='w3-container w3-center w3-column'>";
    echo $consultar->tabela_usuarios_pendentes($conn);
    echo "</div>";
    echo "<div class='w3-container w3-center w3-column'>";
    echo $consultar->tabela_usuarios($conn);
    echo "</div>";
    echo "<div class='w3-container w3-center w3-column'>";
    echo $consultar->tabela_produtos($conn);
    echo "</div>";
    echo "<div class='w3-container w3-center w3-column'>";
    $consultar->tabela_armazem($conn);
    echo "</div>";
    echo "<div class='w3-container w3-center w3-column'>";
    echo $consultar->listar_caixa($conn);
    echo "</div>";
    echo atualizar_senha();
}
if($_SESSION['usuarioPerfil']==2){
    ?><title>Estoquista</title><?php
    echo $consultar->sair();
    echo cadastrar_armazem();
    echo cadastrar_produto();
    echo baixar_produto();
    echo subir_produto();
    
    echo "<div class='w3-container w3-center w3-column'>";
    echo $consultar->tabela_produtos($conn);
    echo "</div>";
    echo "<div class='w3-container w3-center w3-column'>";
    $consultar->tabela_armazem($conn);
    echo "</div>";
    echo atualizar_senha();
}
if($_SESSION['usuarioPerfil']==3){
    ?><title>Vendedor</title><?php
    echo $consultar->sair();
    vender_produto();
    echo "<div class='w3-container w3-center w3-column'>";
    echo "</div>";
    echo atualizar_senha();
}

}