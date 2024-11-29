
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Início</title>
    </head>
    
    <body>
    <?php 
include_once "header.php";
?>
        <div class="w3-container">
        <section class="class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin'">
            <div id="login">
                
            <h1>Login</h1>
                <form method="POST" action="../Controller/auth.php">
                    <label>ID:</label>
                    <input type="id" name="id" placeholder="00000" required autofocus>
                    <label>Senha:</label>
                    <input type="password" name="senha" placeholder="*******" required>
                    <button type="submit">Login</button>
                    </form>
            </div>
            </section>

            <section class="class='w3-container w3-center w3-centered w3-amber w3-padding w3-margin' w3-panel">
            <div id="cadastro">
            <h1>Cadastro</h1>
                <form method="POST" action="../Model/cadastro.php">
                    <label>Nome:</label>
                    <input type="name" name="nome" placeholder="Seu Nome Aqui" required autofocus>
                    <label>Senha:</label>
                    <input type="password" name="senha" placeholder="*******" required>
                    <label>Perfil Solicitado:</label>
                    <select name="perfis" id="perfis">     
                        <option value='gerente'>Gerente</option>
                        <option value='estoquista'>Estoquista</option>
                        <option value='vendedor'>Vendedor</option>
                    </select>
                    <button type="submit">Cadastrar</button>
                    </form>
            </div>
            </section>
            </div>
            <?php
            //Erro de login
            if (isset($_SESSION['loginErro'])){
                echo "
                <p>".$_SESSION['loginErro']."</p>s";
                unset($_SESSION['loginErro']);

            } 
            ?>
            <?php 
			//Deslogado com sucesso.
            if(isset($_SESSION['logindeslogado'])){
                echo "<p>".$_SESSION['logindeslogado']."</p>";
                unset($_SESSION['logindeslogado']);
            }
            ?>



       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>