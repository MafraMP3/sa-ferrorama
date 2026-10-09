<?php

session_start();

if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
    header("Location: ../../../index.php");
    exit;
}

include "../../../infra/database/conn.php";

$nomeRota = $_POST["nomeRota"];
$descricao = $_POST["descricao"];
$distancia = $_POST["distancia"];
$duracao = $_POST["duracao"];
$dataCriacao = $_POST["dataCriacao"];

if (
    empty($nomeRota) ||
    empty($descricao) ||
    $distancia === "" ||
    $duracao === "" ||
    empty($dataCriacao)
) {
    echo "<script>
        alert('Erro no cadastro de rotas, não é permitido campos vazios');
        window.location.href = '../../rotas.php';
    </script>";
    die();
}

$sql = "INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiis", $nomeRota, $descricao, $distancia, $duracao, $dataCriacao);
$stmt->execute();

header("Location: ../../rotas.php");
exit;

?>