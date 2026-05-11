//======================================================TODAS AS PÁGINAS=======================================================================================//

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
}

if (!window.location.pathname.includes("index.html")) {
    if (localStorage.getItem("logado") !== "true") {
        window.location.replace("index.html");
    }
    const logout = document.querySelector('.logout');

    if (logout) {
        logout.onclick = (e) => {

            e.preventDefault();

            localStorage.clear();
            window.location.replace("index.html");
        }
    }
}
//======================================================INDEX.HTML=======================================================================================//

if (window.location.pathname.includes("index.html")) {

    localStorage.setItem("email", "admin@gmail.com");
    localStorage.setItem("password", "123");

    const form_login = document.getElementById("form-login");

    if (form_login) {
        form_login.onsubmit = (e) => {

            e.preventDefault();

            console.log("OI");

            let email = document.getElementById('email').value;
            let senha = document.getElementById('senha').value;
            let msg = document.getElementById('mensagem');

            msg.innerHTML = "";

            let valido = true;

            if (senha !== localStorage.getItem('password')) {
                valido = false;
                msg.innerHTML = "<div><p id='erro' class='text-danger d-flex justify-content-center'> Senha Inválida </p></div>";
            }

            if (email !== localStorage.getItem('email')) {
                valido = false;
                msg.innerHTML = "<div><p id='erro' class='text-danger d-flex justify-content-center'> Email Inválido </p></div>";
            }

            if (valido == true) {
                console.log("Validado");
                localStorage.setItem("logado", "true");
                window.location.assign("home.html");
            } else {
                console.log("Inválido");
            }
        }
    }
}

//======================================================HOME.HTML=======================================================================================//

if (window.location.pathname.includes("home.html")) {

    let welcome = document.getElementById("saudacao");
    let nomeAdmin = "Admin";

    welcome.textContent = `Bem-vindo, ${nomeAdmin}`;

}
//======================================================SENSORES.HTML=======================================================================================//

if (window.location.pathname.includes("sensores.html")) {

    let formSensor = document.getElementById("formSensor");

    let tabelaSensor = document.getElementById("tabelaSensores");
    let todaTabela = document.getElementById("todaTabela");

    let telaExcluir = document.getElementById('delete-sensor-part');

    let linhaSelecionada;

    let semSensor = document.getElementById("nenhumSensor");

    function telaApagar(botao) {
        telaExcluir.style.display = "flex";
        linhaSelecionada = botao.closest('tr');
    }

    function tirarTela() {
        telaExcluir.style.display = "none";
    }

    function excluirLinha() {
        if (linhaSelecionada) {
            linhaSelecionada.remove();
            tirarTela();
            tabelaSensor = document.getElementById("tabelaSensores");
            todaTabela = document.getElementById("todaTabela");
            if (tabelaSensor && tabelaSensor.rows.length === 1) {
                todaTabela.remove();
                semSensor = document.getElementById("nenhumSensor");
                semSensor.style.display = 'block';
            }
        }
    }

    if (formSensor) {
        formSensor.onsubmit = (e) => {

            if (!tabelaSensor) {
                telaExcluir.insertAdjacentHTML('afterend', `<div class="content" id="todaTabela">
      <div class="card div-tabela-sensors ">

        <div class="d-flex align-items-center">
          <img class="img-sensor-icon" src="assets/images/icone-tabela-sensor.png" alt="">
          <p class="text-cadastrar-novo-sensor h4">SENSORES CADASTRADOS</p>
        </div>

        <div class="table-responsive">
          <table id="tabelaSensores" class="table table-bordered align-middle rounded overflow-hidden border-dark ">
            <thead>
              <tr class="table-dark ">
                <th class="ths">ID sensor</th>
                <th class="ths">Localização</th>
                <th class="ths">Tipo Dado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td class="img-tabela" style="width: 170px;">
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="assets/images/Lixo.png"
                      class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img
                      src="assets/images/Olho.png" class="icone-olho"></button>
                </td>
              </tr>
          </table>
        </div>
      </div>`)
            }

            tabelaSensor = document.getElementById("tabelaSensores");

            e.preventDefault();

            let idSensor = document.getElementById('nomeSensor').value;
            let localSensor = document.getElementById('localSensor').value;
            let tipoSensor = document.getElementById("tipoSensor").value;

            let linhasTabela = tabelaSensor.rows.length;
            console.log(linhasTabela);
            let ultimaLinha = tabelaSensor.rows[linhasTabela - 1];
            let alterarLinha;

            if (ultimaLinha.cells[0].textContent === "" || ultimaLinha.cells[0].textContent === "?") {

                alterarLinha = ultimaLinha;

            } else {
                if (idSensor.trim() === '' || localSensor.trim() === '' || tipoSensor === '' || idSensor.length > 20 || localSensor.length > 20) {

                } else {
                    alterarLinha = tabelaSensor.insertRow(1);
                    alterarLinha.insertCell(0);
                    alterarLinha.insertCell(1);
                    alterarLinha.insertCell(2);
                    alterarLinha.insertCell(3);
                }


            }

            if (idSensor.trim() === '' || localSensor.trim() === '' || tipoSensor === '' || idSensor.length > 20 || localSensor.length > 20) {
                alert("os campos devem ser preenchidos com no máximo 20 caracteres");
            } else {
                alterarLinha.cells[0].textContent = idSensor;
                alterarLinha.cells[1].textContent = localSensor;
                alterarLinha.cells[2].textContent = tipoSensor;

                alterarLinha.cells[3].innerHTML = `<td class="img-tabela" style="width: 10%;">
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="assets/images/Lixo.png" class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img src="assets/images/Olho.png" class="icone-olho"></button>
                </td>`

                semSensor = document.getElementById("nenhumSensor");
                semSensor.style.display = 'none';


                formSensor.reset();
            }


        }
    }


}

