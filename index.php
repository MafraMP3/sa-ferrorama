
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERMES | SA-FERRORAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg border-bottom sticky-top bg-light">
    <div class="container py-2">
        <a class="navbar-brand" href="#inicio">
            <img src="assets/images/logo_escrita.png" height="35" alt="HERMES">
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <a href="public/index.php" class="btn btn-danger rounded-0 px-4">Acessar sistema ↗</a>
            </div>
        </div>
    </div>
</nav>

<main>

    <section id="inicio" class="container-fluid p-0">
        <div class="d-flex align-items-center" style="min-height: 650px; background: url('assets/images/background_landingpage.png') center center / cover no-repeat;">
            <div class="container py-5">
                <div class="col-lg-5">
                    <img src="assets/images/logo_escrita.png" class="img-fluid w-75" alt="HERMES">
                    <p class="fs-5 mt-3" style="color: #51413b;">Sistema de monitoramento e gerenciamento ferroviário.</p>
                    <a href="public/index.php" class="btn btn-danger rounded-0 px-4 py-3 mt-3">Acessar sistema ↗</a>
                </div>
            </div>
        </div>
    </section>

    <section id="funcionalidades" class="py-5 text-light" style="background-color: #292124;">
        <div class="container py-4">
            <h2 class="display-5 fw-bold mt-3 mb-5">Recursos do sistema</h2>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="border-top border-danger border-2 pt-4 h-100">
                        <i class="fa-solid fa-tower-broadcast fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Sensores</h5>
                        <p class="text-white-50">Cadastro e gerenciamento dos sensores.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="border-top border-danger border-2 pt-4 h-100">
                        <i class="fa-solid fa-train fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Trens</h5>
                        <p class="text-white-50">Cadastro e gerenciamento dos trens.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="border-top border-danger border-2 pt-4 h-100">
                        <i class="fa-solid fa-route fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Rotas</h5>
                        <p class="text-white-50">Cadastro e gerenciamento das rotas.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="border-top border-danger border-2 pt-4 h-100">
                        <i class="fa-solid fa-chart-line fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Monitoramento</h5>
                        <p class="text-white-50">Visualização dos dados dos sensores.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="projeto" class="py-5">
        <div class="container py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mt-3" style="color: #292124;">SA-FERRORAMA</h2>
                    <p class="text-secondary mt-3">Projeto acadêmico desenvolvido no SENAI SC, envolvendo monitoramento ferroviário e Internet das Coisas (IoT).</p>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="assets/images/logo_escrita.png" class="img-fluid w-75" alt="HERMES">
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="py-4 text-light" style="background-color: #292124;">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
        <img src="assets/images/logo_escrita.png" height="30" alt="HERMES">
        <small class="text-white-50">© <?= date('Y') ?> HERMES — SENAI SC</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
