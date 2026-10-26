//======================================================TODAS AS PÁGINAS=======================================================================================//

const API_KEY = 'f21c4ced94b130da1602ed5e53b05aa3';


function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", function () {

    const paginaAtual = window.location.pathname.split('/').pop();

    const links = document.querySelectorAll(".sidebar-link");

    links.forEach(function (link) {

        const paginaLink = new URL(link.href).pathname.split('/').pop();

        if (paginaLink === paginaAtual) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });

});

//======================================================HOME.php=======================================================================================//

if (window.location.pathname.includes("public/home.php")) {

    // BUSCAR CEP

    document.getElementById('buscar').addEventListener('click', buscarCep);

    async function buscarCep() {
        const cep = document.getElementById('cep').value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert('Digite um CEP com 8 números.');
            return;
        }

        const resultado = document.getElementById('resultadoClima');

        resultado.innerHTML = '<p>Buscando endereço e informações do clima...</p>';

        try {
            // PARTE 1: Buscar endereço pelo CEP
            const resposta = await fetch(
                `https://viacep.com.br/ws/${cep}/json/`
            );

            if (!resposta.ok) {
                throw new Error(`Erro HTTP: ${resposta.status}`);
            }

            const dados = await resposta.json();

            if (dados.erro) {
                alert('CEP não encontrado.');
                limparFormulario();
                return;
            }


            // PARTE 2: Buscar latitude e longitude da cidade
            const parametrosGeo = new URLSearchParams({
                name: `${dados.localidade}, ${dados.uf}, Brasil`,
                count: 10,
                language: 'pt',
                format: 'json'
            });

            const respostaGeo = await fetch(
                `https://geocoding-api.open-meteo.com/v1/search?${parametrosGeo}`
            );

            if (!respostaGeo.ok) {
                throw new Error('Falha ao buscar as coordenadas.');
            }

            const dadosGeo = await respostaGeo.json();

            if (!dadosGeo.results || dadosGeo.results.length === 0) {
                throw new Error('Não foi possível localizar a cidade.');
            }

            const cidade = dadosGeo.results.find(local =>
                local.name.toLowerCase() === dados.localidade.toLowerCase()
            ) || dadosGeo.results[0];

            const latitude = cidade.latitude;
            const longitude = cidade.longitude;

            // PARTE 3: Consultar o clima com as coordenadas
            const parametrosClima = new URLSearchParams({
                latitude: latitude,
                longitude: longitude,
                hourly: 'temperature_2m,precipitation,rain,precipitation_probability',
                current: 'temperature_2m,is_day,weather_code',
                timezone: 'auto'
            });

            const respostaClima = await fetch(
                `https://api.open-meteo.com/v1/forecast?${parametrosClima}`
            );

            if (!respostaClima.ok) {
                throw new Error('Falha ao consultar o clima.');
            }

            const clima = await respostaClima.json();
            const atual = clima.current;

            // PARTE 4: Interpretar a condição meteorológica
            function interpretarClima(codigo) {
                if (codigo === 0) return 'Céu limpo';
                if (codigo === 1) return 'Predominantemente limpo';
                if (codigo === 2) return 'Parcialmente nublado';
                if (codigo === 3) return 'Nublado';
                if ([45, 48].includes(codigo)) return 'Neblina';
                if ([51, 53, 55, 56, 57].includes(codigo)) return 'Garoa';
                if ([61, 63, 65, 66, 67, 80, 81, 82].includes(codigo)) return 'Chuva';
                if ([71, 73, 75, 77, 85, 86].includes(codigo)) return 'Neve';
                if ([95, 96, 99].includes(codigo)) return 'Tempestade';
                return 'Condição desconhecida';
            }

            // PARTE 5: Montar os cards e a tabela


            let html = `
            <h3>Clima em ${dados.localidade} - ${dados.uf}</h3>

            <p><strong>Cidade:</strong> ${dados.localidade}</p>
            <p><strong>Estado:</strong> ${dados.uf}</p>

            <p><strong>Temperatura atual:</strong>
                ${atual.temperature_2m} ${clima.current_units.temperature_2m}
            </p>

            <p><strong>Condição:</strong>
                ${interpretarClima(atual.weather_code)}
            </p>

            <p><strong>Período:</strong>
                ${atual.is_day === 1 ? 'Dia' : 'Noite'}
            </p>

            <p><strong>Horário dos dados:</strong>
                ${atual.time.replace('T', ' ')}
            </p>

            <p><strong>Latitude:</strong> ${latitude}</p>
            <p><strong>Longitude:</strong> ${longitude}</p>

            <h3>Previsão para as próximas 3 horas</h3>
            <div class="previsao-horas">
        `;

            const proximasHoras = clima.hourly.time
                .map((horario, i) => ({ horario, i }))
                .filter(item => item.horario > atual.time)
                .slice(0, 3);

            proximasHoras.forEach(({ horario, i }) => {
                html += `
                <div class="card-previsao">
                    <h4>${horario.split('T')[1]}</h4>
                    <p>🌡️ ${clima.hourly.temperature_2m[i]} °C</p>
                    <p>🌧️ ${clima.hourly.precipitation_probability[i] ?? '—'}% de chance de chuva</p>
                    <p>💧 ${clima.hourly.rain[i] ?? 0} mm de chuva</p>
                </div>
            `;
            });
            html += `</div>`;

            resultado.innerHTML = html;

        } catch (erro) {
            console.error('Erro na consulta:', erro);
            alert('Falha na consulta. Abra o console (F12) para ver o erro.');
        }
    }

    function limparFormulario() {
        document.getElementById('resultadoClima').innerHTML =
            '<p>Informe o CEP para consultar o clima.</p>';
    }

}

//======================================================SENSORES.php=======================================================================================//

if (window.location.pathname.includes("public/sensores.php")) {
    let dataAtual = new Date();

    let diaAtual = String(dataAtual.getDate());
    diaAtual = diaAtual.padStart(2, '0');

    let mesAtual = String(dataAtual.getMonth() + 1);
    mesAtual = mesAtual.padStart(2, '0');

    let anoAtual = dataAtual.getFullYear();

    let inputData = document.getElementById("dataInstalacao");

    if (inputData) {
        inputData.value = `${anoAtual}-${mesAtual}-${diaAtual}`;
        console.log(`${anoAtual}-${mesAtual}-${diaAtual}`);

    }

}

//======================================================USUARIOS.php=======================================================================================//

if (window.location.pathname.includes("public/usuarios.php")) {
    let cadastroUsuario = document.getElementById("cadastroUsuario");
    cadastroUsuario.addEventListener("submit", function (e) {

        let nomeUsuario = document.getElementById("nomeUsuario").value.trim();

        let nomeSeparado = nomeUsuario.split(/\s+/);

        if (nomeSeparado.length < 2) {
            e.preventDefault();
            alert("Digite Nome e Sobrenome");
        }
    });
}

//======================================================ROTAS.php=======================================================================================//
if (window.location.pathname.includes("public/rotas.php")) {
    let dataAtual = new Date();

    let diaAtual = String(dataAtual.getDate());
    diaAtual = diaAtual.padStart(2, '0');

    let mesAtual = String(dataAtual.getMonth() + 1);
    mesAtual = mesAtual.padStart(2, '0');

    let anoAtual = dataAtual.getFullYear();

    let inputData = document.getElementById("dataCriacao");

    if (inputData) {
        inputData.value = `${anoAtual}-${mesAtual}-${diaAtual}`;
        console.log(`${anoAtual}-${mesAtual}-${diaAtual}`);
    }
}

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