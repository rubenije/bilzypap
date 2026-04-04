<?php 

  $time = date('His');

  if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
  }
  session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.min.css?<?= $time; ?>" rel="stylesheet">

  <title>Bilz y Pap</title>
  <meta name="description" content="" />
</head>
<body id="page-index" class="d-flex flex-column">
    <!-- HEADER -->
    <header class="text-white text-center">
      <?php include("include-menu.php"); ?>
    </header>

    <!-- CONTENIDO -->
    <main class="container" style="border: solid 1px blue;">
      <p>Este es el contenido principal.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros eget tellus tristique bibendum.</p>
      <p>Puedes agregar más contenido aquí...</p>
    </main>
  
  <?php include("include-footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="assets/js/plugins.js?<?= $time; ?>"></script>
  <script src="assets/js/main.js?<?= $time; ?>"></script>
</body>
</html>