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

    <!------------------------------------Sidebar---------------------------------------//-->

    <?php
    include "component/navbar.php";
    ?>

    <!------------------------------------------------------------------------------------//-->
    <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>

    <div class="content">
      <div class="card div-top">
        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="title-text-form h4">CADASTRAR NOVA ROTA</p>
        </div>

        <div class="div-forms">
          <form action="services/ProcessosRotas/cadastrarRota.php" method="POST" id="formSensor">
            <div class="div-form-cadastrar d-flex">
              <div class="div-inputs-label">
                <label class="d-block label-form" for="nomeRota">NOME DA ROTA</label>
                <input class="form-control input-form-sensors" name="nomeRota" type="text" placeholder="EX: caminho das águas" id="nomeRota" required>
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="descricao">DESCRIÇÃO</label>
                <input class="form-control input-form-sensors" name="descricao" id="descricao" type="text" placeholder="EX: Muito demorada">
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="distancia">DISTÂNCIA (KM)</label>
                <input class="form-control input-form-sensors" name="distancia" id="distancia" type="number" placeholder="EX: 20" min="0">
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="duracao">DURAÇÃO (MINUTOS)</label>
                <input class="form-control input-form-sensors" name="duracao" id="duracao" type="number" placeholder="EX: 60" min="0">
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="dataCriacao">DATA DE CRIAÇÃO</label>
                <input class="form-control input-form-sensors" name="dataCriacao" id="dataCriacao" type="date">
              </div>

              <div class="div-button">
                <button class="d-block btn btn-primary button-form" type="submit">Cadastrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php } ?>
    <!----------------------------------------------------------------------------------------------//-->


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

      <div class="div-form-list content" id="todaTabela">
        <div class="card div-table-form">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-route fa-2x" style="color: rgb(255, 49, 49);"></i>
              <p class="title-text-form h4">ROTAS CADASTRADAS</p>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table-forms table table-bordered align-middle rounded overflow-hidden border-dark ">
              <thead>
                <tr class="table-dark">
                  <th class="ths">Nome Rota</th>
                  <th class="ths">Descrição</th>
                  <th class="ths">Distância</th>
                  <th class="ths">Duração (min)</th>
                  <th class="ths">Data de Criação</th>
                  <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
                    <th class="ths">Ações</th>
                  <?php } ?>
                </tr>
              </thead>

              <tbody>
                <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                  <tr>
                    <td><?php echo htmlspecialchars($rota["nomeRota"]); ?></td>
                    <td><?php echo htmlspecialchars($rota["descricao"]); ?></td>
                    <td><?php echo htmlspecialchars($rota["distancia"]); ?> Km</td>
                    <td><?php echo htmlspecialchars($rota["duracao"]); ?> Minutos</td>
                    <td><?php echo date("d/m/Y", strtotime($rota["dataCriacao"])); ?></td>

                    <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
                      <td class="img-tabela" style="width: 170px;">
                        <div class="d-flex gap-2 justify-content-around align-items-center">
                          <form action="services/excluir.php" method="POST" style="display: inline;">
                            <input type="hidden" name="idExcluir" value="<?php echo $rota["idRota"]; ?>">
                            <input type="hidden" name="tabela" value="rotas">
                            <input type="hidden" name="campoId" value="idRota">

                            <button class="botao-imagem" type="button" data-bs-toggle="modal" data-bs-target="#ModalExcluir<?php echo $rota["idRota"]; ?>">
                              <i class="fa-solid fa-trash fa-xl" style="color: #ff3131;"></i>
                            </button>

                            <div class="modal fade" id="ModalExcluir<?php echo $rota["idRota"]; ?>" tabindex="-1">
                              <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5">Confirmar exclusão</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    Deseja realmente excluir a rota
                                    <strong><?php echo htmlspecialchars($rota["nomeRota"]); ?></strong>?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>

                          <form action="services/ProcessosRotas/editarRota.php" method="POST" style="display: inline;">
                            <input type="hidden" name="idRota" value="<?php echo $rota["idRota"]; ?>">
                            <button class="botao-imagem" type="submit" data-bs-toggle="tooltip" title="Editar">
                              <i class="fa-solid fa-pen-to-square fa-xl" style="color: #392d29;"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
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