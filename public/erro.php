<?php

$tipo = $_GET["tipo"] ?? "desconhecido";
$tabela = $_GET["tabela"] ?? "";

if ($tipo === "dependencia") {

    if ($tabela === "rotas") {
        $titulo = "Não foi possível excluir a rota";
        $mensagem = "Esta rota está vinculada a um ou mais trens e não pode ser excluída.";
        $voltar = "rotas.php";
    } elseif ($tabela === "trens") {
        $titulo = "Não foi possível excluir o trem";
        $mensagem = "Este trem possui informações vinculadas e não pode ser excluído.";
        $voltar = "trens.php";
    } elseif ($tabela === "sensores") {
        $titulo = "Não foi possível excluir o sensor";
        $mensagem = "Este sensor possui informações vinculadas e não pode ser excluído.";
        $voltar = "sensores.php";
    } else {
        $titulo = "Não foi possível excluir";
        $mensagem = "Este registro possui informações vinculadas e não pode ser excluído.";
        $voltar = "home.php";
    }

} else {

    $titulo = "Ocorreu um erro";
    $mensagem = "Não foi possível realizar esta operação.";
    $voltar = "home.php";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Erro - Ferrorama SA</title>
</head>

<body>

    <main class="container d-flex justify-content-center align-items-center vh-100">

        <div class="card p-5 text-center shadow">

            <div class="mb-3">
                <i class="fa-solid fa-circle-exclamation text-danger fa-4x"></i>
            </div>

            <h2 class="text-danger">
                <?php echo $titulo; ?>
            </h2>

            <p class="text-secondary">
                <?php echo $mensagem; ?>
            </p>

            <a href="<?php echo $voltar; ?>" class="btn btn-danger mt-3">
                Voltar
            </a>

        </div>

    </main>

</body>

</html>