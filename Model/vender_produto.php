<?php
include "../View/perfis.php";

if(isset($_POST['totalvenda'])){
    $consultar->venda_produto($conn);
    $_SESSION['tabelaprodutosvender']=$consultar->lista_produtos_vender('a',1,$conn);
    require_once '../Controller/resetter.php';
    exit();
}
if($_POST['codigobarras']!= ''){
    $_SESSION['tabelaprodutosvender']=$consultar->lista_produtos_vender($_POST['codigobarras'],$_POST['quantidade'],$conn);
    require_once '../Controller/resetter.php';
    exit();
}
 


else{
    ?><script>
        alert('Preencha todos os campos')
    </script><?php

}


