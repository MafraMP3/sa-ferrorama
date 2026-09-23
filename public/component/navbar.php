    <div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>
    <button class="hamburger" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="sidebar container d-flex flex-column justify-content-between">
        <div>
            <div id="logocontainer">
                <img src="../assets/images/logo-quadrada.png " alt="logo">
            </div>

            <a href="home.php" class="sidebar-link" id="linkDashboard">
                <i class="fa-solid fa-house" style="color: #fff;"></i> Dashboard
            </a>

            <a href="monitoramento.php" class="sidebar-link" id="linkMonitoramento">
                <i class="fa-solid fa-chart-line" style="color: #fff;"></i> Monitoramento
            </a>

            <a href="sensores.php" class="sidebar-link" id="linkSensores">
                <i class="fa-solid fa-satellite-dish" style="color: #fff;"></i> Sensores
            </a>

            <a href="trens.php" class="sidebar-link" id="linkUsuarios">
                <i class="fa-solid fa-train" style="color: rgb(255, 255, 255);"></i></i> Trens
            </a>

            <a href="rotas.php" class="sidebar-link" id="linkUsuarios">
                <i class="fa-solid fa-left-right" style="color: rgb(255, 255, 255);"></i></i> Rotas
            </a>

            <a href="usuarios.php" class="sidebar-link" id="linkUsuarios">
                <i class="fa-solid fa-users" style="color: rgb(255, 255, 255);"></i></i> Usuários
            </a>
        </div>

        <div class="">
            <a href="suporte.php" class="sidebar-link" id="linkSuporte">
                <i class="fa-solid fa-headset" style="color: rgb(255, 255, 255);"></i></i> Suporte
            </a>



            <a href="logout.php" class="logout" id="linkSair">SAIR</a>
        </div>


    </div>