//======================================================USUARIOS.HTML=======================================================================================//

if (window.location.pathname.includes("usuarios.html")) {

    let formUsuarios = document.getElementById("formUsuarios");

    let tabelaUsuarios = document.getElementById("tabelaUsuarios");
    let todaTabela = document.getElementById("todaTabela");

    let telaExcluir = document.getElementById('delete-sensor-part');

    let linhaSelecionada;

    let semUsuario = document.getElementById("nenhumUsuario");

    function telaApagar(botao) {
        telaExcluir.style.display = "flex";
        linhaSelecionada = botao.closest('tr');
    }

    function tirarTela() {
        telaExcluir.style.display = "none";
    }

    function excluirLinha() {
        if (linhaSelecionada) {
            linhaSelecionada.remove();
            tirarTela();
            tabelaUsuarios = document.getElementById("tabelaUsuarios");
            todaTabela = document.getElementById("todaTabela");
            if (tabelaUsuarios && tabelaUsuarios.rows.length === 1) {
                todaTabela.remove();
                semUsuario = document.getElementById("nenhumUsuario");
                semUsuario.style.display = 'block';
            }
        }
    }

    if (formUsuarios) {
        formUsuarios.onsubmit = (e) => {

            tabelaUsuarios = document.getElementById('tabelaUsuarios')

            if (!tabelaUsuarios) {
                telaExcluir.insertAdjacentHTML('afterend', `<div class="content" id="todaTabela">
      <div class="card div-tabela-sensors ">

        <div class="d-flex align-items-center">
          <img class="img-sensor-icon" src="assets/images/icone-tabela-sensor.png" alt="">
          <p class="text-cadastrar-novo-sensor h4">USUARIOS CADASTRADOS</p>
        </div>

        <div class="table-responsive">
          <table id="tabelaUsuarios" class="table table-bordered align-middle rounded overflow-hidden border-dark ">
            <thead>
              <tr class="table-dark ">
                <th class="ths">Nome</th>
                <th class="ths">Email</th>
                <th class="ths">Cargo</th>
                <th class="ths">Senha</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td class="img-tabela" style="width: 170px;">
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="assets/images/Lixo.png"
                      class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img
                      src="assets/images/Olho.png" class="icone-olho"></button>
                </td>
              </tr>
          </table>
        </div>
      </div>`)
            }

            tabelaUsuarios = document.getElementById("tabelaUsuarios");

            e.preventDefault();

            let nomeUsuario = document.getElementById('nomeUsuario').value;
            let emailUsuario = document.getElementById('emailUsuario').value;
            let cargoUsuario = document.getElementById('cargoUsuario').value;
            let senhaUsuario = document.getElementById("senhaUsuario").value;

            let linhasTabela = tabelaUsuarios.rows.length;
            console.log(linhasTabela);
            let ultimaLinha = tabelaUsuarios.rows[linhasTabela - 1];
            let alterarLinha;

            if (ultimaLinha.cells[0].textContent === "" || ultimaLinha.cells[0].textContent === "?") {

                alterarLinha = ultimaLinha;

            } else {
                if (nomeUsuario.trim() === '' || emailUsuario.trim() === '' || cargoUsuario === '' || senhaUsuario === '') {

                } else {
                    alterarLinha = tabelaUsuarios.insertRow(1);
                    alterarLinha.insertCell(0);
                    alterarLinha.insertCell(1);
                    alterarLinha.insertCell(2);
                    alterarLinha.insertCell(3);
                    alterarLinha.insertCell(4);

                }


            }

            if (nomeUsuario.trim() === '' || emailUsuario.trim() === '' || cargoUsuario === '' || senhaUsuario === '') {
                alert("os campos devem ser preenchidos");
            } else {
                alterarLinha.cells[0].textContent = nomeUsuario;
                alterarLinha.cells[1].textContent = emailUsuario;
                alterarLinha.cells[2].textContent = cargoUsuario;
                alterarLinha.cells[3].textContent = senhaUsuario;

                console.log(alterarLinha);
                alterarLinha.cells[4].innerHTML = `<td class="img-tabela" style="width: 10%;">
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="assets/images/Lixo.png" class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img src="assets/images/Olho.png" class="icone-olho"></button>
                </td>`

                semUsuario = document.getElementById("nenhumUsuario");
                semUsuario.style.display = 'none';


                formUsuarios.reset();
            }


        }
    }


}