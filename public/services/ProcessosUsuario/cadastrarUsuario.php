<?php

include "../../../infra/database/conn.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];

$sql = "INSERT INTO usuarios (nome,email,senha,cpf,funcao) VALUES (?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nome,$email,$senha,$cpf,$funcao);
$stmt->execute();

header("location: ../../usuarios.php");