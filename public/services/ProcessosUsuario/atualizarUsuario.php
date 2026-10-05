<?php

include "../../../infra/database/conn.php";

$idUsuario = $_POST["idUsuario"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];

if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) == 11) {
        $cpf = preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $cpf
        );
    } else {
        echo "<script>
            alert('CPF inválido');
            window.location.href = '../../usuarios.php';
        </script>";
        die();
    }
}

if (strlen($cpf) < 11) {
   echo "<script>
          alert('Erro no cadastro de usuarios, não é permitido cpf menor que 11 digitos');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
}

$funcao = $_POST["funcao"];

if ($nome == null || $email == null || $senha == null || $cpf == null || $funcao == null) {
    echo "<script>
          alert('Erro no cadastro de usuarios, não é permitido campos vazios');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
}

if (strlen($nome) < 3) {
    echo "<script>
          alert('Erro no cadastro de usuarios, insira um nome valido');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
          alert('Erro no cadastro de usuarios, insira um email valido');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
}

$sql = "UPDATE usuarios 
        SET nome = ?, email = ?, senha = ?, cpf = ?, funcao = ?
        WHERE idUsuario = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssi",
    $nome,
    $email,
    $senha,
    $cpf,
    $funcao,
    $idUsuario
);

$stmt->execute();

header("Location: ../../usuarios.php");
exit;
