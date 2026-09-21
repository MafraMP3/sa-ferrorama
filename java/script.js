//======================================================TODAS AS PÁGINAS=======================================================================================//

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", function () {

    const pagina = window.location.href;
    const paginaAtual = pagina.split('/').pop();

const links = document.querySelectorAll(".sidebar-link");

links.forEach(function(link) {

    const paginaLink = link.getAttribute("href");

    if(paginaLink === paginaAtual){
        link.classList.add("active");
    } else{
        link.classList.remove("active");
    }
})
});

//======================================================HOME.php=======================================================================================//

if (window.location.pathname.includes("public/home.php")) {

}
//======================================================SENSORES.php=======================================================================================//

//======================================================USUARIOS.php=======================================================================================//


//======================================================MONITORAMENTO.php=======================================================================================//

if (window.location.pathname.includes("public/monitoramento.php")) {
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
            interaction: {
                mode: 'nearest',
                intersect: false,
                axis: 'xy'
            },
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

    function alterarStatus(taOnline) { //muda as aparições de Online e Operacional dependendo de uma Booleana
        const statusOnline = document.querySelectorAll('.status-online');
        const statusOffline = document.querySelectorAll('.status-offline');

        if (taOnline) {
            statusOnline.forEach(e => e.classList.remove('d-none'));
            statusOffline.forEach(e => e.classList.add('d-none'));
        } else {
            statusOnline.forEach(e => e.classList.add('d-none'));
            statusOffline.forEach(e => e.classList.remove('d-none'));
        }

    }

    function ALTERAR_STATUS_ALEATORIO() { //muda o Status Aleatoriamente (APAGAR DEPOIS)!!!
        let sensor_online = Math.random() >= 0.5;

        alterarStatus(sensor_online);
    }

    function atualizarGrafico() { //faz todas as funções de dados
        addDados();
        tirarMedia();
        tirarAtual();
        tirarMax();
        atualizarHorario();
        ALTERAR_STATUS_ALEATORIO();
    }

    const velAtualizacao = 60000; //velocidade padrão para melhor modificação

    atualizarGrafico(); //insere o 1º dado
    atualizarHorario();

    setTimeout(() => {
        atualizarGrafico(); //insere o 2º 

        setInterval(atualizarGrafico, velAtualizacao) //atualiza tudo a cada (velAtualizacao)
    }, velAtualizacao / 5) //insere o 2º dado e inicia a atualização acima após 1/5 do tempo




}