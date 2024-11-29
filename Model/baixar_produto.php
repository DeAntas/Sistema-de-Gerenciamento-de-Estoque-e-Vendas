<?php
include "../View/perfis.php";
if(isset($_POST['idproduto'])){
    $consultar->baixa_produto(
        $_POST['idproduto'],
        $_POST['quantidade'],
        $conn
    );
    
    require_once '../Controller/resetter.php';
    exit();
}else{
    ?><script>
        alert('Preencha todos os campos')
    </script><?php

}



