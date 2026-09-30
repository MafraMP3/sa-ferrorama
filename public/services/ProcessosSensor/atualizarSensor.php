<?php

include "../../../infra/database/conn.php";

$idSensor = $_POST["idSensor"];
$nome = $_POST["nome"];
$localizacao = $_POST["localizacao"];
$tipo = $_POST["tipo"];
$dataInstalacao = $_POST["dataInstalacao"];
$idTrem = $_POST["idTrem"];

if (
    $idSensor == null ||
    $nome == null ||
    $localizacao == null ||
    $tipo == null ||
    $dataInstalacao == null ||
    $idTrem == null
) {
    header("Location: ../../../../public/sensores.php");
    exit;
}

$sql = "UPDATE sensores
        SET nome = ?, localizacao = ?, tipo = ?, dataInstalacao = ?, idTrem = ?
        WHERE idSensor = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssii",
    $nome,
    $localizacao,
    $tipo,
    $dataInstalacao,
    $idTrem,
    $idSensor
);

$stmt->execute();

header("Location: ../../sensores.php");
exit;