<?php

include "../../../infra/database/conn.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];

if (strlen($cpf) < 11) {
   echo "<script>
          alert('Erro no cadastro de usuarios, não é permitido cpf menor que 11 digitos');
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

  if ($nome == null || $email == null || $senha == null || $cpf == null || $funcao == null){
    echo "<script>
          alert('Erro no cadastro de usuarios, não é permitido campos vazios');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
  }

$sql = "INSERT INTO usuarios (nome,email,senha,cpf,funcao) VALUES (?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nome,$email,$senha,$cpf,$funcao);
$stmt->execute();

header("location: ../../usuarios.php");