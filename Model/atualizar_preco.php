<?php
include "../View/perfis.php";
if(isset($_POST['idproduto'])){
    $consultar->atualizar_preco(
        $_POST['idproduto'],
        $_POST['novopreco'],
        $conn
    );
    
    require_once '../Controller/resetter.php';
    exit();
}else{
    ?><script>
        alert('Preencha todos os campos')
    </script><?php

}



