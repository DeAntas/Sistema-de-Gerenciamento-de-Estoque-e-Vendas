<?php
include "../View/perfis.php";
if($_POST['endereco']!=''){
$consultar->cadastrar_armazem(endereco:$_POST['endereco'],conexao:$conn);
unset($_POST);
require_once '../Controller/resetter.php';
exit();
}else{
    ?><script>
        alert('Preencha o campo de endereço')
    </script><?php

}
