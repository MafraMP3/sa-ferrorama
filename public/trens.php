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

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);
$usuarios = $resultado;


$sql = "SELECT
            trens.idTrem,
            trens.nomeTrem,
            trens.tipoCarga,
            trens.modeloTrem,
            rotas.nomeRota,
            usuarios.nome AS nomeUsuario
        FROM trens
        LEFT JOIN rotas ON trens.idRota = rotas.idRota
        LEFT JOIN usuarios ON trens.idUsuario = usuarios.idUsuario";


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
  <title>Trens</title>
</head>

<body>
  <main>

    <!------------------------------------Sidebar---------------------------------------//-->

    <?php
    include "component/navbar.php";
    ?>

    <?php
    $erroTrem = $_SESSION['erro_trem'] ?? null;
    unset($_SESSION['erro_trem']);
    ?>

    <?php if ($erroTrem) { ?>
      <div class="modal fade" id="ModalErroVazio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Erro</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <?php echo htmlspecialchars($erroTrem); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="content">
      <div class="card div-top">
        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="title-text-form h4">CADASTRAR NOVO TREM</p>
        </div>

        <div class="div-forms">
          <form action="services/ProcessosTrem/cadastrarTrem.php" method="POST" id="formSensor">
            <div class="div-form-cadastrar d-flex">
              <div class="div-inputs-label">
                <label class="d-block label-form" for="nomeSensor">NOME DO TREM</label>
                <input class="form-control input-form-sensors" name="nomeTrem" type="text" placeholder="EX: Trem 2" id="nomeSensor" required>
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="idRota">ROTA DO TREM</label>
                <select class="form-select input-form-select" name="idRota" id="idRota" required>
                  <option value="" selected disabled>Selecione uma rota</option>
                  <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                    <option value="<?php echo $rota["idRota"]; ?>">
                      <?php echo htmlspecialchars($rota["nomeRota"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="idUsuario">USUÁRIO RESPONSÁVEL</label>
                <select class="form-select input-form-select" name="idUsuario" id="idUsuario" required>
                  <option value="" selected disabled>Selecione um usuário</option>
                  <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                    <option value="<?php echo $usuario["idUsuario"]; ?>">
                      <?php echo htmlspecialchars($usuario["nome"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="tipoSensor">TIPO DE CARGA</label>
                <select class="form-select input-form-select" name="tipoCarga" aria-label="Tipo de carga" id="tipoSensor" required>
                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Passageiros">Passageiros</option>
                  <option value="Grãos">Grãos</option>
                  <option value="Minério">Minério</option>
                  <option value="Carvão">Carvão</option>
                  <option value="Combustível">Combustível</option>
                  <option value="Produtos Químicos">Produtos Químicos</option>
                </select>
              </div>

              <div class="div-inputs-label">
                <label class="d-block label-form" for="modeloTrem">MODELO DO TREM</label>
                <select class="form-select input-form-select" name="modeloTrem" aria-label="Modelo do trem" id="modeloTrem" required>
                  <option selected disabled value="">Selecione o modelo</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Elétrico">Elétrico</option>
                  <option value="Diesel-Elétrico">Diesel-Elétrico</option>
                  <option value="Híbrido">Híbrido</option>
                </select>
              </div>

              <div class="div-button">
                <button class="d-block btn btn-primary button-form" type="submit">Cadastrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!----------------------------------------------------------------------------------------------//-->

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
      <!-------------------------------------------------->

      <div class="div-form-list content" id="todaTabela">
        <div class="card div-table-form">

          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-train fa-2x" style="color: rgb(255, 49, 49);"></i>
              <p class="title-text-form h4">
                TRENS CADASTRADOS
              </p>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table-forms table table-bordered align-middle rounded overflow-hidden border-dark ">
              <thead>
                <tr class="table-dark">
                  <th class="ths">Nome</th>
                  <th class="ths">Tipo de Carga</th>
                  <th class="ths">Modelo</th>
                  <th class="ths">Rota</th>
                  <th class="ths">Usuário</th>
                  <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
                    <th class="ths">Ações</th>
                  <?php } ?>
                </tr>
              </thead>

              <tbody>
                <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                  <tr>
                    <td><?php echo htmlspecialchars($trem["nomeTrem"]); ?></td>
                    <td><?php echo htmlspecialchars($trem["tipoCarga"]); ?></td>
                    <td><?php echo htmlspecialchars($trem["modeloTrem"]); ?></td>
                    <td><?php echo htmlspecialchars($trem["nomeRota"] ?? "Sem rota"); ?></td>
                    <td><?php echo htmlspecialchars($trem["nomeUsuario"] ?? "Sem usuário"); ?></td>

                    <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
                      <td class="img-tabela" style="width: 220px;">
                        <div class="d-flex gap-2 justify-content-around align-items-center">

                          <form action="services/excluir.php" method="POST" style="display: inline;">
                            <input type="hidden" name="idExcluir" value="<?php echo $trem["idTrem"]; ?>">
                            <input type="hidden" name="tabela" value="trens">
                            <input type="hidden" name="campoId" value="idTrem">

                            <button class="botao-imagem" type="button" data-bs-toggle="modal" data-bs-target="#ModalExcluir<?php echo $trem["idTrem"]; ?>">
                              <i class="fa-solid fa-trash fa-xl" style="color: #ff3131;" data-bs-toggle="tooltip" title="Excluir"></i>
                            </button>

                            <div class="modal fade" id="ModalExcluir<?php echo $trem["idTrem"]; ?>" tabindex="-1">
                              <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5">Confirmar exclusão</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>

                                  <<<<<<< HEAD
                                    <div class="modal-body">
                                    Deseja realmente excluir o trem <strong><?php echo htmlspecialchars($trem["nomeTrem"]); ?></strong>?
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <button type="submit" class="btn btn-danger">Confirmar</button>
                                </div>
                                =======

                                <div class="modal fade" id="ModalExcluir<?php echo $trem["idTrem"]; ?>" tabindex="-1">
                                  <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5">Confirmar exclusão</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                      </div>
                                      <div class="modal-body">
                                        Deseja realmente excluir o trem <strong><?php echo htmlspecialchars($trem["nomeTrem"]); ?></strong>?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                        >>>>>>> 5c7c0a051a4d14a041805cee64060a6ec9d65813
                                      </div>
                                    </div>
                                  </div>
                          </form>

                          <form action="services/ProcessosTrem/editarTrem.php" method="POST" style="display: inline;">
                            <input type="hidden" name="idTrem" value="<?php echo $trem["idTrem"]; ?>">

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
    <!-------------------------------------------------->

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

<?php if ($erroTrem) { ?>
  <script>
    new bootstrap.Modal(document.getElementById('ModalErroVazio')).show();
  </script>
<?php } ?>

</html>