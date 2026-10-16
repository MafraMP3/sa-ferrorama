<?php
session_start();

if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
    header("Location: ../../../index.php");
    exit;
}

include("../../../infra/database/conn.php");

$sql = "SELECT * FROM trens";
$resultado = $conn->query($sql);
$trens = $resultado;

if (isset($_POST["idSensor"]) && filter_var($_POST["idSensor"], FILTER_VALIDATE_INT) !== false) {

    $idSensor = $_POST["idSensor"];

    $sql = "SELECT * FROM sensores WHERE idSensor = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idSensor);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $sensorEditar = $resultado->fetch_assoc();

    $sql = "SELECT nomeTrem FROM trens WHERE idTrem = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sensorEditar["idTrem"]);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $tremEditar = $resultado->fetch_assoc();

    $nomeTrem = $tremEditar["nomeTrem"];
}
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

    <title>Sensores</title>
</head>

<body>

    <main>

        <?php include "../../component/navbar.php"; ?>

        <div class="content">
            <div class="card div-top">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-satellite-dish fa-2x" style="color: rgb(255, 49, 49);"></i>
                    <p class="title-text-form h4">EDITANDO SENSOR: <?php echo htmlspecialchars($sensorEditar["nome"]); ?></p>
                </div>

                <div class="div-forms">
                    <form action="atualizarSensor.php" method="POST">
                        <div class="div-form-cadastrar d-flex">
                            <input type="hidden" name="idSensor" value="<?php echo $sensorEditar["idSensor"]; ?>">

                            <div class="div-inputs-label">
                                <label class="d-block label-form" for="nome">NOME DO SENSOR</label>
                                <input class="form-control input-form-sensors" value="<?php echo htmlspecialchars($sensorEditar["nome"]); ?>" name="nome" id="nome" type="text" placeholder="EX: Sensor de Temperatura" required>
                            </div>

                            <div class="div-inputs-label">
                                <label class="d-block label-form" for="localizacao">LOCALIZAÇÃO</label>
                                <input class="form-control input-form-sensors" value="<?php echo htmlspecialchars($sensorEditar["localizacao"]); ?>" name="localizacao" id="localizacao" type="text" placeholder="EX: Estação Quiriri" required>
                            </div>

                            <div class="div-inputs-label">
                                <label class="d-block label-form" for="tipo">TIPO DE DADO</label>
                                <select class="form-select input-form-sensors-select" name="tipo" id="tipo" required>
                                    <?php
                                    $tipos = ["Temperatura", "Velocidade", "Vibração", "Umidade"];
                                    foreach ($tipos as $tipo) {
                                    ?>
                                        <option value="<?php echo htmlspecialchars($tipo); ?>" <?php echo $tipo == $sensorEditar["tipo"] ? "selected" : ""; ?>>
                                            <?php echo htmlspecialchars($tipo); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div-inputs-label">
                                <label class="d-block label-form" for="dataInstalacao">DATA DE INSTALAÇÃO</label>
                                <input class="form-control input-form-sensors" value="<?php echo htmlspecialchars($sensorEditar["dataInstalacao"]); ?>" name="dataInstalacao" id="dataInstalacao" type="date" required>
                            </div>

                            <div class="div-inputs-label">
                                <label class="d-block label-form" for="idTrem">TREM</label>
                                <select class="form-select input-form-sensors-select" name="idTrem" id="idTrem" required>
                                    <option value="<?php echo $sensorEditar["idTrem"]; ?>" selected>
                                        <?php echo htmlspecialchars($nomeTrem); ?>
                                    </option>
                                    <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                                        <?php if ($trem["idTrem"] != $sensorEditar["idTrem"]) { ?>
                                            <option value="<?php echo $trem["idTrem"]; ?>">
                                                <?php echo htmlspecialchars($trem["nomeTrem"]); ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="div-button d-flex flex-column">
                                <button class="btn btn-primary button-form" type="submit">Atualizar</button>
                                <a id="botao-preto-fadecinza" class="btn btn-dark mt-1" href="../../sensores.php">Voltar</a>
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