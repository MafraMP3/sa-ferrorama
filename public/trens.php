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

<!---------------------------------------CADASTRAR NOVO TREM--------------------------------------------//-->

    <div class="content">

      <div class="card div-top-sensors">

        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-plus fa-2x" style="color: rgb(255, 49, 49);"></i>
          <p class="text-cadastrar-novo-sensor h4">CADASTRAR NOVO TREM</p>
        </div>

        <!-- ⚠️ ERRO GRAVE: este form usa os MESMOS ids de sensores.php
             (formSensor, nomeSensor, localSensor, tipoSensor). O script.js só
             executa a lógica de cadastro quando a URL contém "sensores.php",
             então nesta página o botão Cadastrar NÃO FAZ NADA. Precisa de
             ids próprios (formTrem, nomeTrem...) e um bloco novo no script.js
             (ou, melhor, um form real enviando pra um PHP). -->

        <div id="div-forms-sensors">
          <form action="" id="formSensor">
            <div id="div-form-cadastrarsensor" class="d-flex">
              <div class="div-inputs-label-sensors">
                <label class="d-block label-form-sensors" for="">NOME DO TREM</label>
                <input class="form-control input-form-sensors" type="text" placeholder="EX: Trem 2"
                  id="nomeSensor" required>
              </div>
              <div class="div-inputs-label-sensors">
                <label class=" label-form-sensors" for="">Rota do trem</label>
                <select class="form-select input-form-sensors-select" aria-label="Default select example"
                  id="tipoSensor">

                   <!-- ⚠️ ERRO: value não corresponde ao texto mostrado.
                       Ex: escolher "Carvão" salva o valor "Temperatura".
                       Corrigir para value="Fragil", value="Carvao", value="Toneladas" -->

                  <option selected disabled value="">Selecione o tipo</option>
                  <option value="Velocidade">ROTA 1</option>
                  <option value="Temperatura">ROTA 2</option>
                  <option value="Energia">ROTA 3</option>
                </select>
              </div>
              <div class="div-inputs-label-sensors">
                <label class=" label-form-sensors" for="">Tipo de carga</label>
                <select class="form-select input-form-sensors-select" aria-label="Default select example"
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
                <select class="form-select input-form-sensors-select" aria-label="Default select example"
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
           <!-- ⚠️ ERRO: texto copiado de sensores.php, aqui devia ser "trem" -->
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

<!---------Tela de nenhum trem cadastrado--------->

    <div class="content" id="nenhumSensor">
      <div class="card div-top-sensors none-sensors d-flex align-items-center justify-content-center ">
        <i class="fa-solid fa-train fa-5x m-4 text-danger opacity-50"></i>
        <h4 class="text-secondary">
          Nenhum trem cadastrado ainda.
        </h4>
        <p class="text-secondary mb-4">Cadastre um novo trem para começar.</p>
      </div>
    </div>

<!-------------------------------------------------->

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="../java/script.js"></script>

</body>

</html>