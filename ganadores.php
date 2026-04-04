<?php 
    $time = date('His');

    if (!defined('INCLUDE_PATH')) {
      define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
    }
  
    include_once(INCLUDE_PATH . 'class/class.inputfilter.php');
    include_once(INCLUDE_PATH . 'class/class.parametro.php');
    include_once(INCLUDE_PATH . 'class/class.ganador.php');

    $ganador    = new ganador();
    $gruped     = $ganador->getGanadorPublicAll();
    $destacado  = $ganador->getGanadorDelDia();
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
<body id="page-ganadores" class="d-flex flex-column">
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
          
          <div class="space-100"></div>
          <div class="col-12 col-lg-7 text-center"><!-- Alto del contenido -->
              <!-- Centrado -->
              <div class="w-100">
                <img src="assets/img/txt-ganador.png" class="img-fluid ganadores-de-la-semana d-block mx-auto" alt="">
              </div>
              <p class="titulo">10 SEMANAS DE PREMIOS</p>
              <div class="destacado">
                <div class="fecha semana">1</div>/<div class="fecha">10</div>
              </div>
              
              

            <div id="carouselLPC" class="carousel slide" data-bs-interval="false" data-bs-wrap="false">
              <div class="carousel-inner">
                <?php 
                $indice = 1;
                foreach ($gruped as $key => $ganadores) { 
                  $class = ($key == 0) ? 'active' : '';
                ?>
                <div class="carousel-item <?= $class; ?>">
                  <table class="table todos">
                      <tr>
                        <td scope="col" class="tit_nombre"><div class="titulo mx-auto">NOMBRE</div></td>
                        <td scope="col" class="tit_rut"><div class="titulo mx-auto">RUT</div></td>
                        <td scope="col" class="tit_premio"><div class="titulo mx-auto">PREMIO</div></td>
                      </tr>
                      <?php foreach ($ganadores as $key => $ganador) { ?>
                      <tr>
                        <td><div class="detalle tit_nombre"><?= $ganador->gana_nombre; ?></div></td>
                        <td><div class="detalle tit_rut"><?= $ganador->gana_rut; ?></div></td>
                        <td><div class="detalle tipo tit_premio"><?= $ganador->gana_premio; ?></div></td>
                      </tr>
                    <?php 
                    $indice++;
                    } ?>
                  </table>
                </div>
              <?php } ?>
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselLPC" data-bs-slide="prev">
                <img src="assets/img/btn-prev.png" alt="Anterior" class="img-fluid" style="width:40px;">
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselLPC" data-bs-slide="next">
                <img src="assets/img/btn-next.png" alt="Anterior" class="img-fluid" style="width:40px;">
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!-- Centrado -->
          </div>
          
          <div class="col-12 col-lg-5"></div>
            
            

        </div>
      </div>

      <div class="is-mobile">
        <img src="assets/img/home/bill-y-mike-sm-v2.png" class="img-fluid bill-y-mike-smxxxx d-block mx-auto" alt="Bilz y Pap">
      </div>
      
    </main>
  </div>
  <?php include("include-footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="assets/js/plugins.js?<?= $time; ?>"></script>
  <script src="assets/js/main.js?<?= $time; ?>"></script>
  <script>
    $(function () {
      const $carousel = $('#carouselLPC');
      const $semanaEl = $('.destacado .semana');
      // OJO: aquí tomamos SOLO el segundo ".fecha" (el total), no ambos
      const $totalEl  = $('.destacado .fecha').last();

      const slidesPerWeek = 1;
      const totalSlides   = $carousel.find('.carousel-item').length;
      const totalWeeks    = Math.max(1, Math.ceil(totalSlides / slidesPerWeek));
      $totalEl.text(totalWeeks); // pinta el total real de semanas

      function updateSemanaByIndex(idx) {
        const semana = Math.floor(idx / slidesPerWeek) + 1; // 0,1 => 1; 2,3 => 2; etc.
        $semanaEl.text(semana);
      }

      // Instancia nativa de Bootstrap 5 (no jQuery plugin)
      const el        = document.getElementById('carouselLPC');
      const instance  = bootstrap.Carousel.getOrCreateInstance(el, { interval: false, wrap: false });

      // Índice del primer slide de la última semana
      // (si hay 4 slides y 2 por semana => índice 2)
      const startIndex = Math.floor((totalSlides - 1) / slidesPerWeek) * slidesPerWeek;

      // Posiciona el carrusel en la última semana y actualiza el indicador
      instance.to(startIndex);
      updateSemanaByIndex(startIndex);

      // Al terminar cada transición, actualiza la semana mostrada
      $carousel.on('slid.bs.carousel', function (e) {
        const targetIndex = (typeof e.to === 'number') ? e.to : $(e.relatedTarget).index();
        updateSemanaByIndex(targetIndex);
      });
    });
  </script>

</body>
</html>