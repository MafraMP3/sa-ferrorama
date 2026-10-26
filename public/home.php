<?php
Session_start();
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../index.php");
    exit;
}




include "../infra/database/conn.php";

$sql = "SELECT COUNT(*) AS quantidade FROM sensores";

$resultado = $conn->query($sql);

$dados = $resultado->fetch_assoc();

$quantidadeSensores = $dados["quantidade"];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../assets/images/icon.png">
    <title>Home</title>
</head>

<body>



    <?php

    include "component/navbar.php";
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date("H");

    if ($hora >= 5 && $hora < 12) {
        $saudacao = "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        $saudacao = "Boa tarde";
    } else {
        $saudacao = "Boa noite";
    }
    ?>
    <!---------DADOS--------->


    <div class="content ">


        <h3 id="saudacao">
            <?php echo $saudacao . ", " . $_SESSION['usuario_nome'] ?>
        </h3>
        <p>Gerencie tudo aqui</p>

        <div class="container-fluid">

            <div class="row g-4 mb-4">

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card dashboard-card p-4 h-100">
                        <div class="d-flex align-items-center gap-3">
                            <img src="../assets/images/icon-sensores.png" alt="icone sensores" class="imagem-analise">
                            <div>
                                <p class="h5 mb-1">
                                    Sensores ativos:
                                </p>
                                <h2 class=" mb-0">
                                    <?php echo ($quantidadeSensores) ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card dashboard-card p-4 h-100">
                        <div class="d-flex align-items-center gap-3">

                            <img src="../assets/images/icon-velocidade.png" alt="imagem velocimetro"
                                class="imagem-analise">
                            <div>




                                <h2>Formulário de Endereço</h2>

  



                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card dashboard-card p-4 h-100">
                        <div class="d-flex align-items-center gap-3">
                            <img src="../assets/images/icon-status.png" alt="imagem status" class="imagem-analise">
                            <div>

                                <p class="h5 mb-1">
                                    Status atual
                                </p>


                                <section id="consultaClima">
                                    <h2>Monitoramento Climático</h2>



                                    <div id="resultadoClima">
                                        <p>Informe as coordenadas e consulte o clima.</p>
                                    </div>
                                </section>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 dashboard-bottom">
                <div class="col-12 col-xl-8">
                    <div class="card dashboard-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>
                                Monitoramento Geral
                            </h4>
                            <i class="fa-solid fa-chart-line text-danger opacity-50 fa-xl"></i>
                        </div>
                        <div class="monitoramento-area">
                            <div class="text-center">
                                <i class="fa-solid fa-train fa-3x mb-3"></i>

                                <h5>
                                    aaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                </h5>

                                <p>
                                    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                </p>

                            </div>
                        </div>
                    </div>
                </div>


            <div class="col-12 col-xl-4">
                <div class="card dashboard-card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="mb-0">Clima</h4>

                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2"
                            id="btnPesquisar">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                        <div id="formEndereco" class="d-none">
                            <input type="text" class="form-control form-control-sm"
                                id="cep" placeholder="Insira o CEP" maxlength="9"
                                style="width: 110px;">
                        </div>
                    </div>

                    <i class="fa-solid fa-cloud-sun text-danger opacity-50 fa-xl"></i>
                </div>

                <div id="formEndereco" class="d-none mb-3">
                    <label for="cep" class="form-label">CEP:</label>

                    <div class="input-group">
                        <input type="text" class="form-control" id="cep"
                            placeholder="00000-000" maxlength="9">

                        <button type="button" class="btn btn-danger" id="buscar">
                            Buscar
                        </button>
                    </div>
                </div>






                    </div>
                </div>
            </div>
            </div>

            <!--------------------------------->

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <script src="../java/script.js"></script>

</body>

</html>