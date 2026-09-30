<?php

include "../../../infra/database/conn.php";

if (
    !isset($_POST["idRota"]) ||
    !filter_var($_POST["idRota"], FILTER_VALIDATE_INT)
) {
    header("Location: ../../rotas.php");
    exit;
}

$idRota = $_POST["idRota"];
$nomeRota = $_POST["nomeRota"];
$origem = $_POST["origem"];
$destino = $_POST["destino"];

if (
    $nomeRota == null ||
    $origem == null ||
    $destino == null
) {
    header("Location: ../../rotas.php");
    exit;
}

$sql = "UPDATE rotas
        SET nomeRota = ?, origem = ?, destino = ?
        WHERE idRota = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssi",
    $nomeRota,
    $origem,
    $destino,
    $idRota
);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../../rotas.php");
exit;
