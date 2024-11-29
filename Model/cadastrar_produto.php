<?php
include "../View/perfis.php";
if(isset($_POST['codigo_barras'])){
    $consultar->inserir_produto(
        $_POST['nome'], 
        $_POST['descricao'],
        $_POST['quantidade'], 
        $_POST['preco'], 
        $_POST['armazem'],
        $conn,
        $_POST['codigo_barras']
    );
    
    require_once '../Controller/resetter.php';
    exit();
}else{
    ?><script>
        alert('Preencha todos os campos')
    </script><?php

}



