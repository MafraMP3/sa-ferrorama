
//=============================================================================================================================================//

if (window.location.pathname.includes("index.html")){
 const form_login = document.getElementById("form-login") //A revisar

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
            msg.innerHTML = "<div><p id='erro' class='text-danger d-flex justify-content-center'> Usuário Inválido </p></div>";
        }

        if (valido == true) {
            console.log("Validado");
            localStorage.setItem("logado", "true");
            window.location.replace("forum.html"); //A trocar
        } else {
            console.log("Inválido");
        }
    }
}   
}


//=============================================================================================================================================//
