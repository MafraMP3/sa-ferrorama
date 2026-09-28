<?php

include "../../../infra/database/conn.php";

$idTrem = $_POST["idTrem"];
$nomeTrem = $_POST["nomeTrem"];
$rotaTrem = $_POST["idRota"];
$tipoCarga = $_POST["tipoCarga"];
$modeloTrem = $_POST["modeloTrem"];

if ($idTrem == null || $nomeTrem == null || $tipoCarga == null || $modeloTrem == null ||$rotaTrem == null
) {
    echo "<script>
        alert('Erro na atualização do trem, não é permitido campos vazios');
        window.location.href = '../../trens.php';
    </script>";
    die();
}

$sql = "UPDATE trens SET nomeTrem = ?, idRota = ?, tipoCarga = ?, modeloTrem = ? WHERE idTrem = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sissi",$nomeTrem,$rotaTrem,$tipoCarga,$modeloTrem,$idTrem);

$stmt->execute();

header("Location: ../../trens.php");
exit;