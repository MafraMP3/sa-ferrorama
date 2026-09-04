<?php

$host = "localhost";
$password = "root";
$user = "root";
$database = "sa_ferrorama";

$conn = new mysqli($host,$password,$user,$database);

if ($conn->connect_error){
    die("Erro de conexão");
}