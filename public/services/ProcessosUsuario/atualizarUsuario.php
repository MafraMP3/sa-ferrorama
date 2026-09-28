<?php

include "../../../infra/database/conn.php";

$idUsuario = $_POST["idUsuario"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];


if (
    $idUsuario == null ||
    $nome == null ||
    $email == null ||
    $senha == null ||
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
        SET nome = ?, email = ?, senha = ?, cpf = ?, funcao = ?
        WHERE idUsuario = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssi",
    $nome,
    $email,
    $senha,
    $cpf,
    $funcao,
    $idUsuario
);

$stmt->execute();

header("Location: ../../usuarios.php");
exit;

?>