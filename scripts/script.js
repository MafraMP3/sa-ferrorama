//======================================================TODAS AS PÁGINAS=======================================================================================//

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
}

if (!window.location.pathname.includes("index.html")) {
    if (localStorage.getItem("logado") !== "true") {
        window.location.replace("../index.html");
    }
    const logout = document.querySelector('.logout');

    if (logout) {
        logout.onclick = (e) => {

            e.preventDefault();

            localStorage.clear();
            window.location.replace("../index.html");
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
                window.location.assign("public/home.html");
            } else {
                console.log("Inválido");
            }
        }
    }
}

//======================================================HOME.HTML=======================================================================================//

if (window.location.pathname.includes("public/home.html")) {

    let welcome = document.getElementById("saudacao");
    let nomeAdmin = "Admin";

    welcome.textContent = `Bem-vindo, ${nomeAdmin}`;

}
//======================================================SENSORES.HTML=======================================================================================//

if (window.location.pathname.includes("public/sensores.html")) {

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

    function excluirLinha() {
        if (linhaSelecionada) {
            linhaSelecionada.remove();
            telaExcluir.style.display = "none";
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
          <img class="img-sensor-icon" src="../assets/images/icone-tabela-sensor.png" alt="">
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
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="../assets/images/Lixo.png"
                      class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img
                      src="../assets/images/Olho.png" class="icone-olho"></button>
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
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="../assets/images/Lixo.png" class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img src="../assets/images/Olho.png" class="icone-olho"></button>
                </td>`

                semSensor = document.getElementById("nenhumSensor");
                semSensor.style.display = 'none';


                formSensor.reset();
            }


        }
    }


}

//======================================================USUARIOS.HTML=======================================================================================//

if (window.location.pathname.includes("public/usuarios.html")) {

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
          <img class="img-sensor-icon" src="../assets/images/icone-tabela-sensor.png" alt="">
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
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="../assets/images/Lixo.png"
                      class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img
                      src="../assets/images/Olho.png" class="icone-olho"></button>
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
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="..;assets/images/Lixo.png" class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img src="../assets/images/Olho.png" class="icone-olho"></button>
                </td>`

                semUsuario = document.getElementById("nenhumUsuario");
                semUsuario.style.display = 'none';


                formUsuarios.reset();
            }


        }
    }


}
//======================================================MONITORAMENTO.HTML=======================================================================================//

if (window.location.pathname.includes("public/monitoramento.html")) {
    const ctx = document.getElementById('grafico').getContext('2d'); //Gráfico de linhas

    const meuGrafico = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Dados dos Sensores',
                data: [],
                borderColor: '#d62727',
                backgroundColor: 'rgb(245, 158, 158)',
                borderWidth: 3,
                tension: 0.05,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'minute',
                        displayFormats: {
                            minute: 'HH:mm'
                        }
                    }
                },
                y: {
                    type: 'linear',
                    min: 0,
                    max: 100
                }
            }
        }
    }); // -Gráfico de linhas

    let dadosSensor = 0
    function pegarHoraAtual() {
        const horaAtual = new Date();

        const horas = String(horaAtual.getHours()).padStart(2, '0');
        const minutos = String(horaAtual.getMinutes()).padStart(2, '0');
        const segundos = String(horaAtual.getSeconds()).padStart(2, '0'); //pega hora atual
        let horario = `${horas}:${minutos}:${segundos}`;

        return [horaAtual, horario];
    }

    let tempo = pegarHoraAtual();


    function addDados() { //função de adicionar dados ao gráfico
        tempo = pegarHoraAtual();

        dadosSensor = Math.floor(Math.random() * 100); //numero aleatório de 0 a 99

        meuGrafico.data.datasets[0].data.push({
            x: tempo[0],
            y: dadosSensor
        }); //insere os dados na tabela

        meuGrafico.update(); //atualiza a tabela com os dados novos

        if (meuGrafico.data.datasets[0].data.length > 30) {
            meuGrafico.data.datasets[0].data.shift();
            console.log(meuGrafico.data.datasets[0].data.length); //retira dados velhos
        }

        meuGrafico.update(); //atualiza o delete
    }


    function tirarMedia() { //função para tirar a média dos dados do gráfico

        let somaDados = [];

        meuGrafico.data.datasets[0].data.forEach((ponto) => {
            somaDados.push(ponto.y);
        });

        somaDados = somaDados.reduce((total, dados) => total + dados, 0);

        let media = somaDados / meuGrafico.data.datasets[0].data.length //pega a soma dos dados do gráfico e divide pela quantidade de pontos no gráfico

        mostrarMedia = document.getElementById('mediaSensores');

        mostrarMedia.textContent = media.toFixed(2);
    }

    function tirarAtual() { //pega Velocidade Atual
        let velAtual = document.getElementById('velAtual');

        velAtual.textContent = dadosSensor; //muda na tela
    }

    function tirarMax() { //pega Velocidade Máxima do Array y de pontos

        let velMax = document.getElementById('velMax');
        let maiorVelocidade = 0;

        meuGrafico.data.datasets[0].data.forEach((velocidade) => { //pra cada ponto do Array

            if (velocidade.y > maiorVelocidade) { //pra cada y do Array
                maiorVelocidade = velocidade.y
            }
        });

        velMax.textContent = maiorVelocidade; //muda na tela
    }
    function atualizarHorario() {
        
        let horaAgora = tempo[1];

        document.getElementById('ultimaAtualizacao').textContent = horaAgora;
    }

    function atualizarGrafico() { //faz todas as funções de dados
        addDados();
        tirarMedia();
        tirarAtual();
        tirarMax();
        atualizarHorario();
    }

    const velAtualizacao = 60000; //velocidade padrão para melhor modificação

    atualizarGrafico(); //insere o 1º dado
    atualizarHorario();

    setTimeout(() => {
        atualizarGrafico(); //insere o 2º 

        setInterval(atualizarGrafico, velAtualizacao) //atualiza tudo a cada (velAtualizacao)
    }, velAtualizacao / 5) //insere o 2º dado e inicia a atualização acima após 1/3 do tempo




}