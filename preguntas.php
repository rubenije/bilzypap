<?php 
    $time = date('His');

    if (!defined('INCLUDE_PATH')) {
      define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
    }
    session_start();
    include_once(INCLUDE_PATH . 'class/inc.globals.php');
    include_once(INCLUDE_PATH . 'class/class.inputfilter.php');
    include_once(INCLUDE_PATH . 'class/class.parametro.php');
    include_once(INCLUDE_PATH . 'class/class.pregunta.php');
    
    $pregunta   = new pregunta();
    $preguntas  = $pregunta->getPublicPreguntaAll();
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
<body id="page-preguntas" class="d-flex flex-column">
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
          <div class="col-12 col-lg-6" style="margin-top:-100px">
            <img src="assets/img/tit-frecuentes.png" class="img-fluid mx-auto d-block w-75 tit-frecuentes" alt="">
            <div class="space-20"></div>
            <div class="accordion" id="accordionBYP">
              <?php foreach($preguntas as $key => $pregunta){ 
                $isFirst = ($key === 0);
                $class = ($key == 0) ? '' : '';  
              ?>
              <div class="accordion-item">
                <div class="accordion-header" id="heading_<?= $pregunta->pregunta_id; ?>">
                  <button class="accordion-button <?= $isFirst ? '' : 'collapsed'; ?>"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse_<?= $pregunta->pregunta_id; ?>"
                    aria-expanded="<?= $isFirst ? 'true' : 'false'; ?>"
                    aria-controls="collapse_<?= $pregunta->pregunta_id; ?>">
                    <span class="me-2 icono-toggle"></span>
                    <?= $pregunta->preg_pregunta; ?>
                  </button>
              </div>
                <div id="collapse_<?= $pregunta->pregunta_id; ?>"
                  class="accordion-collapse collapse <?= $isFirst ? 'show' : ''; ?>"
                  aria-labelledby="heading_<?= $pregunta->pregunta_id; ?>"
                  data-bs-parent="#accordionBYP">
                  <div class="accordion-body">
                  <?= nl2br($pregunta->preg_respuesta); ?>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            
          </div>  
          <div class="col-12 col-lg-6"></div>
          
        </div>
      </div>
      <div class="space-60"></div>

      <div class="is-mobile">
        <img src="assets/img/home/bill-y-mike-sm-v2.png" class="img-fluid bill-y-mike-smxxx d-block mx-auto" alt="Bilz y Pap">
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