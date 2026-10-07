<?php

Session_start();
if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../../../index.php");
  exit;
}

include "../../../infra/database/conn.php";

$nomeTrem = $_POST["nomeTrem"];
$rotaTrem = $_POST["idRota"];
$tipoCarga = $_POST["tipoCarga"];
$modeloTrem = $_POST["modeloTrem"];


if ($nomeTrem == null || $tipoCarga == null || $modeloTrem == null || $rotaTrem == null) {
  echo "<script>
          alert('Erro no cadastro de trens, não é permitido campos vazios');
          window.location.href = '../../trens.php'
          </script>";
  die();
}

$rotas = "SELECT * FROM rotas WHERE idRota = ?";
$stmt = $conn->prepare("$rotas");
$stmt->bind_param("i", $rotaTrem);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo "<script>
          alert('Erro no cadastro de trens, rota não encontrada');
          window.location.href = '../../trens.php'
          </script>";
  die();
}

$sql = "INSERT INTO trens (nomeTrem,idRota,tipoCarga,modeloTrem) VALUES (?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $nomeTrem, $rotaTrem, $tipoCarga, $modeloTrem);
$stmt->execute();

header("location: ../../trens.php");

?>