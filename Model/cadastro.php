<?php
require_once '../Model/conectdb.php';
require_once '../View/perfis.php';
if(isset($_POST['senha'],$_POST['perfis'],$_POST['nome'])){
$senha=$_POST['senha'];
$perfil=$_POST['perfis'];
$nome=$_POST['nome'];
switch($perfil){
    case 'gerente':
        $perfil=1; break;
    case 'estoquista':
        $perfil=2; break;
    case 'vendedor':
        $perfil=3; break;
};
$consultar->cadastrar_usuario_pendente($nome,$senha,$perfil,$conn);
header('Location: ../View/pendente.php');
exit();} 
else{
    ?><script>
        alert('Preencha todos os campos')
    </script><?php
}