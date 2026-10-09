<?php

include "../../../infra/database/conn.php";

if (!isset($_POST["idRota"]) || filter_var($_POST["idRota"], FILTER_VALIDATE_INT) === false) {
    header("Location: ../../rotas.php");
    exit;
}

$idRota = $_POST["idRota"];
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
    empty($dataCriacao) ||
    !filter_var($distancia, FILTER_VALIDATE_INT) ||
    !filter_var($duracao, FILTER_VALIDATE_INT) ||
    $distancia <= 0 ||
    $duracao <= 0
) {
    echo "<script>
        alert('Erro na atualização da rota. Verifique os campos preenchidos.');
        window.location.href = '../../rotas.php';
    </script>";
    exit;
}

$sql = "UPDATE rotas
        SET nomeRota = ?, descricao = ?, distancia = ?, duracao = ?, dataCriacao = ?
        WHERE idRota = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiisi", $nomeRota, $descricao, $distancia, $duracao, $dataCriacao, $idRota);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../../rotas.php");
exit;
?>