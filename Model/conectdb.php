<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "gerencial";    
    //Criar a conexao
    $conn = mysqli_connect(hostname: $servidor, username: $usuario, password: $senha, database: $dbname);
    
    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    };