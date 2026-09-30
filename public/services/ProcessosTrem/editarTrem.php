<?php
Session_start();
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../../../index.php");
    exit;
}

include("../../../infra/database/conn.php");


$sql = "SELECT * FROM rotas";
$resultado = $conn->query($sql);
$rotas = $resultado;


if (isset($_POST["idTrem"]) && filter_var($_POST["idTrem"], FILTER_VALIDATE_INT) !== false) {

    $idTrem = $_POST["idTrem"];

    $sql = "SELECT * FROM trens WHERE idTrem = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idTrem);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $tremEditar = $resultado->fetch_assoc();


    // seleciona os dados de rota para uma varivel (O nome)

    $sql = "SELECT nomeRota FROM rotas WHERE idRota = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tremEditar["idRota"]);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $rotaEditar = $resultado->fetch_assoc();

    $nomeRota = $rotaEditar["nomeRota"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../styles/style.css">
    <link rel="icon" href="../../../assets/images/icon.png">
    <title>Sensores</title>
</head>

<body>
    <main>


        <?php
        include "../../component/navbar.php";
        ?>


        <div class="content">

            <div class="card div-top-sensors">

                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-train fa-2x" style="color: rgb(255, 49, 49);"></i>
                    <p class="text-cadastrar-novo-sensor h4">
                        EDITANDO TREM: <?php echo $tremEditar["nomeTrem"] ?>
                    </p>
                </div>

                <div id="div-forms-sensors">
                    <form action="atualizarTrem.php" method="POST">
                        <div id="div-form-cadastrarsensor" class="d-flex">

                            <input type="hidden" name="idTrem" value="<?php echo $tremEditar["idTrem"]; ?>">

                            <div class="div-inputs-label-sensors">
                                <label class="d-block label-form-sensors" for="">NOME DO TREM</label>
                                <input class="form-control input-form-sensors" value="<?php echo $tremEditar["nomeTrem"] ?>" name="nomeTrem" type="text" placeholder="EX: Trem 2"
                                    id="nomeSensor" required>
                            </div>

                            <div>
                                <label class="form-label" for="id_usuario">Selecione uma rota para cadastrar trens:</label>
                                <select class="form-select" name="idRota">

                                    <option value="<?php echo $tremEditar["idRota"]; ?>" selected>
                                        <?php echo $nomeRota; ?>
                                    </option>

                                    <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>

                                        <?php if ($rota["idRota"] != $tremEditar["idRota"]) { ?>

                                            <option value="<?php echo $rota["idRota"]; ?>">
                                                <?php echo $rota["nomeRota"]; ?>
                                            </option>

                                        <?php } ?>

                                    <?php } ?>

                                </select>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class="label-form-sensors" for="">Tipo de carga</label>
                                <select class="form-select input-form-sensors-select" name="tipoCarga">
                                    <option selected value="<?php echo $tremEditar["tipoCarga"]; ?>">
                                        <?php echo $tremEditar["tipoCarga"]; ?>
                                    </option>
                                    <?php
                                    $tiposCarga = ["Passageiros", "Grãos", "Minério", "Carvão", "Combustível", "Produtos Químicos"];

                                    foreach ($tiposCarga as $tipo) {
                                        if ($tipo != $tremEditar["tipoCarga"]) {
                                    ?>
                                            <option value="<?php echo $tipo; ?>">
                                                <?php echo $tipo; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="div-inputs-label-sensors">
                                <label class=" label-form-sensors" for="">Modelo do trem</label>
                                <select class="form-select input-form-sensors-select" name="modeloTrem">
                                    <option selected value="<?php echo $tremEditar["modeloTrem"]; ?>">
                                        <?php echo $tremEditar["modeloTrem"]; ?>
                                    </option>
                                    <?php
                                    $modeloTrem = ["Diesel", "Elétrico", "Diesel-Elétrico", "Híbrido"];

                                    foreach ($modeloTrem as $modelo) {
                                        if ($modelo != $tremEditar["modeloTrem"]) {
                                    ?>
                                            <option value="<?php echo $modelo; ?>">
                                                <?php echo $modelo; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="d-flex flex-column">
                                <button
                                    class="d-block btn btn-primary button-form-sensors"
                                    type="submit">
                                    Atualizar
                                </button>
                                <a id="botao-voltar-editar" class="btn btn-dark mt-1" href="../../trens.php">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <!----------------------------------------------------------------------------------------------//-->


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="../java/script.js"></script>

</body>

</html>