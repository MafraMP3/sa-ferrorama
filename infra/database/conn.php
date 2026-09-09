<?php

$host = "localhost";
$password = "";
$user = "root";
$database = "sa_ferrorama";

$conn = new mysqli($host,$user,$password,$database, 6608);

if ($conn->connect_error){
    die("Erro de conexão");
}