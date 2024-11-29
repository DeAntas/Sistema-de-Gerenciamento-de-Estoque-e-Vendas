<?php
foreach($_SESSION as $sessao){
    unset($sessao);
}
foreach($_POST as $post){
    unset($post);
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sucesso!</title>
    </head>
<div class="aviso"></div>
    <div class="container">
        <div class="conteudo">
            <form action="../View/perfis.php" method="post">
                <h1>Sucesso!</h1>
            <button type="submit"><h1>Ok!</h1></button>
            </form>
        </div>
    </div>
<style>
    .aviso{
        opacity:    0.5; 
        background: #000; 
        width:      100%;
        height:     100%; 
        z-index:    10;
        top:        0; 
        left:       0; 
        position:   fixed; 
        margin: 0 auto;
        z-index: 0;
    }
    .container{
        background-color: orange;
        width: 70%;
        height: 70%;
        opacity: 1;
        display: flex;
        align-content: center;
        justify-content: center;
        z-index: 2;
        border-radius:4px;  
        border-style: solid;
        border: 2px;    
        border-radius:4px;  
        border-style: solid;
        border-width: 3px;
        border-color:black;

    }
    .conteudo{
        background-color: orange;
        position: fixed;
        top:30%;
        left:40%;
        z-index: 3;
        padding: 5%;
        border-radius: 4px;
        border-radius:4px;  
        border-style: solid;
        border: 2px;    
        border-radius:4px;  
        border-style: solid;
        border-width: 3px;
        border-color:black;

    }
    h1{
        font-size: 28;
    }
    
    button{
        background-color: rgb(25, 170, 40);
        color:white;
        font-weight: 900;
        border-radius:4px;  
        border-style: solid;
        border: 2px;    
        border-radius:4px;  
        border-style: solid;
        border-width: 3px;
        border-color:black;
        }
        section{
        border-radius:4px;  
        border-style: solid;
        border-width: 3px;
        border-color:black;
    }
</style>