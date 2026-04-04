<?php 

  $time = date('His');

  if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
  }
  include_once(INCLUDE_PATH . 'class/inc.globals.php');

  session_start();

  unset($_SESSION['SAVE']);
  unset($_SESSION['UID']);
  unset($_SESSION['PREMIO_ID']);
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
<body id="page-index" class="d-flex flex-column">
  <div class="layout-bg">
    <!-- HEADER -->
    <header class="text-white text-center">
      <?php include("include-menu.php"); ?>
    </header>

    <!-- CONTENIDO -->
    <main class="container-fluid">

      <div class="is-desktop">
        <img src="assets/img/home/bill-y-mike-v1.png" class="img-fluid bill-y-mike" alt="Bilz y Pap">

        <div class="container">
          <div class="row h-100">
            <div class="col-12 col-lg-6">
              <img src="assets/img/home/funpass.png" class="img-fluid funpass d-block mx-auto" alt="Bilz y Pap">

              <a href="index-formulario.php">
                <img src="assets/img/home/btn-participa.png" class="img-fluid btn-participa hvr-pulse" alt="Bilz y Pap">
              </a>

            </div>
            <div class="col-12 col-lg-6"></div>
          </div>
        </div>
      </div>
      
      
      <div class="is-mobile">
        <div class="row">
          <div class="col-12">
            <div class="space-10"></div>
            <img src="assets/img/home/funpass.png" class="funpass-sm w-75" alt="Bilz y Pap">
            <div class="space-50"></div>
            <a href="index-formulario.php">
              <img src="assets/img/home/btn-participa.png" class="img-fluid btn-participa-sm" alt="Bilz y Pap">
            </a>
            <div class="space-30"></div>
            <img src="assets/img/home/bill-y-mike-sm-v2.png" class="img-fluid bill-y-mike-smxx" alt="Bilz y Pap">
          </div>
        </div>
      </div>
    
      
    </main>

  </div>
  <?php include("include-footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="assets/js/plugins.js?<?= $time; ?>"></script>
  <script src="assets/js/main.js?<?= $time; ?>"></script>
</body>
</html>