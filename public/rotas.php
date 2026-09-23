<?php
Session_start();
if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../index.php");
  exit;
}

include "../infra/database/conn.php";

$rotas = mysqli_query($conn, "SELECT * FROM rotas");
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
  <title>Rotas</title>
</head>

<body>
  <main>


    <?php
    include "component/navbar.php";
    ?>



    <div class="content">

      <div class="card div-top-sensors">

        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="text-cadastrar-novo-sensor h4">CADASTRAR NOVA ROTA</p>
        </div>



        <div id="div-forms-sensors">
          <form action="services/ProcessosRotas/cadastrarRota.php" method="POST" id="formSensor">
            <div id="div-form-cadastrarsensor" class="d-flex">
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">NOME DA ROTA</label>
                <input class="form-control input-form-sensors" name="nomeRota" type="text"
                  placeholder="EX: caminho das águas" id="nomeRota" required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">ORIGEM</label>
                <input class="form-control input-form-sensors" name="origemRota" type="text" placeholder="EX: Estação 1"
                  id="origemRota" required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">DESTINO</label>
                <input class="form-control input-form-sensors" name="destinoRota" type="text"
                  placeholder="EX: Estação 2" id="destinoRota" required>
              </div>
              <div id="div-button-sensors">
                <button class="d-block btn btn-primary button-form-sensors" type="submit">Cadastrar</button>
              </div>
            </div>
          </form>
        </div>

      </div>

    </div>

    <!----------------------------------------------------------------------------------------------//-->

    <!---------Tela de deletar Sensor--------->

    <div class="container content card" id="delete-sensor-part">
      <div class="d-flex">
        <div id="div-img-delete-sensors redbg">
          <img id="img-delete-sensors" src="../assets/images/Lixo.png" alt="">
        </div>
        <div class="mt-4">
          <p class="h4" id="text-delete-sensor"> Deseja Excluir o sensor?</p>
          <div class="d-flex  align-items-center justify-content-center">
            <button class="btn btn-lg"
              onclick="document.getElementById('delete-sensor-part').style.display = 'none'">Não</button>
            <button class="btn btn-lg" onclick="excluirLinha()">Sim</button>
          </div>
        </div>
      </div>
    </div>

    <!---------------------------------------->

    <!---------Tela de nenhuma rota cadastrada--------->

    <?php if (mysqli_num_rows($rotas) == 0) { ?>
      <div class="content" id="nenhumSensor">
        <div class="card div-top-sensors none-sensors d-flex align-items-center justify-content-center ">
          <i class="fa-solid fa-left-right fa-5x m-4 text-danger opacity-50"></i>
          <h4 class="text-secondary">
            Nenhuma rota cadastrada ainda.
          </h4>
          <p class="text-secondary mb-4">Cadastre uma nova rota para começar.</p>
        </div>
      </div>
    <?php } else { ?>
      <!-------------------------------------------------->

      <div class="content" id="todaTabela">
        <div class="card div-tabela-sensors ">

          <div class="d-flex align-items-center">
            <img class="img-sensor-icon" src="../assets/images/icone-tabela-sensor.png" alt="">
            <p class="text-cadastrar-novo-sensor h4">ROTAS CADASTRADAS</p>
          </div>

          <div class="table-responsive">
            <table id="tabelaSensores" class="table table-bordered align-middle rounded overflow-hidden border-dark ">
              <thead>
                <tr class="table-dark ">
                  <th class="ths">Nome Rota</th>
                  <th class="ths">Origem</th>
                  <th class="ths">Destino</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                  <tr>
                    <td><?php echo $rota["nomeRota"] ?> </td>
                    <td><?php echo $rota["origem"] ?> </td>
                    <td><?php echo $rota["destino"] ?> </td>

                    <td class="img-tabela" style="width: 170px;">
                      <button class="botao-imagem" onclick="telaApagar(this)"><img src="../assets/images/Lixo.png"
                          class="icone-lixo"></button>
                      <button class="botao-imagem" onclick="window.location.href='monitoramento.php'"><img
                          src="../assets/images/Olho.png" class="icone-olho"></button>
                    </td>
                  </tr>
                <?php } ?>
            </table>
          </div>
        </div>
      <?php } ?>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="../java/script.js"></script>

</body>

</html>