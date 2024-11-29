<?php
require_once '../Model/conectdb.php';
require_once '../View/perfis.php';
if($_POST['id']!=''){
$id=$_POST['id'];
$nome=$consultar->consulta($id,'usuarios_pendentes','nome',$conn);
$nome=mysqli_fetch_assoc($nome);
$nome=$nome['nome'];

$senha=$consultar->consulta($id,'usuarios_pendentes','senha',$conn);
$senha=mysqli_fetch_assoc($senha);
$senha=$senha['senha'];

$perfil=$consultar->consulta($id,'usuarios_pendentes','perfil',$conn);
$perfil=mysqli_fetch_assoc($perfil);
$perfil=$perfil['perfil'];
switch($perfil){
    case '1':
        $perfil=1; break;
    case '2':
        $perfil=2; break;
    case '3':
        $perfil=3; break;
    case '4':
        $perfil=4; break;
    case '5':
        $perfil=5; break;
};

$consultar->baixa_usuario_pendente($id,$conn);
$consultar->cadastrar_usuario($nome,$senha,$perfil,$conn);
require_once '../Controller/resetter.php';
exit();
} else{
    ?><script>
        alert('Preencha o campo de ID')
    </script><?php
}