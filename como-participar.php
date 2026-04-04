<?php 

  $time = date('His');

  if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
  }
  session_start();
  include_once(INCLUDE_PATH . 'class/inc.globals.php');
  include_once(INCLUDE_PATH . 'class/class.inputfilter.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.min.css?<?= $time; ?>" rel="stylesheet">

  <title>Gana un FAN PASS para 4 personas con Bilz y Pap</title>
  <meta name="description" content="Participa con Bilz y Pap y gana un FAN PASS para 4 personas con entradas a Fantasilandia, Cineplanet, KidZania, Mampato, Lollapalooza y más" />

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon.svg" />
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="manifest" href="site.webmanifest" />
  
</head>
<body id="page-como-participar" class="d-flex flex-column">
  <div class="layout-bg">
    <!-- HEADER -->
    <header class="text-white text-center">
      <?php include("include-menu.php"); ?>
    </header>

    <!-- CONTENIDO -->
    <main class="container-fluid">
      <div class="is-desktop">
        <img src="assets/img/home/bill-y-mike-v1.png" class="img-fluid bill-y-mike" alt="Bilz y Pap">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6">
            <!-- INI Container -->
            
              <div class="row pasos">
                <div class="col-12 text-center">
                  <img src="assets/img/como-participar/paso-01.png" class="img-fluid step" alt="Paso 1">
                </div>
                <div class="col-12 text-center">
                  <img src="assets/img/como-participar/paso-02-v1.png" class="img-fluid step" alt="Paso 2">
                </div>
                <div class="col-12 text-center  ">
                  <img src="assets/img/como-participar/paso-03-v1.png" class="img-fluid step" alt="Paso 3">
                </div>
                <div class="col-12 text-center">
                  <img src="assets/img/como-participar/paso-04-v1.png" class="img-fluid step" alt="Paso 4">
                </div>
                <div class="col-12 text-center">
                  <img src="assets/img/como-participar/felicitaciones.png" class="img-fluid paso-felicitaciones" alt="Felicitaciones">
                </div>
              </div>
            
            <!-- END Container -->
          </div>
          
          <div class="col-12 col-lg-6"></div>
          
        </div>
      </div>
      
      <div class="is-mobile">
        <img src="assets/img/home/bill-y-mike-sm-v2.png" class="img-fluid bill-y-mike-smxxx d-block mx-auto" alt="Bilz y Pap">
      </div>
      <div class="space-50"></div>
      
      
    </main>
  </div>
  <?php include("include-footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="assets/js/plugins.js?<?= $time; ?>"></script>
  <script src="assets/js/main.js?<?= $time; ?>"></script>
</body>
</html>