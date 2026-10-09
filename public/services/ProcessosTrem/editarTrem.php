<?php
session_start();

if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
    header("Location: ../../../index.php");
    exit;
}

include("../../../infra/database/conn.php");

if (!isset($_POST["idTrem"]) || filter_var($_POST["idTrem"], FILTER_VALIDATE_INT) === false) {
    header("Location: ../../trens.php");
    exit;
}

$idTrem = $_POST["idTrem"];

$sql = "SELECT * FROM trens WHERE idTrem = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idTrem);
$stmt->execute();
$resultado = $stmt->get_result();
$tremEditar = $resultado->fetch_assoc();
$stmt->close();

if (!$tremEditar) {
    header("Location: ../../trens.php");
    exit;
}

$rotas = $conn->query("SELECT idRota, nomeRota FROM rotas");
$usuarios = $conn->query("SELECT idUsuario, nome FROM usuarios");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../styles/style.css">
    <link rel="icon" href="../../../assets/images/icon.png">
    <title>Editar Trem</title>
</head>
<body>
    <main>
        <?php include "../../component/navbar.php"; ?>

        <div class="content">
            <div class="card div-top-sensors">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-train fa-2x" style="color: rgb(255, 49, 49);"></i>
                    <p class="text-cadastrar-novo-sensor h4">
                        EDITANDO TREM: <?= htmlspecialchars($tremEditar["nomeTrem"]) ?>
                    </p>
                </div>

                <div id="div-forms-sensors">
                    <form action="atualizarTrem.php" method="POST">
                        <div id="div-form-cadastrarsensor" class="d-flex">
                            <input type="hidden" name="idTrem" value="<?= $tremEditar["idTrem"] ?>">

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors" for="nomeTrem">NOME DO TREM</label>
                                <input class="form-control input-form-sensors" value="<?= htmlspecialchars($tremEditar["nomeTrem"]) ?>" name="nomeTrem" type="text" placeholder="EX: Trem 2" id="nomeTrem" maxlength="40" required>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="label-form-sensors" for="idRota">ROTA</label>
                                <select class="form-select input-form-sensors-select" name="idRota" id="idRota" required>
                                    <?php while ($rota = $rotas->fetch_assoc()) { ?>
                                        <option value="<?= $rota["idRota"] ?>" <?= $rota["idRota"] == $tremEditar["idRota"] ? "selected" : "" ?>>
                                            <?= htmlspecialchars($rota["nomeRota"]) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="label-form-sensors" for="tipoCarga">TIPO DE CARGA</label>
                                <select class="form-select input-form-sensors-select" name="tipoCarga" id="tipoCarga" required>
                                    <?php
                                    $tiposCarga = ["Carga", "Passageiros", "Grãos", "Minério", "Carvão", "Combustível", "Produtos Químicos"];
                                    foreach ($tiposCarga as $tipo) {
                                    ?>
                                        <option value="<?= htmlspecialchars($tipo) ?>" <?= $tipo == $tremEditar["tipoCarga"] ? "selected" : "" ?>>
                                            <?= htmlspecialchars($tipo) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="label-form-sensors" for="modeloTrem">MODELO DO TREM</label>
                                <select class="form-select input-form-sensors-select" name="modeloTrem" id="modeloTrem" required>
                                    <?php
                                    $modelos = ["Diesel", "Elétrico", "Diesel-Elétrico", "Híbrido"];
                                    foreach ($modelos as $modelo) {
                                    ?>
                                        <option value="<?= htmlspecialchars($modelo) ?>" <?= $modelo == $tremEditar["modeloTrem"] ? "selected" : "" ?>>
                                            <?= htmlspecialchars($modelo) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="label-form-sensors" for="idUsuario">USUÁRIO RESPONSÁVEL</label>
                                <select class="form-select input-form-sensors-select" name="idUsuario" id="idUsuario" required>
                                    <?php while ($usuario = $usuarios->fetch_assoc()) { ?>
                                        <option value="<?= $usuario["idUsuario"] ?>" <?= $usuario["idUsuario"] == $tremEditar["idUsuario"] ? "selected" : "" ?>>
                                            <?= htmlspecialchars($usuario["nome"]) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="d-flex flex-column">
                                <button class="d-block btn btn-primary button-form-sensors" type="submit">Atualizar</button>
                                <a id="botao-preto-fadecinza" class="btn btn-dark mt-1" href="../../trens.php">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../java/script.js"></script>
</body>
</html>