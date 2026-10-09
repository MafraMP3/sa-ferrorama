<?php

include "../../../infra/database/conn.php";

if (
    !isset($_POST["idTrem"], $_POST["nomeTrem"], $_POST["idRota"], $_POST["tipoCarga"], $_POST["modeloTrem"], $_POST["idUsuario"]) ||
    filter_var($_POST["idTrem"], FILTER_VALIDATE_INT) === false ||
    filter_var($_POST["idRota"], FILTER_VALIDATE_INT) === false ||
    filter_var($_POST["idUsuario"], FILTER_VALIDATE_INT) === false ||
    trim($_POST["nomeTrem"]) === "" ||
    trim($_POST["tipoCarga"]) === "" ||
    trim($_POST["modeloTrem"]) === ""
) {
    echo "<script>
        alert('Erro na atualização do trem. Verifique os campos preenchidos.');
        window.location.href = '../../trens.php';
    </script>";
    exit;
}

$idTrem = (int) $_POST["idTrem"];
$nomeTrem = trim($_POST["nomeTrem"]);
$idRota = (int) $_POST["idRota"];
$tipoCarga = trim($_POST["tipoCarga"]);
$modeloTrem = trim($_POST["modeloTrem"]);
$idUsuario = (int) $_POST["idUsuario"];

$sql = "UPDATE trens SET nomeTrem = ?, idRota = ?, tipoCarga = ?, modeloTrem = ?, idUsuario = ? WHERE idTrem = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissii", $nomeTrem, $idRota, $tipoCarga, $modeloTrem, $idUsuario, $idTrem);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../../trens.php");
    exit;
}

$stmt->close();
$conn->close();

echo "<script>
    alert('Erro ao atualizar o trem.');
    window.location.href = '../../trens.php';
</script>";
exit;
?>