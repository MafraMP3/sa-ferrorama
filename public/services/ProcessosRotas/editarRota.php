<?php
session_start();

if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
    header("Location: ../../../index.php");
    exit;
}

include("../../../infra/database/conn.php");

if (!isset($_POST["idRota"]) || filter_var($_POST["idRota"], FILTER_VALIDATE_INT) === false) {
    header("Location: ../../rotas.php");
    exit;
}

$idRota = $_POST["idRota"];

$sql = "SELECT * FROM rotas WHERE idRota = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idRota);
$stmt->execute();

$resultado = $stmt->get_result();
$rotaEditar = $resultado->fetch_assoc();

if (!$rotaEditar) {
    header("Location: ../../rotas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../styles/style.css">
    <link rel="icon" href="../../../assets/images/icon.png">
    <title>Editar Rota</title>
</head>

<body>
    <main>
        <?php include "../../component/navbar.php"; ?>

        <div class="content">
            <div class="card div-top-sensors">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-route fa-2x" style="color: rgb(255, 49, 49);"></i>
                    <p class="text-cadastrar-novo-sensor h4">EDITANDO ROTA: <?php echo htmlspecialchars($rotaEditar["nomeRota"]); ?></p>
                </div>

                <div id="div-forms-sensors">
                    <form action="atualizarRota.php" method="POST">
                        <div id="div-form-cadastrarsensor" class="d-flex flex-wrap gap-3">
                            <input type="hidden" name="idRota" value="<?php echo $rotaEditar["idRota"]; ?>">

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors">NOME DA ROTA</label>
                                <input class="form-control input-form-sensors" name="nomeRota" type="text" placeholder="EX: Rota Norte" value="<?php echo htmlspecialchars($rotaEditar["nomeRota"]); ?>" maxlength="20" required>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors">DESCRIÇÃO</label>
                                <input class="form-control input-form-sensors" name="descricao" type="text" placeholder="Descreva o trajeto" value="<?php echo htmlspecialchars($rotaEditar["descricao"]); ?>" maxlength="255" required>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors">DISTÂNCIA (KM)</label>
                                <input class="form-control input-form-sensors" name="distancia" type="number" min="1" placeholder="EX: 15" value="<?php echo $rotaEditar["distancia"]; ?>" required>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors">DURAÇÃO (MINUTOS)</label>
                                <input class="form-control input-form-sensors" name="duracao" type="number" min="1" placeholder="EX: 30" value="<?php echo $rotaEditar["duracao"]; ?>" required>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors">DATA DE CRIAÇÃO</label>
                                <input class="form-control input-form-sensors" name="dataCriacao" type="date" value="<?php echo $rotaEditar["dataCriacao"]; ?>" required>
                            </div>

                            <div class="d-flex flex-column">
                                <button class="d-block btn btn-primary button-form-sensors" type="submit">Atualizar</button>
                                <a id="botao-preto-fadecinza" class="btn btn-dark mt-1" href="../../rotas.php">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../java/script.js"></script>
</body>
</html>