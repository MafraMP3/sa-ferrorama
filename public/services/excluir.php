<?php

include "../../infra/database/conn.php";

$tabela = $_POST["tabela"];
$campoId = $_POST["campoId"];
$idExcluir = $_POST["idExcluir"];

$permitidas = [
    "rotas" => "idRota",
    "trens" => "idTrem",
    "sensores" => "idSensor",
    "usuarios" => "idUsuario"
];

if (!$idExcluir || !$tabela) {
    die("Dados inválidos.");
}

if (!isset($permitidas[$tabela]) || $permitidas[$tabela] !== $campoId) {
    die("Operação inválida.");
}

$sql = "DELETE FROM $tabela WHERE $campoId = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idExcluir);

try {

    $stmt->execute();

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;

} catch (mysqli_sql_exception $e) {

    if ($e->getCode() == 1451) {
        header("Location: ../erro.php?tipo=dependencia&tabela=$tabela");
        exit;
    }

    header("Location: ../erro.php?tipo=desconhecido");
    exit;
}