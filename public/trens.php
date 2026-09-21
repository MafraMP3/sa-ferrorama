<?php
Session_start();
if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../index.php");
  exit;
}

include("../infra/database/conn.php");

$sql = "SELECT * FROM rotas";
$resultado = $conn->query($sql);
$rotas = $resultado;


$sql = "SELECT
            trens.idTrem,
            trens.nomeTrem,
            trens.tipoCarga,
            trens.modeloTrem,
            rotas.nomeRota
        FROM trens
        LEFT JOIN rotas ON trens.idRota = rotas.idRota";

$resultado = $conn->query($sql);
$trens = $resultado;
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
  <title>Sensores</title>
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
          <p class="text-cadastrar-novo-sensor h4">CADASTRAR NOVO TREM</p>
        </div>



        <div id="div-forms-sensors">
          <form action="services/ProcessosTrem/cadastrarTrem.php" method="POST" id="formSensor">
            <div id="div-form-cadastrarsensor" class="d-flex">
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">NOME DO TREM</label>
                <input class="form-control input-form-sensors" name="nomeTrem" type="text" placeholder="EX: Trem 2"
                  id="nomeSensor" required>
              </div>
              <div>
                <label class="form-label" for="id_usuario">Selecione uma rota para cadastrar trens:</label>
                <select class="form-select" name="idRota">
                  <option value="" selected disabled>
                    Selecione uma rota
                  </option>
                  <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                    <option value="<?php echo $rota["idRota"]; ?>">
                      <?php echo $rota["nomeRota"] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="div-inputs-label-sensors">
                <label class=" label-form-sensors" for="">Tipo de carga</label>
                <select class="form-select input-form-sensors-select" name="tipoCarga" aria-label="Default select example"
                  id="tipoSensor">
                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Velocidade">Passageiros</option>
                  <option value="Temperatura">Carvão</option>
                  <option value="Energia">Granola</option>
                  <option value="Energia">Líquido</option>
                </select>
              </div>
              <div class="div-inputs-label-sensors">
                <label class=" label-form-sensors" for="">Modelo do trem</label>
                <select class="form-select input-form-sensors-select" name="modeloTrem" aria-label="Default select example"
                  id="tipoSensor">
                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Velocidade">MODELO 1</option>
                  <option value="Temperatura">MODELO 2</option>
                  <option value="Energia">MODELO 3</option>
                </select>
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

          <p class="h4" id="text-delete-sensor"> Deseja Excluir o trem?</p>
          <div class="d-flex  align-items-center justify-content-center">
            <button class="btn btn-lg"
              onclick="document.getElementById('delete-sensor-part').style.display = 'none'">Não</button>
            <button class="btn btn-lg" onclick="excluirLinha()">Sim</button>
          </div>
        </div>
      </div>
    </div>

    <!---------------------------------------->

    <!---------Tela de nenhum trem cadastrado--------->

    <?php if (mysqli_num_rows($trens) == 0) { ?>
      <div class="content" id="nenhumSensor">
        <div class="card div-top-sensors none-sensors d-flex align-items-center justify-content-center ">
          <i class="fa-solid fa-train fa-5x m-4 text-danger opacity-50"></i>
          <h4 class="text-secondary">
            Nenhum trem cadastrado ainda.
          </h4>
          <p class="text-secondary mb-4">Cadastre um novo trem para começar.</p>
        </div>
      </div>
    <?php } else { ?>

      <div class="content" id="nenhumTrem">

        <div class="card div-tabela-sensors">

          <div class="d-flex align-items-center">
            <img class="img-sensor-icon"
              src="../assets/images/icone-tabela-sensor.png"
              alt="">

            <p class="text-cadastrar-novo-sensor h4">
              TRENS CADASTRADOS
            </p>
          </div>

          <div class="table-responsive">

            <table id="tabelaTrens"
              class="table table-bordered align-middle rounded overflow-hidden border-dark">

              <thead>
                <tr class="table-dark">
                  <th class="ths">ID Trem</th>
                  <th class="ths">Nome</th>
                  <th class="ths">Tipo de Carga</th>
                  <th class="ths">Modelo</th>
                  <th class="ths">Rota</th>
                  <th class="ths"></th>
                </tr>
              </thead>

              <tbody>

                <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>

                  <tr>

                    <td><?php echo $trem["idTrem"]; ?></td>

                    <td><?php echo $trem["nomeTrem"]; ?></td>

                    <td><?php echo $trem["tipoCarga"]; ?></td>

                    <td><?php echo $trem["modeloTrem"]; ?></td>

                    <td>
                      <?php echo $trem["nomeRota"] ?? "Sem rota"; ?>
                    </td>

                    <td class="img-tabela" style="width: 170px;">

                      <form action="services/ProcessosTrem/excluirTrem.php"
                        method="POST"
                        onsubmit="return confirm('Deseja excluir este trem?')"
                        style="display: inline;">

                        <input type="hidden"
                          name="idTrem"
                          value="<?php echo $trem["idTrem"]; ?>">

                        <button class="botao-imagem" type="submit">
                          <img src="../assets/images/Lixo.png"
                            class="icone-lixo">
                        </button>

                      </form>

                      <form action="services/ProcessosTrem/editarTrem.php"
                        method="POST"
                        style="display: inline;">

                        <input type="hidden"
                          name="idTrem"
                          value="<?php echo $trem["idTrem"]; ?>">

                        <button class="botao-imagem" type="submit">
                          <img src="../assets/images/Olho.png"
                            class="icone-olho">
                        </button>

                      </form>

                    </td>

                  </tr>

                <?php } ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>
    <?php } ?>
    <!-------------------------------------------------->

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="../java/script.js"></script>

</body>

</html>