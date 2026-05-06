
//=============================================================================================================================================//

if (window.location.pathname.includes("index.html")){

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


//=============================================================================================================================================//
