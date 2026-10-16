<?php
session_start();
if (!isset($_SESSION['usuario_nome']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
  header("Location: ../index.php");
  exit;
}

include("../infra/database/conn.php");


$nomePesquisa = "";
$funcaoPesquisa = "";


if (isset($_POST["limparPesquisa"])) {
    $nomePesquisa = "";
    $funcaoPesquisa = "";
} else {
    $nomePesquisa = $_POST["nomePesquisa"] ?? "";
    $funcaoPesquisa = $_POST["funcaoPesquisa"] ?? "";
}


$limite = 10;


$pagina = max(1, (int) ($_GET["pagina"] ?? 1));


$sql = "SELECT * FROM usuarios WHERE 1=1";

$tipos = "";
$valores = [];


if ($nomePesquisa !== "") {
    $sql .= " AND nome LIKE ?";
    $tipos .= "s";
    $valores[] = "%" . $nomePesquisa . "%";
}


if ($funcaoPesquisa !== "") {
    $sql .= " AND funcao = ?";
    $tipos .= "s";
    $valores[] = $funcaoPesquisa;
}


$sqlContagem = "SELECT COUNT(*) AS total FROM usuarios WHERE 1=1";

if ($nomePesquisa !== "") {
    $sqlContagem .= " AND nome LIKE ?";
}

if ($funcaoPesquisa !== "") {
    $sqlContagem .= " AND funcao = ?";
}

$stmtContagem = $conn->prepare($sqlContagem);

if ($tipos !== "") {
    $stmtContagem->bind_param($tipos, ...$valores);
}

$stmtContagem->execute();

$resultadoContagem = $stmtContagem->get_result();
$totalUsuarios = $resultadoContagem->fetch_assoc()["total"];

$totalPaginas = max(1, (int) ceil($totalUsuarios / $limite));

$pagina = min($pagina, $totalPaginas);


$inicio = ($pagina - 1) * $limite;


$sql .= " LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);

$tiposConsulta = $tipos . "ii";
$valoresConsulta = array_merge($valores, [$limite, $inicio]);

$stmt->bind_param($tiposConsulta, ...$valoresConsulta);

$stmt->execute();

$usuarios = $stmt->get_result();

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
  <title>Usuários</title>
</head>

<body>

  <main>

    <!------------------------------------Sidebar---------------------------------------//-->

    <?php
    $parametros = http_build_query([
    "nomePesquisa" => $nomePesquisa,
    "funcaoPesquisa" => $funcaoPesquisa
    ]);

    $sufixo = $parametros !== "" ? "&" . $parametros : "";

    include "component/navbar.php";
    ?>

    <!------------------------------------------------------------------------------------//-->

    <!---------------------------------------CADASTRAR NOVO USUARIO--------------------------------------------//-->

    <div class="content">

      <div class="card div-top">

        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="title-text-form h4">CADASTRAR NOVO USUÁRIO</p>
        </div>

        <div class="div-forms">
          <form method="POST" action="services/ProcessosUsuario/cadastrarUsuario.php" id="">
            <div class="div-form-cadastrar d-flex">
              <div class="div-inputs-label">
                <label class="d-block label-form" for="">NOME COMPLETO</label>
                <input class="form-control input-form-sensors" name="nome" type="text" placeholder="EX: Carlos Almeida" id="nomeUsuario"
                  required>
              </div>
              <div class="div-inputs-label">
                <label class="d-block label-form" for="">EMAIL</label>
                <input class="form-control input-form" name="email" type="text" placeholder="EX: Carlos@gmail.com"
                  id="emailUsuario" required>
              </div>
              <div class="div-inputs-label">
                <label class="d-block label-form" for="">CPF</label>
                <input class="form-control input-form" name="cpf" maxlength="14" type="text" placeholder="EX: 123.456.789-00"
                  id="cpfUsuario" required>
              </div>
              <div class="div-inputs-label">
                <label class="d-block label-form" for="">SENHA</label>
                <input class="form-control input-form" name="senha" type="password" placeholder="EX: 1234" id="senhaUsuario"
                  required>
              </div>
              <div class="div-inputs-label">
                <label class=" label-form" for="">CARGO</label>
                <select class="form-select input-form-select" name="funcao" aria-label="Default select example"
                  id="tipoSensor">
                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Funcionário">Funcionário</option>
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

    <!------------------------------------------------------------------------------------------------------------->




    <!---------Tela de nenhum usuario cadastrado--------->
    <?php if (mysqli_num_rows($usuarios) == 0 && empty($_POST["nomePesquisa"]) && empty($_POST["funcaoPesquisa"])) { ?>
      <div class="div-none-form-info content">
        <div class="card div-top-form none-form d-flex align-items-center justify-content-center ">
          <i class="fa-solid fa-users-slash fa-5x m-4 text-danger opacity-50"></i>
          <h4 class="text-secondary">
            Nenhum usuário cadastrado ainda.
          </h4>
          <p class="text-secondary mb-4">Cadastre um novo usuário para começar.</p>
        </div>
      </div>
    <?php } else { ?>
      <!-------------------------------------------------->

      <div class="div-form-list content">


        <div class="card div-table-form">

          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex">
              <i class="fa-solid fa-users fa-2x" style="color: rgb(255, 49, 49);"></i>
              <p class="title-text-form h4">
                USUÁRIOS CADASTRADOS
              </p>
            </div>

            <div class="d-flex gap-1">

              <div>
                <form class="d-flex gap-1" action="" method="POST">
                  <div>
                    <input class="form-control" type="text" name="nomePesquisa" placeholder="Pesquisar">
                  </div>

                  <div>
                    <select class="form-select" name="funcaoPesquisa" id="funcaoPesquisa">
                      <option selected disabled value="">Selecione a função</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Funcionário">Funcionário</option>
                    </select>
                  </div>

                  <div>
                    <button id="botao-preto-fadecinza" class="btn btn-dark" type="submit">Pesquisar</button>
                  </div>

                </form>
              </div>

              <div>
                <form action="" method="POST">
                  <button id="botao-preto-fadecinza" class="btn btn-dark" type="submit" name="limparPesquisa">Limpar Pesquisa</button>
                </form>
              </div>
            </div>

          </div>

          <div class="table-responsive">
            <table class="table-forms table table-bordered align-middle rounded overflow-hidden border-dark ">
              <thead>
                <tr class="table-dark">
                  <th class="ths">Nome</th>
                  <th class="ths">Email</th>
                  <th class="ths">CPF</th>
                  <th class="ths">Função</th>
                  <th class="ths">Ações</th>
                </tr>
              </thead>

              <tbody>

                <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>

                  <tr>

                    <td><?php echo htmlspecialchars($usuario["nome"]); ?></td>

                    <td><?php echo $usuario["email"]; ?></td>

                    <td class="dado-restrito"><?php echo htmlspecialchars($usuario["cpf"]); ?></td>

                    <td><?php echo $usuario["funcao"]; ?></td>

                    <td class="img-tabela  " style="width: 220px;">
                      <div class="d-flex gap-2 justify-content-around align-items-center">
                        <form action="services/excluir.php" method="POST" style="display: inline;">
                          <input type="hidden" name="idExcluir" value="<?php echo $usuario["idUsuario"]; ?>">
                          <input type="hidden" name="tabela" value="usuarios">
                          <input type="hidden" name="campoId" value="idUsuario">

                          <button class="botao-imagem" type="button" data-bs-toggle="modal" data-bs-target="#ModalExcluir<?php echo $usuario["idUsuario"]; ?>">
                            <i class="fa-solid fa-trash fa-xl" style="color: #ff3131;" data-bs-toggle="tooltip" title="Excluir"></i>
                          </button>

                          <div class="modal fade" id="ModalExcluir<?php echo $usuario["idUsuario"]; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5">Confirmar exclusão</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                  Deseja realmente excluir o usuário <strong><?php echo $usuario["nome"]; ?></strong>?
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

                        <form action="services/ProcessosUsuario/editarUsuario.php" method="POST" style="display: inline;">
                          <input type="hidden" name="idUsuario" value="<?php echo $usuario["idUsuario"]; ?>">

                          <button class="botao-imagem" type="submit" data-bs-toggle="tooltip" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa-xl" style="color: #392d29;"></i>
                          </button>

                        </form>


                      </div>
                    </td>

                  </tr>

                <?php } ?>

              </tbody>

            </table>
          
              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">

                <p class="text-secondary mb-0">
                  Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?>
                  — <?php echo $totalUsuarios; ?> usuários encontrados
                </p>

                <nav aria-label="Navegação das páginas">
                  <ul class="pagination mb-0">

                    <li class="page-item <?php echo $pagina <= 1 ? 'disabled' : ''; ?>">
                      <a class="page-link text-dark"
                        href="?pagina=<?php echo $pagina - 1; ?>&<?php echo $parametros; ?>">
                        Anterior
                      </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>

                    <li class="page-item <?php echo $pagina == $i ? 'active' : ''; ?>">
                        <a class="page-link text-dark bg-light "
                          style="<?php echo $pagina == $i ? 'border: 1px solid #ff3131 !important;' : ''; ?>"
                          href="?pagina=<?php echo $i; ?>&<?php echo $parametros; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>

                    <?php } ?>

                    <li class="page-item text-dark bg-light  <?php echo $pagina >= $totalPaginas ? 'disabled' : ''; ?>">
                      <a class="page-link text-dark"
                        href="?pagina=<?php echo $pagina + 1; ?>&<?php echo $parametros; ?>">
                        Próxima
                      </a>
                    </li>

                  </ul>
                </nav>

              </div>

          </div>

        </div>

      </div>
    <?php } ?>
    <!---------------------------------------------------->


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