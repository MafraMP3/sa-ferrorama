<?php
Session_start();
if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../index.php");
  exit;
}


$nome = $_SESSION['usuario_nome'] ?? 'Usuário';
$email = $_SESSION['usuario_email'] ?? 'E-mail não informado';
$funcao = $_SESSION['usuario_funcao'] ?? 'Usuário';
$foto = $_SESSION['usuario_foto'] ?? '';


include("../infra/database/conn.php");

$sql = "SELECT * FROM rotas";
$resultado = $conn->query($sql);
$rotas = $resultado;

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);
$usuarios = $resultado;


$filtroAtivo = isset($_POST["filtrar"]) && !isset($_POST["limparFiltro"]);
if ($_SESSION['usuario_funcao'] == 'Administrador' && !$filtroAtivo) {
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

} else {
  $sql = "SELECT
                trens.idTrem,
                trens.nomeTrem,
                trens.tipoCarga,
                trens.modeloTrem,
                rotas.nomeRota,
                usuarios.nome AS nomeUsuario
            FROM trens
            LEFT JOIN rotas ON trens.idRota = rotas.idRota
            LEFT JOIN usuarios ON trens.idUsuario = usuarios.idUsuario
            WHERE usuarios.nome = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_SESSION["usuario_nome"]);
  $stmt->execute();
  $resultado = $stmt->get_result();
}

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
  <title>Home</title>
</head>

<body>



  <?php
  include "component/navbar.php";
  ?>



  <!---------DADOS--------->


  <div class="content ">

    <div class=" div-top-monitor">

      <section id="section-navbar-monitor"
        class="rounded-top d-flex justify-content-between align-items-center px-4 py-3">
        <div>

          <p class="text-monitor-sensor mb-0">Minha conta</p>
          <p class=" small mb-0 ms-3" style="color: rgba(255, 255, 255, 0.767) !important;">Visualize e gerencie seus
            dados pessoais </p>
        </div>


    </div>
    </section>

    <section class="card mb-4">
      <div class="card-body p-4">
        <div class="row align-items-center g-3">

          <div class="col-auto">
            <?php if (!empty($foto)): ?>
            <img src="<?= htmlspecialchars($foto) ?>" alt="Foto do perfil" class="rounded-circle img-thumbnail"
              width="110" height="110">
            <?php else: ?>
            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
              style="width: 110px; height: 110px;">
              <i class="fa-solid fa-user fa-3x"></i>
            </div>
            <?php endif; ?>
          </div>

          <div class="col">
            <h2 class="h3 fw-bold mb-2">
              <?= htmlspecialchars($nome) ?>
            </h2>

            <span class="badge bg-danger mb-2">
              <i class="fa-solid fa-shield-halved"></i>
              <?= htmlspecialchars($funcao) ?>
            </span>

            <p class="text-secondary mb-0 text-break">
              <i class="fa-solid fa-envelope me-2"></i>
              <?= htmlspecialchars($email) ?>
            </p>
          </div>

          <div class="col-12 col-lg-auto">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
              <i class="fa-solid fa-pen me-2"></i>
              Editar perfil
            </button>
          </div>

        </div>
      </div>
    </section>


<div class="modal fade" id="modalEditarPerfil" tabindex="-1"
    aria-labelledby="tituloEditarPerfil" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="tituloEditarPerfil">
                    Editar usuário
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Fechar">
                </button>
            </div>

            <div class="modal-body">

                <form action="services/ProcessosUsuario/atualizarPerfil.php" method="POST" enctype="multipart/form-data">


                <div class="mb-3">
                    <label for="usuarioFoto" class="form-label">Foto de perfil</label>
                    <input
                        type="file"
                        class="form-control"
                        id="usuarioFoto"
                        name="usuarioFoto"
                        accept="image/png, image/jpeg, image/webp"
                    >
                    <div class="form-text">
                        Formatos aceitos: JPG, PNG e WEBP.
                    </div>
                </div>
                    

                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" name="editarUsuario"
                            class="btn btn-danger">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Salvar alterações
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>



    <?php if (mysqli_num_rows($trens) == 0) { ?>
    <div id="nenhumSensor">
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

      <div class="div-form-list" id="todaTabela">
        <div class="card div-table-form">

          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-train fa-2x" style="color: rgb(255, 49, 49);"></i>
              <p class="title-text-form h4">
                TRENS CADASTRADOS
              </p>
            </div>

            <!-- Botão Limpar Filtro -->
            <?php
            if ($_SESSION['usuario_funcao'] == 'Administrador' && isset($_POST["filtrar"])) { ?>
              <div>
                <form action="" method="POST">
                  <button type="submit" name="limparFiltro">Limpar Filtro</button>
                </form>
              </div>
            <?php } ?>

            <!-- Botão Filtrar Trens -->
            <?php
            if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
              <div>

                <form action="" method="POST">
                  <button type="submit" name="filtrar">Apenas meus trens</button>
                </form>
              </div>
            <?php } ?>

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
                  <th class="ths">Ações</th>
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


                    <td class="img-tabela" style="width: 220px;">
                      <div class="d-flex gap-2 justify-content-around align-items-center">

                        <form action="services/excluir.php" method="POST" style="display: inline;">
                          <input type="hidden" name="idExcluir" value="<?php echo $trem["idTrem"]; ?>">
                          <input type="hidden" name="tabela" value="trens">
                          <input type="hidden" name="campoId" value="idTrem">

                          <button class="botao-imagem" type="button" data-bs-toggle="modal"
                            data-bs-target="#ModalExcluir<?php echo $trem["idTrem"]; ?>">
                            <i class="fa-solid fa-trash fa-xl" style="color: #ff3131;" data-bs-toggle="tooltip"
                              title="Excluir"></i>
                          </button>



                          <div class="modal fade" id="ModalExcluir<?php echo $trem["idTrem"]; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5">Confirmar exclusão</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                  Deseja realmente excluir o trem
                                  <strong><?php echo htmlspecialchars($trem["nomeTrem"]); ?></strong>?
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Confirmar</button>
                                </div>
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


    </main>



  </div>



  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="../java/script.js"></script>
</body>

</html>