<?php 
  
  include "../../../infra/database/conn.php";

  $nomeSensor = $_POST["nomeSensor"];
  $localizacao = $_POST["localSensor"];
  $tipo = $_POST["tipoSensor"];
  $dataInstalacao = $_POST["dataInstalacao"];
  $idTrem = $_POST["idTrem"];

  if ($nomeSensor == null || $localizacao == null || $tipo == null || $dataInstalacao == null || $idTrem == null){
    echo "<script>
          alert('Erro no cadastro de sensores, não é permitido campos vazios');
          window.location.href = '../../sensores.php'
          </script>";
    die();
  }

  $sql = "INSERT INTO sensores (nome,localizacao,tipo,dataInstalacao,idTrem) VALUES (?,?,?,?,?)";

  $stmt = $conn -> prepare($sql);
  $stmt->bind_param("ssssi", $nomeSensor, $localizacao, $tipo, $dataInstalacao, $idTrem);
  $stmt->execute();

  header("location: ../../sensores.php");

?>
