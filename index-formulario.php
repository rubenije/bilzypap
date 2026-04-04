<?php 
    $time = date('His');

    if (!defined('INCLUDE_PATH')) {
      define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
    }
    session_start();
    include_once(INCLUDE_PATH . 'class/class.inputfilter.php');
    include_once(INCLUDE_PATH . 'class/class.parametro.php');
    include_once(INCLUDE_PATH . 'class/class.comuna.php');
    
    $comuna   = new comuna();
    $comunas  = $comuna->getComunaPublicAll();

    $dia = date('d');
    $mes = date('m');
    $anio = '1924';

    $diaActual = $dia.'/'.$mes.'/'.$anio;

    //unset($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.min.css?<?= $time; ?>" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js?render=6LcMkaQrAAAAAP4UHxL0qKmeeriS2xPM4f2jZ0lh"></script>

  <title>Gana un FAN PASS para 4 personas con Bilz y Pap</title>
  <meta name="description" content="Participa con Bilz y Pap y gana un FAN PASS para 4 personas con entradas a Fantasilandia, Cineplanet, KidZania, Mampato, Lollapalooza y más" />
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon.svg" />
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="manifest" href="site.webmanifest" />
  
</head>
<body id="formulario" class="d-flex flex-column">
    <div class="layout-bg">
    <!-- HEADER -->
    <header class="text-white text-center">
      <?php include("include-menu.php"); ?>
    </header>

    <!-- CONTENIDO -->
    <main class="container-fluid">
      <img src="assets/img/home/bill-y-mike-v1.png" class="img-fluid bill-y-mike is-desktop" alt="Bilz y Pap">
      
      <div class="container">
        <div class="row">
          
          <div class="col-12 col-lg-6" style="margin-top:-110px">
              <img src="assets/img/home/tit-1-rellena-y-participa.png" class="rellena d-block mx-auto w-75" alt="">
              <div class="space-10"></div>
              <!-- INI FORMULARIO -->
                <form action="" id="formRegistro" class="d-block mx-auto">
                    <input type="hidden" name="opc" value="sendFormHome">
                    <input type="hidden" name="recaptchaResponse" id="recaptchaResponse">

                    <div class="field">
                        <input class="isUpper" type="text" name="regi_nombre" id="regi_nombre" placeholder=" " value="<?= $_SESSION['REGI_NOMBRE']; ?>">
                        <label for="regi_nombre">NOMBRE</label>
                    </div>
                    <div id="regi_nombre_help" class="form-text"></div>

                    <div class="field">
                        <input class="isUpper" type="text" name="regi_apellido" id="regi_apellido" placeholder=" " value="<?= $_SESSION['REGI_APELLIDO']; ?>">
                        <label for="regi_apellido">APELLIDO</label>
                    </div>
                    <div id="regi_apellido_help" class="form-text"></div>

                    <div class="field">
                        <select id="comuna_id" name="comuna_id" aria-label="COMUNA">
                        <option value="" selected>COMUNA</option>
                        <?php foreach ($comunas as $comuna) { ?>
                            <option value="<?php echo $comuna->comuna_id; ?>" <?php if($comuna->comuna_id == $_SESSION['COMUNA_ID']){ echo "selected"; } ?>><?php echo $comuna->comu_nombre; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div id="comuna_id_help" class="form-text"></div>


                    <div class="field">
                        <input type="text" name="regi_telefono" id="regi_telefono" placeholder=" " value="<?= $_SESSION['REGI_TELEFONO']; ?>">
                        <label for="regi_telefono">TELÉFONO</label>
                    </div>
                    <div id="regi_telefono_help" class="form-text"></div>


                    <div class="field">
                        <input class="isLower" type="email" name="regi_email" id="regi_email" placeholder=" " value="<?= $_SESSION['REGI_EMAIL']; ?>">
                        <label for="regi_email">MAIL</label>
                    </div>
                    <div id="regi_email_help" class="form-text"></div>

                    <div class="field">
                        <input type="text" name="regi_rut" id="regi_rut" placeholder=" " onChange="formateaRut(this,'XXXXXXX-X');" value="<?= $_SESSION['REGI_RUT']; ?>">
                        <label for="regi_rut">RUT</label>
                    </div>
                    <div id="regi_rut_help" class="form-text"></div>

                    <div class="field">
                        <input type="text" name="regi_nacimiento" id="regi_nacimiento" inputmode="numeric" placeholder=" " value="<?= $_SESSION['REGI_NACIMIENTO']; ?>">
                        <label for="regi_nacimiento">FECHA NACIMIENTO dd/mm/yyyy</label>
                    </div>
                    <div id="regi_nacimiento_help" class="form-text"></div>


                    <div class="field">
                        <div class="upload">
                          <div class="container p-1">
                              <div class="row">
                              <div class="col-5">
                                  <p>FOTO BOTELLA<br>CON ETIQUETA<br>PROMOCIONAL</p>
                              </div>
                              <div class="col-7">
                                  <div class="seleccion">
                                  <span>(Haz click para adjuntar foto)</span>
                                  <img src="assets/img/home/ico-upload.png" class="img-fluid btnUpload" alt="Upload">
                                  </div>
                              </div>
                              </div>
                          </div>
                        </div>
                        <input type="file" 
                        id="regi_etiqueta" 
                        name="regi_etiqueta" 
                        accept="image/jpeg, image/png" 
                        style="display: none;"
                        onchange="showPreview(this)">
                        <!--   
                        <div id="targetLayer" class="text-center"></div>
                        -->
                    </div>
                    <div id="regi_etiqueta_help" class="form-text"></div>

                    <div class="bg-azul">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="S" id="regi_bases" name="regi_bases">
                            <label class="form-check-label" for="regi_bases">
                            He leído y acepto los <a href="assets/pdf/terminos-y-condiciones.pdf" target="_blank" class="text-white">términos y condiciones</a> del sitio web, las<br><a href="assets/pdf/bases-legales.pdf" class="text-white" target="_blank">políticas de privacidad y bases legales</a> de la promoción.
                            </label>
                        </div>
                        <div id="regi_bases_help" class="form-text"></div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="S" id="regi_mayor" name="regi_mayor">
                            <label class="form-check-label" for="regi_mayor">
                            Soy mayor de 18 años.
                            </label>
                        </div>
                        <div id="regi_mayor_help" class="form-text"></div>
                    </div>
                    <!-- 
                    <button type="submit" class="btn btn-primary btnEnviar">Enviar</button>
                    -->
                    <div class="text-end">
                      <button type="submit" class="btn btn-img btnEnviar p-0 border-0 bg-transparent" aria-label="Enviar solicitud">
                        
                      <img src="assets/img/home/btn-enviar.png"
                            alt="Enviar solicitud"
                            class="img-fluid hvr-pulse btnEnviar btn-img"
                            style="display:block; width: 180px; height: auto; margin-top: -20px;">
                      </button>
                    </div>
                    

                    </form>
              <!-- END FORMULARIO -->
              


          </div>
          <div class="col-12 col-lg-6"></div>
        </div>
      </div>


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