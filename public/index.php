
<?php

session_start();

include("infra/database/conn.php");

$erroLogin = false;

if (isset($_POST["login"])) {

    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    $query = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario["senha"])) {

            $_SESSION['usuario_id'] = $usuario['idUsuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_funcao'] = $usuario['funcao'];
            $_SESSION['usuario_foto'] = $usuario['usuarioFoto'] ?? '';

            header("Location: public/home.php");
            exit;
        }
    }

    $erroLogin = true;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style.css?v=2">
    <link rel="icon" href="assets/images/icon.png">

    <title>Ferrorama SA</title>
</head>

<body id="body-login-screen">

    <header></header>

    <main>

        <section id="section-login" class="d-block container">

            <div>
                <div class="d-flex justify-content-center">
                    <img id="img-login-screen" class="img-fluid"
                        src="assets/images/icon-image-login-screen.png" alt="">
                </div>

                <div id="div-login-screen" class="container-xxl">

                    <form id="login" method="POST" class="needs-validation" novalidate>

                        <div>
                            <label class="d-block label-login" for="email">E-mail</label>

                            <input class="form-control input-login" type="email" id="email" name="email"
                                placeholder="Digite seu email..." autocomplete="email" required>

                        </div>

                        <div class="div-inputs">
                            <label class="d-block label-login" for="senha">Senha</label>

                            <input class="form-control input-login" type="password" name="senha" id="senha"
                                placeholder="Digite sua senha..." autocomplete="current-password" required>

                        </div>

                        <?php if ($erroLogin): ?>
                            <div class="text-danger mt-3 d-flex justify-content-center" role="alert">
                                <h6 class="error-message-login">E-mail ou senha incorretos.</h6>
                            </div>
                        <?php endif; ?>

                        <div class="d-grid gap-2">
                            <button class="d-block btn btn-primary submit-button" type="submit" name="login">
                                ENTRAR
                            </button>
                        </div>

                        <div id="mensagem"></div>

                    </form>

                </div>
            </div>

            <div>
                <img class="img-fluid" id="img-footer-login-screen"
                    src="assets/images/footer-image-login-screen.png" alt="">
            </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoFForCGlyvwx9JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        (() => {
            const form = document.querySelector('#login');

            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            });
        })();
    </script>

</body>

</html>
