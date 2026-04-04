<?php 
    $basename = basename($_SERVER['SCRIPT_NAME']);
    $basename = ($basename == '' || $basename == 'index-seleccion.php' || $basename == 'index-formulario.php') ? 'index.php' : $basename;
?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="menu-byp">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/home/logo.png" class="img-fluid logo-byp">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBYP" aria-controls="navbarBYP" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarBYP">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link <?= ($basename == 'index.php') ? "active" : ""; ?>" aria-current="page" href="index.php">INICIO</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($basename == 'como-participar.php') ? "active" : ""; ?>" href="como-participar.php">CÓMO PARTICIPAR</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($basename == 'premio.php') ? "active" : ""; ?>" href="premio.php">PREMIOS</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($basename == 'ganadores.php') ? "active" : ""; ?>" href="ganadores.php">GANADORES</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($basename == 'preguntas.php') ? "active" : ""; ?>" href="preguntas.php">FAQS</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="assets/pdf/bases-legales.pdf" target="_blank">BASES LEGALES</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
