<?php
require_once '../Model/conectdb.php';
require_once '../View/perfis.php';
if(isset($_POST['id'])){
$id=$_POST['id'];

$consultar->baixa_usuario_pendente($id,$conn);
require_once '../Controller/resetter.php';
exit();
}else{
    ?><script>
        alert('Preencha o campo de ID')
    </script><?php
}
