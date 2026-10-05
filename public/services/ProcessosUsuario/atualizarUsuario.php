<?php

include "../../../infra/database/conn.php";

$idUsuario = $_POST["idUsuario"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];


if (
    $idUsuario == null ||
    $nome == null ||
    $email == null ||
    $cpf == null ||
    $funcao == null
) {
    echo "<script>
        alert('Erro na atualização do usuário, não é permitido campos vazios');
        window.location.href = '../../usuarios.php';
    </script>";
    die();
}


$sql = "UPDATE usuarios 
        SET nome = ?, email = ?, cpf = ?, funcao = ?
        WHERE idUsuario = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssi",
    $nome,
    $email,
    $cpf,
    $funcao,
    $idUsuario
);

$stmt->execute();

header("Location: ../../usuarios.php");
exit;

?>