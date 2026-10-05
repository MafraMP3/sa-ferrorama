<?php

include "../../../infra/database/conn.php";

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

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

  if ($nome == null || $email == null || $senha == null || $cpf == null || $funcao == null){
    echo "<script>
          alert('Erro no cadastro de usuarios, não é permitido campos vazios');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
  }

if ($conn->query("SELECT * FROM usuarios WHERE email = '$email' OR cpf = '$cpf'")->num_rows > 0) {
    echo "<script>
          alert('Erro no cadastro de usuarios, o email ou CPF informado já está cadastrado');
          window.location.href = '../../usuarios.php'
          </script>";
    die();
}

$sql = "INSERT INTO usuarios (nome, email, senha, cpf, funcao) VALUES (?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nome,$email,$senhaHash,$cpf,$funcao);
$stmt->execute();


header("location: ../../usuarios.php");

