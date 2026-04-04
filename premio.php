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

  <title>Gana un FAN PASS para 4 personas con Bilz y Pap</title>
  <meta name="description" content="Participa con Bilz y Pap y gana un FAN PASS para 4 personas con entradas a Fantasilandia, Cineplanet, KidZania, Mampato, Lollapalooza y más" />
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon.svg" />
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="manifest" href="site.webmanifest" />
  
</head>
<body id="page-premio" class="d-flex flex-column">
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

          <!-- COLUMNA IZQUIERDA -->
          <div class="col-12 col-lg-6" style="margin-top:-110px">

            <div class="container">

              <img src="assets/img/home/funpass.png" class="img-fluid funpass d-block mx-auto" alt="Bilz y Pap">

              <div class="w-100 mt-1">
                <div class="row">
                  <div class="col ganadores text-center">
                    TU FAN PASS PARA 4 PERSONAS INCLUYE:
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 interior">

                  <!-- PREMIOS -->
                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">FANTASILANDIA</div>
                      <div class="col-7 entradas">4 ENTRADAS</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">CINEPLANET</div>
                      <div class="col-7 entradas">4 ENTRADAS</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">MAMPATO</div>
                      <div class="col-7 entradas">4 ENTRADAS</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">HAPPYLAND</div>
                      <div class="col-7 entradas">4 TARJETAS DE $20.000 C/U</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">KIDZANIA</div>
                      <div class="col-7 entradas">4 ENTRADAS</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">CHUCK N' CHEESE</div>
                      <div class="col-7 entradas">4 TARJETAS DE 30 PTOS. O 30 MIN</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">FAMILYPARK</div>
                      <div class="col-7 entradas">3 TARJETAS DE $10.000 C/U</div>
                    </div>
                  </div>

                  <div class="w-100 premio">
                    <div class="row">
                      <div class="col-5 destacado text-start">LOLLAPALOOZA*</div>
                      <div class="col-7 entradas">4 ENTRADAS GENERALES</div>
                    </div>
                  </div>

                  <!-- LEGALES -->
                  <div class="w-100">
                    <div class="row">
                      <div class="col-12">
                        <img src="assets/img/premios/txt-10-ganadores.png" class="img-fluid txt-10-ganadores" alt="">
                        <p class="legales">
                          *HASTA LA FECHA DEL EVENTO, PASADA LA FECHA, NO SE INCLUYEN ESTAS ENTRADAS.
                          <br>
                          REVISA EL DETALLE DE LOS PREMIOS EN LAS
                          <a href="assets/pdf/bases-legales.pdf" class="txt-white" target="_blank">BASES LEGALES</a>
                        </p>
                      </div>
                    </div>
                  </div>

                </div><!-- /col-12 interior -->
              </div><!-- /row -->

            </div><!-- /container -->

            <div class="is-mobile">
              <img src="assets/img/home/bill-y-mike-sm-v2.png" class="img-fluid bill-y-mike-smxxx d-block mx-auto" alt="Bilz y Pap">
            </div>

          </div><!-- /col -->

          <!-- COLUMNA DERECHA -->
          <div class="col-12 col-lg-6"></div>

        </div><!-- /row -->
      </div><!-- /container -->

      
      
    </main>
  </div>
  <?php include("include-footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="assets/js/plugins.js?<?= $time; ?>"></script>
  <script src="assets/js/main.js?<?= $time; ?>"></script>
</body>
</html>