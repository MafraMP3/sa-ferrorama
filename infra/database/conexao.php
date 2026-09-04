<?php

$host = "localhost";
$password = "root";
$user = "root";
$database = "sa_ferrorama";

$sql = new mysqli($host,$password,$user,$database);

if ($sql->connect_error){
    die("Erro de conexão");
}