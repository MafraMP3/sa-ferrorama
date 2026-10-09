<?php

Session_start();
if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
  header("Location: ../../../index.php");
  exit;
}

include "../../../infra/database/conn.php";

$nomeTrem = $_POST["nomeTrem"];
$rotaTrem = $_POST["idRota"];
$tipoCarga = $_POST["tipoCarga"];
$modeloTrem = $_POST["modeloTrem"];
$usuarioTrem = $_POST["idUsuario"];


if ($nomeTrem == null || $tipoCarga == null || $modeloTrem == null || $rotaTrem == null || $usuarioTrem == null) {
  echo "<script>
          alert('Erro no cadastro de trens, não é permitido campos vazios');
          window.location.href = '../../trens.php'
          </script>";
  die();
}

//Verifica se existe esta Rota e este Usuário:

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

$usuarios = "SELECT * FROM usuarios WHERE idUsuario = ?";
$stmt = $conn->prepare("$usuarios");
$stmt->bind_param("i", $usuarioTrem);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo "<script>
          alert('Erro no cadastro de trens, usuário não encontrado');
          window.location.href = '../../trens.php'
          </script>";
  die();
}

$sql = "INSERT INTO trens (nomeTrem,idRota,tipoCarga,modeloTrem,idUsuario) VALUES (?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissi", $nomeTrem, $rotaTrem, $tipoCarga, $modeloTrem,$usuarioTrem);
$stmt->execute();

header("location: ../../trens.php");

?>