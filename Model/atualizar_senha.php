<?php
include "../View/perfis.php";
if(isset($_POST['idusuario'])){
    $consultar->atualizar_senha(
        $_POST['idusuario'],
        $_POST['novasenha'],
        $_POST['senhaantiga'],
        $conn
    );
    
    require_once '../Controller/resetter.php';
    exit();
}else{
    ?><script>
        alert('Preencha todos os campos')
    </script><?php

}



