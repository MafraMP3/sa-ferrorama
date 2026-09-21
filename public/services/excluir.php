<?php 

include "../../infra/database/conn.php";



$tabela = $_POST["tabela"];
$campoId = $_POST["campoId"];
$idExcluir = $_POST["idExcluir"];

if (!$idExcluir || !$tabela) {
    die("Dados inválidos.");
}

  $sql = "DELETE FROM $tabela WHERE $campoId = ?";

  $stmt = $conn -> prepare($sql);
  $stmt->bind_param("i", $idExcluir);
  $stmt->execute();

  header("location: " . $_SERVER["HTTP_REFERER"]);

?>