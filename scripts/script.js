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

   let Tabela = document.getElementById("tabelaSensor");

   linhasTabela = Tabela.rows.length;
   console.log(linhasTabela);

   alterarLinha = Tabela.rows[linhasTabela - 1];    

   alterarLinha.cells[0].textContent = 'QD-730'
   alterarLinha.cells[1].textContent = 'Jaburanga'
   alterarLinha.cells[2].textContent = 'Velocidade'
   }