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

    if (formSensor) {
        formSensor.onsubmit = (e) => {

            e.preventDefault();

            let idSensor = document.getElementById('nomeSensor').value;
            let localSensor = document.getElementById('localSensor').value;

            let Tabela = document.getElementById("tabelaSensores");

            let linhasTabela = Tabela.rows.length;
            console.log(linhasTabela);
            let ultimaLinha = Tabela.rows[linhasTabela - 1];
            let alterarLinha;

            if (ultimaLinha.cells[0].textContent === "" || ultimaLinha.cells[0].textContent === "?") {
                
                alterarLinha = ultimaLinha;

            } else {

                alterarLinha = Tabela.insertRow(-1);
                alterarLinha.insertCell(0);
                alterarLinha.insertCell(1);
                alterarLinha.insertCell(2);
                alterarLinha.insertCell(3);
                alterarLinha.insertCell(4);

            }

            alterarLinha.cells[0].textContent = idSensor;
            alterarLinha.cells[1].textContent = localSensor;
            alterarLinha.cells[2].textContent = 'Velocidade'
            
            alterarLinha.cells[3].innerHTML = `<td><button class="botao-imagem"><img src="assets/images/Olho.png" class="icone-olho"></button></td>`
            alterarLinha.cells[4].innerHTML = `<td><button class="botao-imagem"><img src="assets/images/Lixo.png" class="icone-lixo"></button></td>`

            formSensor.reset();
        }
    }


}