<?php

Session_start();
if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
  header("Location: ../../../index.php");
  exit;
}

include "../../../infra/database/conn.php";

$nomeTrem = $_POST["nomeTrem"]  ?? null;
$rotaTrem = $_POST["idRota"]  ?? null;
$tipoCarga = $_POST["tipoCarga"]  ?? null;
$modeloTrem = $_POST["modeloTrem"]  ?? null;
$usuarioTrem = $_POST["idUsuario"]  ?? null;


if (empty($nomeTrem) || empty($tipoCarga) || empty($modeloTrem) || empty($idRota) || empty($idUsuario)) {
    $_SESSION['erro_trem'] = "Não é possível enviar com campos vazios.";
    header("Location: ../../trens.php");
    exit;
}


$tiposPermitidos = [
  "Passageiros",
  "Grãos",
  "Minério",
  "Carvão",
  "Combustível",
  "Produtos Químicos"
  ];

if (!in_array($tipoCarga, $tiposPermitidos, true)) {
    echo "<script>
          alert('Erro no cadastro de trens, não é permitido valores inválidos');
          window.location.href = '../../trens.php'
          </script>";
  die();
}

$modelosPermitidos = [
  "Diesel",
  "Elétrico",
  "Diesel-Elétrico",
  "Híbrido"
];

if (!in_array($modeloTrem, $modelosPermitidos, true)) {
      echo "<script>
          alert('Erro no cadastro de trens, não é permitido valores inválidos');
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