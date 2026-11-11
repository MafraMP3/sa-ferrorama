
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HERMES | SA-FERRORAMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="assets/images/icon.png">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg border-bottom sticky-top bg-light">
    <div class="container py-2">
        <a class="navbar-brand" href="#inicio">
            <img src="assets/images/logo_escrita.png" height="35" alt="HERMES">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav ms-auto align-items-lg-center gap-lg-3 py-3 py-lg-0">
                <a href="#funcionalidades" class="nav-link">Recursos</a>
                <a href="#projeto" class="nav-link">O projeto</a>
                <a href="public/index.php" id="button-sistem-acess-secundary" class="btn btn-danger rounded-3 px-4 py-2">Acessar sistema <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i></a>
            </div>
        </div>
    </div>
</nav>

<main>

    <section id="inicio" class="container-fluid p-0">
        <div class="d-flex align-items-center bg-light" style="min-height: 700px; background-image: url('assets/images/background_landingpage.png'); background-position: center; background-size: 100% auto; background-repeat: no-repeat;">
            <div class="container py-5">
                <div class="col-lg-5">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">SA-FERRORAMA · SENAI SC</span>
                    <img src="assets/images/logo_escrita.png" class="img-fluid w-75 d-block" alt="HERMES">
                    <p class="fs-5 mt-4" style="color: #51413b;">Sistema de monitoramento e gerenciamento ferroviário.</p>
                    <a href="public/index.php" id="button-sistem-acess" class="btn btn-danger rounded-3 px-4 py-3 mt-3">
                        Acessar sistema <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="funcionalidades" class="py-5 text-light" style="background-color: #292124;">
        <div class="container py-5">
            <span class="text-danger fw-bold small">O QUE OFERECEMOS</span>
            <h2 class="display-5 fw-bold mt-2 mb-3">Recursos do sistema<span class="text-danger">.</span></h2>
            <p class="text-white-50 mb-5">Ferramentas para gerenciamento e acompanhamento da operação ferroviária.</p>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="bg-dark rounded-4 p-4 h-100 border border-secondary border-opacity-25">
                        <i class="fa-solid fa-tower-broadcast fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Sensores</h5>
                        <p class="text-white-50 mb-0">Cadastro e gerenciamento dos sensores conectados ao sistema.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="bg-dark rounded-4 p-4 h-100 border border-secondary border-opacity-25">
                        <i class="fa-solid fa-train fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Trens</h5>
                        <p class="text-white-50 mb-0">Cadastro e gerenciamento das locomotivas monitoradas.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="bg-dark rounded-4 p-4 h-100 border border-secondary border-opacity-25">
                        <i class="fa-solid fa-route fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Rotas</h5>
                        <p class="text-white-50 mb-0">Organização e gerenciamento das rotas ferroviárias.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="bg-dark rounded-4 p-4 h-100 border border-secondary border-opacity-25">
                        <i class="fa-solid fa-chart-line fs-2 text-danger"></i>
                        <h5 class="fw-bold mt-4">Monitoramento</h5>
                        <p class="text-white-50 mb-0">Visualização e acompanhamento dos dados dos sensores.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="projeto" class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="text-danger fw-bold small">SOBRE O PROJETO</span>
                    <h2 class="display-5 fw-bold mt-3" style="color: #292124;">SA-FERRORAMA<span class="text-danger">.</span></h2>
                    <p class="text-secondary mt-4 fs-5">Projeto acadêmico desenvolvido no SENAI SC, envolvendo monitoramento ferroviário e Internet das Coisas (IoT).</p>

                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3">
                            <i class="fa-solid fa-microchip fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Tecnologia e inovação</h6>
                            <small class="text-secondary">Integração entre sistemas, sensores e monitoramento.</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="bg-white rounded-4 border p-5 text-center shadow-sm">
                        <img src="assets/images/logo_escrita.png" class="img-fluid w-75" alt="HERMES">
                        <div class="border-top mt-4 pt-3">
                            <small class="text-secondary fw-semibold">SENAI · SANTA CATARINA</small>
                        </div>
                    </div>
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
