<?php 
  
  include "../../../infra/database/conn.php";

  $nomeRota = $_POST["nomeRota"];
  $origemRota = $_POST["origemRota"];
  $destinoRota = $_POST["destinoRota"];

  if ($nomeRota == null || $origemRota == null || $destinoRota == null){
    echo "<script>
          alert('Erro no cadastro de rotas, não é permitido campos vazios');
          window.location.href = '../../rotas.php'
          </script>";
    die();
  }

  $sql = "INSERT INTO rotas (nomeRota,origem,destino) VALUES (?,?,?)";

  $stmt = $conn -> prepare($sql);
  $stmt->bind_param("sss", $nomeRota, $origemRota, $destinoRota);
  $stmt->execute();

  header("location: ../../rotas.php");

?>
