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

    let Tabela = document.getElementById("tabelaSensores");



    let telaExcluir = document.getElementById('delete-sensor-part');

    let linhaSelecionada;

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
        }
    }

    if (formSensor) {
        formSensor.onsubmit = (e) => {

            e.preventDefault();

            let idSensor = document.getElementById('nomeSensor').value;
            let localSensor = document.getElementById('localSensor').value;
            let tipoSensor = document.getElementById("tipoSensor").value;

            let linhasTabela = Tabela.rows.length;
            console.log(linhasTabela);
            let ultimaLinha = Tabela.rows[linhasTabela - 1];
            let alterarLinha;

            if (ultimaLinha.cells[0].textContent === "" || ultimaLinha.cells[0].textContent === "?") {

                alterarLinha = ultimaLinha;

            } else {
                if (idSensor.trim() === '' || localSensor.trim() === '' || tipoSensor === '' || idSensor.length > 20 || localSensor.length > 20) {
                     
                }else{
                    alterarLinha = Tabela.insertRow(1);
                    alterarLinha.insertCell(0);
                    alterarLinha.insertCell(1);
                    alterarLinha.insertCell(2);
                    alterarLinha.insertCell(3);
                    alterarLinha.insertCell(4);
                }


            }

            let Status = 'operando';

            if (idSensor.trim() === '' || localSensor.trim() === '' || tipoSensor === '' || idSensor.length > 20 || localSensor.length > 20) {
                alert("os campos devem ser preenchidos com no máximo 20 caracteres");
            } else {
                alterarLinha.cells[0].textContent = idSensor;
                alterarLinha.cells[1].textContent = localSensor;
                alterarLinha.cells[2].textContent = tipoSensor;
                alterarLinha.cells[3].textContent = Status;


                alterarLinha.cells[4].innerHTML = `<td class="img-tabela" style="width: 10%;">
                  <button class="botao-imagem" onclick="telaApagar(this)"><img src="assets/images/Lixo.png" class="icone-lixo"></button>
                  <button class="botao-imagem" onclick="window.location.href='monitoramento.html'"><img src="assets/images/Olho.png" class="icone-olho"></button>
                </td>`


                formSensor.reset();
            }


        }
    }


}