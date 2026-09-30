<?php
$publicPath = str_replace('\\', '/', dirname(__DIR__));
$projectPath = str_replace('\\', '/', dirname($publicPath));
$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

$publicUrl = str_replace($documentRoot, '', $publicPath);
$projectUrl = str_replace($documentRoot, '', $projectPath);
?>

<div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>

<button class="hamburger" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="sidebar container d-flex flex-column justify-content-between">
    <div>
        <div id="logocontainer">
            <img src="<?php echo $projectUrl; ?>/assets/images/logo-quadrada.png" alt="logo">
        </div>

        <a href="<?php echo $publicUrl; ?>/home.php" class="sidebar-link" id="linkDashboard">
            <i class="fa-solid fa-house" style="color: #fff;"></i> Dashboard
        </a>

        <a href="<?php echo $publicUrl; ?>/monitoramento.php" class="sidebar-link" id="linkMonitoramento">
            <i class="fa-solid fa-chart-line" style="color: #fff;"></i> Monitoramento
        </a>

        <a href="<?php echo $publicUrl; ?>/sensores.php" class="sidebar-link" id="linkSensores">
            <i class="fa-solid fa-satellite-dish" style="color: #fff;"></i> Sensores
        </a>

        <a href="<?php echo $publicUrl; ?>/trens.php" class="sidebar-link" id="linkTrens">
            <i class="fa-solid fa-train" style="color: #fff;"></i> Trens
        </a>

        <a href="<?php echo $publicUrl; ?>/rotas.php" class="sidebar-link" id="linkRotas">
            <i class="fa-solid fa-left-right" style="color: #fff;"></i> Rotas
        </a>

        <?php if ($_SESSION['usuario_funcao'] == 'Administrador') { ?>
            <a href="<?php echo $publicUrl; ?>/usuarios.php" class="sidebar-link" id="linkUsuarios">
                <i class="fa-solid fa-users" style="color: #fff;"></i> Usuários
            </a>
        <?php } ?>
    </div>

    <div>
        <a href="<?php echo $publicUrl; ?>/suporte.php" class="sidebar-link" id="linkSuporte">
            <i class="fa-solid fa-headset" style="color: #fff;"></i> Suporte
        </a>

        <a href="<?php echo $publicUrl; ?>/logout.php" class="logout" id="linkSair">
            SAIR
        </a>
    </div>
</div>