<?php
Session_start();
if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../index.php");
  exit;
}

include("../infra/database/conn.php");

$sql = "SELECT * FROM trens";
$resultado = $conn->query($sql);
$trens = $resultado;

$sensores = mysqli_query($conn, "SELECT * FROM sensores");

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

    <!------------------------------------Sidebar---------------------------------------//-->

    <?php
    include "component/navbar.php";
    ?>

    <!------------------------------------------------------------------------------------//-->

    <!---------------------------------------CADASTRAR NOVO SENSOR--------------------------------------------//-->

    <div class="content">

      <div class="card div-top-sensors">

        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="text-cadastrar-novo-sensor h4">CADASTRAR NOVO SENSOR</p>
        </div>

        <div id="div-forms-sensors">
          <form action="services/ProcessosSensor/cadastrarSensor.php" id="formSensor" method="POST">
            <div id="div-form-cadastrarsensor" class="d-flex">
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">NOME DO SENSOR</label>
                <input class="form-control input-form-sensors" type="text" placeholder="EX: Sensor KL-I32"
                  id="nomeSensor" name="nomeSensor" required>
              </div>

              <div>
                <label class="form-label" for="idTrem">TREM DO SENSOR:</label>
                <select class="form-select" name="idTrem">
                  <option value="" selected disabled>
                    Selecione um trem
                  </option>
                  <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                    <option value="<?php echo $trem["idTrem"]; ?>">
                      <?php echo $trem["nomeTrem"] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="dataInstalacao">DATA DE INSTALAÇÃO:</label>
                <input class="form-control input-form-sensors" type="date" id="dataInstalacao" name="dataInstalacao"
                  required value="">
              </div>

              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="localSensor">LOCALIZAÇÃO</label>
                <input class="form-control input-form-sensors" type="text" placeholder="EX: Km 67" id="localSensor" name="localSensor"
                  required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class=" label-form-sensors" for="tipoSensor">TIPO DE DADO</label>
                <select class="form-select input-form-sensors-select" aria-label="Default select example"
                  id="tipoSensor" name="tipoSensor">
                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Velocidade">Velocidade</option>
                  <option value="Temperatura">Temperatura</option>
                  <option value="Energia">Energia</option>
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

    <!---------Tela de nenhum sensor cadastrado--------->

     <?php if (mysqli_num_rows($sensores) == 0) { ?>
    <div class="content" id="nenhumSensor">
      <div class="card div-top-sensors none-sensors d-flex align-items-center justify-content-center ">
        <i class="fa-solid fa-tower-broadcast fa-5x m-4 text-danger opacity-50"></i>
        <h4 class="text-secondary">
          Nenhum sensor cadastrada ainda.
        </h4>
        <p class="text-secondary mb-4">Cadastre um novo sensor para começar.</p>
      </div>
    </div>
    <?php } else {  ?>
    <!-------------------------------------------------->



    <div class="content" id="todaTabela">
      <div class="card div-tabela-sensors ">

        <div class="d-flex align-items-center">
          <img class="img-sensor-icon" src="../assets/images/icone-tabela-sensor.png" alt="">
          <p class="text-cadastrar-novo-sensor h4">SENSORES CADASTRADAS</p>
        </div>

        <div class="table-responsive">
          <table id="tabelaSensores" class="table table-bordered align-middle rounded overflow-hidden border-dark ">
            <thead>
              <tr class="table-dark ">
                <th class="ths">Nome Sensor</th>
                <th class="ths">Trem do Sensor</th>
                <th class="ths">Data de Instalação</th>
                <th class="ths">Localização</th>
                <th class="ths">Tipo de Dado</th>
                <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
                <th></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php while($sensor = mysqli_fetch_assoc($sensores)) { ?>
              <tr>
                <td><?php echo htmlspecialchars($sensor["nome"]) ?> </td>
                <td><?php 

                $tremSensor = $sensor["idTrem"];

                  $consultaTrem = mysqli_query($conn,"SELECT nomeTrem FROM trens WHERE idTrem=$tremSensor");
                  $nomeTrem = mysqli_fetch_assoc($consultaTrem); 

                 echo $nomeTrem["nomeTrem"] ?> </td>
                
                <td><?php echo $sensor["dataInstalacao"] ?> </td>

                <td><?php echo htmlspecialchars($sensor["localizacao"]) ?> </td>

                <td><?php echo $sensor["tipo"] ?> </td>

                <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?> 
                    <td class="img-tabela" style="width: 170px;">

                        <div class="d-flex gap-2 justify-content-around align-items-center">
                      <form action="services/excluir.php" method="POST" style="display: inline;">
                        <input type="hidden" name="idExcluir" value="<?php echo $sensor["idSensor"]; ?>">
                        <input type="hidden" name="tabela" value="sensores">
                        <input type="hidden" name="campoId" value="idSensor">

                        <button class="botao-imagem" type="button" data-bs-toggle="modal" data-bs-target="#ModalExcluir<?php echo $sensor["idSensor"]; ?>">
                              <i class="fa-solid fa-trash fa-xl" style="color: #ff3131;"></i>
                          </button>

                            <div class="modal fade" id="ModalExcluir<?php echo $sensor["idSensor"]; ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Confirmar exclusão</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Deseja realmente excluir o sensor <strong><?php echo $sensor["nome"]; ?></strong>?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <button type="submit" class="btn btn-danger">
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </form>

                      <form action="services/ProcessosSensor/editarSensor.php" method="POST" style="display: inline;" >
                        <input type="hidden" name="idSensor" value="<?php echo $sensor["idSensor"]; ?>">

                        <button class="botao-imagem" type="submit" data-bs-toggle="tooltip" title="Editar">
                          <i class="fa-solid fa-pen-to-square fa-xl" style="color: #392d29;"></i>
                        </button>
                      </form>
                      <form action="services/ProcessosUsuario/visualizarUsuario.php" method="POST" style="display: inline;">
                        <input type="hidden" name="idUsuario" value="<?php echo $usuario["idUsuario"]; ?>">

                        <button class="botao-imagem" type="submit" data-bs-toggle="tooltip" title="Visualizar">
                          <i class="fa-solid fa-eye fa-xl" style="color: #392d29;"></i>
                        </button>
                      </form>

                      </div>

                    </td>
                <?php } ?>
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
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
[...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
</html>