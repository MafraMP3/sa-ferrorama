<?php
Session_start();

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../../../index.php");
    exit;
}

include("../../../infra/database/conn.php");


if (isset($_POST["idUsuario"]) && filter_var($_POST["idUsuario"], FILTER_VALIDATE_INT) !== false) {

    $idUsuario = $_POST["idUsuario"];

    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $usuarioEditar = $resultado->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="../../../styles/style.css">
    <link rel="icon" href="../../../assets/images/icon.png">

    <title>Editar Usuário</title>
</head>

<body>

    <main>

        <?php
        include "../../component/navbar.php";
        ?>

        <div class="content">

            <div class="card div-top-sensors">

                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-user-pen fa-2x" style="color: rgb(255, 49, 49);"></i>

                    <p class="text-cadastrar-novo-sensor h4">
                        EDITANDO USUÁRIO: <?php echo $usuarioEditar["nome"]; ?>
                    </p>
                </div>

                <div id="div-forms-sensors">

                    <form action="atualizarUsuario.php" method="POST">

                        <div id="div-form-cadastrarsensor" class="d-flex">

                            <input type="hidden" name="idUsuario" value="<?php echo $usuarioEditar["idUsuario"]; ?>">

                            <div class="div-inputs-label-sensors">

                                <label class="d-block label-form-sensors">
                                    NOME
                                </label>

                                <input
                                    class="form-control input-form-sensors"
                                    value="<?php echo $usuarioEditar["nome"]; ?>"
                                    name="nome"
                                    type="text"
                                    required>

                            </div>


                            <div class="div-inputs-label-sensors">

                                <label class="d-block label-form-sensors">
                                    E-MAIL
                                </label>

                                <input
                                    class="form-control input-form-sensors"
                                    value="<?php echo $usuarioEditar["email"]; ?>"
                                    name="email"
                                    type="email"
                                    required>

                            </div>


                            <div class="div-inputs-label-sensors">

                                <label class="d-block label-form-sensors">
                                    SENHA
                                </label>

                                <input
                                    class="form-control input-form-sensors"
                                    value="<?php echo $usuarioEditar["senha"]; ?>"
                                    name="senha"
                                    type="text"
                                    required>

                            </div>


                            <div class="div-inputs-label-sensors">

                                <label class="d-block label-form-sensors">
                                    CPF
                                </label>

                                <input
                                    class="form-control input-form-sensors"
                                    value="<?php echo $usuarioEditar["cpf"]; ?>"
                                    name="cpf"
                                    type="text"
                                    required>

                            </div>


                            <div class="div-inputs-label-sensors">

                                <label class="label-form-sensors">
                                    FUNÇÃO
                                </label>

                                <select
                                    class="form-select input-form-sensors-select"
                                    name="funcao">

                                    <option selected value="<?php echo $usuarioEditar["funcao"]; ?>">
                                        <?php echo $usuarioEditar["funcao"]; ?>
                                    </option>

                                    <?php
                                    $funcoes = ["Administrador", "Funcionário"];

                                    foreach ($funcoes as $funcao) {
                                        if ($funcao != $usuarioEditar["funcao"]) {
                                    ?>

                                            <option value="<?php echo $funcao; ?>">
                                                <?php echo $funcao; ?>
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
                                <a id="botao-preto-fadecinza" class="btn btn-dark mt-1" href="../../usuarios.php">Voltar</a>
                            </div>


                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9H9JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

    <script src="../java/script.js"></script>

</body>

</html>