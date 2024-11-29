<?php

//armazena todas as consultas possíveis para o programa para fins de simplicidade
class Queries{
    public function consulta($id,$tabela,$coluna,$conexao): mixed {
        return $conexao->query("SELECT $coluna FROM $tabela WHERE `id` = '$id';");
    }
    public function inserir_produto($nome,$descricao,$quantidade,$preco,$armazem,$conexao,$codigo_barras): mixed{
        return $conexao->query("INSERT INTO `produtos`(`nome`,`descricao`,`quantidade`,`preco`,`localizacao`,`codigo_barras`) VALUES('$nome','$descricao','$quantidade','$preco','$armazem','$codigo_barras');");
    }
    public function cadastrar_usuario($nome,$senha,$perfil, $conexao): mixed{
        return $conexao->query("INSERT INTO `usuarios`(`nome`,`senha`,`perfil`) VALUES ('$nome','$senha','$perfil')");
    }
    public function cadastrar_usuario_pendente($nome,$senha,$perfil, $conexao): mixed{
        return $conexao->query("INSERT INTO `usuarios_pendentes`(`nome`,`senha`,`perfil`) VALUES ('$nome','$senha','$perfil')");
    }
    public function cadastrar_armazem($endereco, $conexao): mixed{
        return $conexao->query("INSERT INTO `armazem`(`endereco`) VALUES('$endereco');");
    }
    public function baixa_produto($id,$quantidade_baixada,$conexao): mixed{
        return $conexao->query("UPDATE `produtos`
        SET `quantidade` =`quantidade`-'$quantidade_baixada'
        WHERE `id`='$id';");
    }
    public function subir_produto($id,$quantidade_subida,$conexao): mixed{
        return $conexao->query("UPDATE `produtos`
        SET `quantidade` =`quantidade`+'$quantidade_subida'
        WHERE `id`='$id';");
    }
    public function atualizar_senha($id,$novasenha,$senhaantiga,$conexao): mixed{
        return $conexao->query("UPDATE `usuarios`
        SET `senha` ='$novasenha'
        WHERE `id`='$id' AND `senha`='$senhaantiga';");
    }
    public function atualizar_preco($id,$novopreco,$conexao): mixed{
        return $conexao->query("UPDATE `produtos`
        SET `preco` ='$novopreco'
        WHERE `id`='$id';");
    }
    public function listar_armazens($conexao): mixed{
        return $conexao->query("SELECT * FROM `armazem`;");
    }
    public function lista_produtos_vender($codigobarras, $quantidade_baixada, $conexao){
   // Consulta ao banco
   $resultado = $conexao->query("SELECT * FROM `produtos` WHERE `codigo_barras` = '$codigobarras';");
   // Verifica se encontrou o produto
   if ($resultado && $row = $resultado->fetch_assoc()) {
       // Adiciona o produto à sessão
       array_push($_SESSION['produtosvender'], [
           'codigobarras' => $codigobarras,
           'quantidadebaixada' => $quantidade_baixada,
           'nomeproduto' => $row['nome'],
           'precoproduto' => $row['preco'] * $quantidade_baixada,
       ]);
       $_SESSION['totalvenda']+=$row['preco'] * $quantidade_baixada;
       $tabela_produtos_vender="";
       // Retorna a linha formatada em HTML
       foreach($_SESSION['produtosvender'] as $linha_tabela){ 
        $_SESSION['totalcompra']+=$linha_tabela['precoproduto'];
        $tabela_produtos_vender=$tabela_produtos_vender."
       <tr>
           <td>{$linha_tabela['codigobarras']}</td>
           <td>{$linha_tabela['nomeproduto']}</td>
           <td>{$linha_tabela['quantidadebaixada']}</td>
           <td>{$linha_tabela['precoproduto']}</td>
       </tr>";
       
        }
        return $tabela_produtos_vender;
        
      }
    }
    public function listar_caixa($conexao): mixed {
        $tabela_caixa = "
        <div class='w3-container w3-margin'>
        <p><b>LANÇAMENTOS NO CAIXA</b></p>
        <table class='w3-table w3-striped w3-bordered w3-amber w3-centered w3-hoverable'>
        <th>Data do Lançamento</th>
        <th>Valor</th>
        <th>Produto Lançado</th>";
        
        $consulta_caixa = $conexao->query("SELECT * FROM caixa;");
        while ($row = $consulta_caixa->fetch_assoc()) {
            $tabela_caixa .= "
            <tr>
               <td>{$row['data_lancamento']}</td>
               <td>{$row['valor']}</td>
               <td>{$row['produto_lancado']}</td>
            </tr>";
        }
        
        $tabela_caixa .= "</table></div>"; // Fecha a tabela e div
        return $tabela_caixa;
    }
    
    public function venda_produto($conexao): void {
        // Verifica se existem produtos a vender
        if (!isset($_SESSION['produtosvender']) || empty($_SESSION['produtosvender'])) {
            echo "Nenhum produto para vender.";
            return;
        }
    
        // Processa cada produto no array
        foreach ($_SESSION['produtosvender'] as $produtos_vender) {
            // Atualiza a quantidade do produto no banco de dados
            $query_atualiza_produto = "
                UPDATE `produtos`
                SET `quantidade` = `quantidade` - '".$produtos_vender['quantidadebaixada']."',
                    `quantidade_vendida` = `quantidade_vendida` + '".$produtos_vender['quantidadebaixada']."'
                WHERE `codigo_barras` = '".$produtos_vender['codigobarras']."'
            ";
            $conexao->query($query_atualiza_produto);
    
            // Insere a venda no caixa
            $query_caixa = "
                INSERT INTO `caixa` (`data_lancamento`, `valor`, `produto_lancado`) 
                VALUES ('".date('Y-m-d')."', '".$produtos_vender['precoproduto']."', '".$produtos_vender['codigobarras']."')
            ";
            $conexao->query($query_caixa);
        }
    
        // Limpa os produtos vendidos da sessão
        unset($_SESSION['produtosvender']);
        $_SESSION['totalvenda'] = 0;
    
        echo "Venda realizada com sucesso!";
    }
    
    public function baixa_usuario($id,$conexao): mixed{
        return $conexao->query("DELETE FROM `usuarios`
        WHERE `id`='$id';");
    }
    public function baixa_usuario_pendente($id,$conexao): mixed{
        return $conexao->query("DELETE FROM `usuarios_pendentes`
        WHERE `id`='$id';");
    }
    public function executar_query($conn,$query): array|bool|null{
        $consulta=mysqli_query(mysql: $conn, query: $query);
        $resultado_consulta=mysqli_fetch_assoc(result: $consulta);
        return $resultado_consulta;
    }
    public function tabela_usuarios_pendentes($conexao): void {
        echo "
        <table class='w3-table w3-striped w3-bordered w3-amber w3-centered w3-quarter w3-hoverable w3-margin'>
            <p><b>CADASTROS PENDENTES DE APROVAÇÃO</b></p>
            <th>ID</th>
            <th>NOME</th>
            <th>CÓDIGO PERFIL</th>";
    
        $usuarios = mysqli_query($conexao, "SELECT * FROM `usuarios_pendentes`;");
    
        while ($row = mysqli_fetch_array($usuarios)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['perfil']}</td>
            </tr>
            ";
        }
        
        echo "</table>";
        
        echo "
        <form method='POST' action='../Model/aprovarcadastro.php' class='w3-margin w3-left w3-container w3-padding-48 w3-amber' style='border:3px solid black;border-radius:3px'>
            <input type='number' name='id' placeholder='ID'>
            <button type='submit'>Aprovar Cadastro</button>
        </form>
        
        <form method='POST' action='../Model/reprovarcadastro.php' class='w3-margin w3-left w3-container w3-padding-48 w3-amber' style='border:3px solid black; border-radius:3px'>
            <input type='number' name='id' placeholder='ID'>
            <button type='submit'>Reprovar Cadastro</button>
        </form>";
    }
    public function tabela_usuarios($conexao): void{
        echo "
        <table class='w3-table w3-striped w3-bordered w3-amber w3-centered w3-quarter w3-hoverable w3-margin'>
        <p><b>USUÁRIOS CADASTRADOS</b></p>
            <th>ID</th>
            <th>NOME</th>
            <th>CÓDIGO PERFIL</th>";
    
        $usuarios = mysqli_query($conexao, "SELECT * FROM `usuarios`;");
    
        while ($row = mysqli_fetch_array($usuarios)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['perfil']}</td>
            </tr>";
        }
        
        echo "</table>";  
    }
    public function tabela_armazem($conexao): void{
        echo "
        
        <table class='w3-table w3-striped w3-bordered w3-amber w3-centered w3-quarter w3-hoverable w3-margin'>
        <p><b>ARMAZÉNS CADASTRADOS</b></p>
            <th><b>ID</b></th>
            <th><b>ENDEREÇO</b></th>";
        $armazens = $this->listar_armazens($conexao);
        while ($row = mysqli_fetch_array($armazens)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['endereco']}</td>
            </tr>";}echo"</table>";
    }
    public function tabela_produtos($conexao): void{
        echo "
        <table class='w3-table w3-striped w3-bordered w3-amber w3-centered w3-quarter w3-hoverable w3-margin'>
        <p><b>RELATÓRIO PRODUTOS</b></p>
            <th>ID</th>
            <th>NOME</th>
            <th>DESCRIÇÃO</th>
            <th>CÓDIGO DE BARRAS</th>
            <th>QUANTIDADE ATUAL</th>
            <th>QUANTIDADE VENDIDA</th>
            <th>PREÇO</th>
            <th>ID ARMAZÉM</th>";
    
        $usuarios = mysqli_query($conexao, "SELECT * FROM `produtos`;");
    
        while ($row = mysqli_fetch_array($usuarios)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['descricao']}</td>
                <td>{$row['codigo_barras']}</td>
                <td>{$row['quantidade']}</td>
                <td>{$row['quantidade_vendida']}</td>
                <td>{$row['preco']}</td>
                <td>{$row['localizacao']}</td>
            </tr>";
        }
        
        echo "</table>";  
    }
    public function sair(): void{
        echo "
        <span class='w3-margin'>
        <form action='../Controller/sair.php' method='post'>
        <button type='submit'>Sair</button>
        </form>
        </span>
        ";
    }
    
}