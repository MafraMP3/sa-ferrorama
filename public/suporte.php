<?php 
Session_start(); 
if (!isset($_SESSION['usuario_nome'])) { header("Location: ../index.php"); exit; }
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
?>



<!---------DADOS--------->


    <div class="content ">
     
 <div class="card div-top-monitor">

            <section id="section-navbar-monitor" class="rounded-top d-flex justify-content-between align-items-center px-4 py-3">
                <div>
                  
                    <p class="text-monitor-sensor mb-0">Sobre o projeto</p>
                    <p class=" small mb-0 ms-3" style="color: rgba(255, 255, 255, 0.767) !important;">Informações sobre o projeto e seu desenvolvimento.</p>
                </div>
            </section>



   <div class="p-3">
    <div class="div-top-sensors none-sensors d-flex gap-4 align-items-start">

        <!-- TEXTO -->
        <div class="w-50">
            <p>
                A SA (situação de aprendizado) é um projeto iniciado no 3º ano do curso
                técnico em desenvolvimento de sistemas integrado ao ensino médio,
                realizado na escola SESI SENAI e teve como objetivo sintetizar os
                conhecimentos adquiridos durante todo o processo de aprendizado do
                docente em um projeto final. É nesse contexto que se inicia o
                desenvolvimento da SA-FERRORAMA, um sistema desenvolvido para a
                visualização, monitoramento e gerenciamento de dados captados por
                sensores instalados em um ferrorama.
            </p>

            <p>
                O processo de seu desenvolvimento passa de etapa em etapa acompanhando
                as matérias do curso técnico, se iniciando com a modelagem de seu
                sistema, onde foram descritos e organizados pela equipe seus requisitos
                funcionais, não funcionais e as regras do sistema.
            </p>
        </div>


        <div class="accordion card accordion-flush w-50" id="accordionFlushExample">

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne"
                        aria-expanded="false"
                        aria-controls="flush-collapseOne">
                        Modelagem do sistema
                    </button>
                </h2>

                <div id="flush-collapseOne"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">

                    <div class="accordion-body">
                        Informações sobre a modelagem do sistema, requisitos
                        funcionais, requisitos não funcionais e regras do sistema.
                    </div>

                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo"
                        aria-expanded="false"
                        aria-controls="flush-collapseTwo">
                        Mockup
                    </button>
                </h2>

                <div id="flush-collapseTwo"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">

                    <div class="accordion-body">
                        Informações sobre o desenvolvimento do mockup do projeto.
                    </div>

                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree"
                        aria-expanded="false"
                        aria-controls="flush-collapseThree">
                        Desenvolvimento
                    </button>
                </h2>

                <div id="flush-collapseThree"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">

                    <div class="accordion-body">
                        Informações sobre o desenvolvimento e implementação
                        do sistema SA-FERRORAMA.
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
  

<div class="m-4">
    <h4 class="mb-3">Desenvolvedores</h4>

    <div class="row row-cols-2 row-cols-md-5 g-3">

        <div class="col">
            <div class="card text-center h-100">
                <img src="../assets/images/caio.png" class="card-img-top"  object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Caio Mafra</h6>
                    <p class="card-text small text-muted">Desenvolvedor</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center h-100">
                <img src="../assets/images/lucas.webp" class="card-img-top"  object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Lucas Schattengeberg 2</h6>
                    <p class="card-text small text-muted">Desenvolvedor</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center h-100">
                <img src="../assets/images/sena.webp" class="card-img-top" object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Gustavo de Sena</h6>
                    <p class="card-text small text-muted">Desenvolvedor</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center h-100">
                <img src="../assets/images/davi_sehnem.jfif" class="card-img-top" style=" object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Davi Sehnem</h6>
                    <p class="card-text small text-muted">Desenvolvedor</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center h-100">
                <img src="../assets/images/fix.jpeg" class="card-img-top" style="height: 300px; object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title mb-1">Kauan Fix</h6>
                    <p class="card-text small text-muted">Desenvolvedor</p>
                </div>
            </div>
        </div>

    </div>
</div>


     


        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <script src="../java/script.js"></script>
</body>

</html>