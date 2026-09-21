<?php

$host = "localhost";
$password = "";
$user = "root";
$database = "sa_ferrorama";

$conn = new mysqli($host,$user,$password,$database, 6608);

if ($conn->connect_error){
    die("Erro de conexão");
}


if (!$conn->set_charset("utf8mb4")) {
    printf("Erro ao carregar utf8mb4: %s\n", $conn->error);
}