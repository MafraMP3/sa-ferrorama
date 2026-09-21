<?php 
  
  include "../../../infra/database/conn.php";

  $nomeTrem = $_POST["nomeTrem"];
  $tipoCarga = $_POST["tipoCarga"];
  $modeloTrem = $_POST["modeloTrem"];
  $rotaTrem = $_POST["idRota"];
  
  if ($nomeTrem == null || $tipoCarga == null || $modeloTrem == null || $rotaTrem == null){
    echo "<script>
          alert('Erro no cadastro de trens, não é permitido campos vazios');
          window.location.href = '../../trens.php'
          </script>";
    die();
  }

  $sql = "INSERT INTO trens (nomeTrem,tipoCarga,modeloTrem,idRota) VALUES (?,?,?,?)";

  $stmt = $conn -> prepare($sql);
  $stmt->bind_param("sss", $nomeTrem, $tipoCarga, $modeloTrem);
  $stmt->execute();

  header("location: ../../trens.php");

?>
