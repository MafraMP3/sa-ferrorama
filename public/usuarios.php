<?php
session_start();
if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../index.php");
  exit;
}

include("../infra/database/conn.php");

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);
$usuarios = $resultado;
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
    include "component/navbar.php";
    ?>

    <!------------------------------------------------------------------------------------//-->

    <!---------------------------------------CADASTRAR NOVO USUARIO--------------------------------------------//-->

    <div class="content">

      <div class="card div-top-sensors">

        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="text-cadastrar-novo-sensor h4">ADICIONAR NOVO USUÁRIO</p>
        </div>




        <div id="div-forms-sensors">
          <form method="POST" action="services/ProcessosUsuario/cadastrarUsuario.php" id="formUsuarios">
            <div id="div-form-cadastrarsensor" class="d-flex">
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">NOME COMPLETO</label>
                <input class="form-control input-form-sensors" name="nome" type="text" placeholder="EX: Carlos" id="nomeUsuario"
                  required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">EMAIL</label>
                <input class="form-control input-form-sensors" name="email" type="text" placeholder="EX: Carlos@gmail.com"
                  id="emailUsuario" required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">CPF</label>
                <input class="form-control input-form-sensors" name="cpf" type="text" placeholder="EX: 123.456.789-00"
                  id="cpfUsuario" required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">SENHA</label>
                <input class="form-control input-form-sensors" name="senha" type="password" placeholder="EX: 1234" id="senhaUsuario"
                  required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class=" label-form-sensors" for="">FUNÇÃO / CARGO</label>
                <select class="form-select input-form-sensors-select" name="funcao" aria-label="Default select example"
                  id="tipoSensor">
                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Velocidade">Administrador</option>
                  <option value="Temperatura">Maquinista</option>
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

    <!-----------------------------------------------------------------------------------------------------------//-->


    <!---------Tela de deletar Sensor--------->

    <div class="container content card" id="delete-sensor-part">
      <div class="d-flex">
        <div id="div-img-delete-sensors redbg">
          <img id="img-delete-sensors" src="../assets/images/Lixo.png" alt="">
        </div>
        <div class="mt-4">



          <p class="h4" id="text-delete-sensor"> Deseja Excluir o usuário?</p>
          <div class="d-flex  align-items-center justify-content-center">
            <button class="btn btn-lg"
              onclick="document.getElementById('delete-sensor-part').style.display = 'none'">Não</button>
            <button class="btn  btn-lg" onclick="excluirLinha()">Sim</button>
          </div>
        </div>
      </div>
    </div>

    <!---------------------------------------->


    <!---------Tela de nenhum usuario cadastrado--------->

    <div class="content" id="nenhumUsuario">
      <div class="card div-top-sensors d-flex  align-items-center justify-content-center ">
<table id="tabelaUsuarios" class="table table-bordered align-middle rounded overflow-hidden border-dark">

  <thead>
    <tr class="table-dark">
      <th class="ths">Nome</th>
      <th class="ths">Email</th>
      <th class="ths">Senha</th>
      <th class="ths">CPF</th>
      <th class="ths">Função</th>
      <th class="ths"></th>
    </tr>
  </thead>

  <tbody>

    <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>

      <tr>
        <td><?php echo $usuario["nome"]; ?></td>

        <td><?php echo $usuario["email"]; ?></td>

        <td><?php echo $usuario["senha"]; ?></td>

        <td><?php echo $usuario["cpf"]; ?></td>

        <td><?php echo $usuario["funcao"]; ?></td>

        <td class="img-tabela" style="width: 170px;">

          <form action="services/ProcessosUsuario/excluirUsuario.php"
            method="POST"
            onsubmit="return confirm('Deseja excluir este usuário?')"
            style="display: inline;">

            <input type="hidden"
              name="idUsuario"
              value="<?php echo $usuario["idUsuario"]; ?>">

            <button class="botao-imagem" type="submit">
              <img src="../assets/images/Lixo.png"
                class="icone-lixo">
            </button>

          </form>

          <form action="services/ProcessosUsuario/editarUsuario.php"
            method="POST"
            style="display: inline;">

            <input type="hidden"
              name="idUsuario"
              value="<?php echo $usuario["idUsuario"]; ?>">

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

    <!---------------------------------------------------->


  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="../java/script.js"></script>
</body>

</html>