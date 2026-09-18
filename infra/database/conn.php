<?php

$host = "localhost";
$password = "";
$user = "root";
$database = "sa_ferrorama";

$conn = new mysqli($host,$user,$password,$database, 6608);

if ($conn->connect_error){
    die("Erro de conexão");
}


// ⚠️ FALTA: sem $conn->set_charset("utf8mb4"), acentos podem sair
//    errados ("informaÃ§Ã£o") dependendo da configuração do servidor.