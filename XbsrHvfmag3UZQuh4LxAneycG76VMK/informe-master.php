<?php 
error_reporting(E_ALL);

if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', '');
}
require_once(INCLUDE_PATH.'class/class.inputfilter.php');
require_once(INCLUDE_PATH.'class/inc.globals.php');
require_once(INCLUDE_PATH.'class/class.informe.php');

$objInforme = new informe();
$ganadores = $objInforme->getComunasGanadores();

$comunas = $objInforme->getComunasUnicas();

if($get['opc'] == 'filter'){
  $registros = $objInforme->getRegistrosByComunaId($get['comuna_id']);
  $random    = $objInforme->getRegistrosByComunaIdRandom($get['comuna_id'], $get['registro_id']);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Informe ONLINE</title>
  </head>
  <body>
    <style type="text/css">
      .center-cropped {
        object-fit: cover;
        object-position: center;
        height: 80px;
        width: 80px;
      }
    </style>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-10 m-auto pt-4">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="informe.php">LPZ</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-md-center" id="navbarNav">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="informe.php">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-octubre.php">Octubre</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-noviembre.php">Noviembre</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-diciembre.php">Diciembre</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <?php if($registros){ ?>
    <div class="container-fluid pt-5">
      <div class="row">
        <div class="col-12 col-md-10 m-auto pt-4">

          <h4>Ganador Random</h4>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
               <th scope="col">ID</th>
               <th scope="col">Foto</th>
               <th scope="col">RUT</th>
               <th scope="col">Nombre Completo</th>
               <th scope="col">Email</th>
               <th scope="col">Fono</th>
               <th scope="col">Edad</th>
               <th scope="col">Comuna</th>

               <th scope="col">Fecha</th>
               <th scope="col">Hora</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if($random){ ?>                 
              <tr>
                <td><?= $random->registro_id; ?></td>
                <td><a href="#;" onclick="showRemoteModal('../uploads/<?= $random->regi_directorio; ?>/<?= $random->regi_etiqueta; ?>');"><img src="../uploads/<?= $random->regi_directorio; ?>/<?= $random->regi_etiqueta; ?>" width="50"></a></td>
                <td><?= $random->regi_rut; ?></td>
                <td><?= $random->regi_nombre; ?> <?= $random->regi_apellido; ?></td>
                <td><?= $random->regi_email; ?></td>
                <td><?= $random->regi_telefono; ?></td>
                <td><?= $random->regi_edad; ?></td>
                <td><?= $random->comu_nombre; ?></td>
                <td><?= $random->regi_fecha; ?></td>
                <td><?= $random->regi_hora; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <br>
          <br>
          <br>

          <h4>Registros x Comuna</h4>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
               <th scope="col">ID</th>
               <th scope="col" style="width: 80px;">Foto</th>
               <th scope="col">RUT</th>
               <th scope="col">Nombre Completo</th>
               <th scope="col">Email</th>
               <th scope="col">Fono</th>
               <th scope="col">Edad</th>
               <th scope="col">Comuna</th>
               <th scope="col">Fecha</th>
               <th scope="col">Hora</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if($registros){                 
                foreach($registros as $registro){ 
              ?>
              
              <tr>
                <td><a href="?opc=filter&comuna_id=<?= $registro->comuna_id; ?>&registro_id=<?= $registro->registro_id; ?>"><?= $registro->registro_id; ?></a></td>
                <td><a href="#;" onclick="showRemoteModal('../uploads/<?= $registro->regi_directorio; ?>/<?= $registro->regi_etiqueta; ?>');"><img src="../uploads/<?= $registro->regi_directorio; ?>/<?= $registro->regi_etiqueta; ?>" class="center-cropped"></a></td>
                <td><?= $registro->regi_rut; ?></td>
                <td><?= $registro->regi_nombre; ?> <?= $registro->regi_apellido; ?></td>
                <td><?= $registro->regi_email; ?></td>
                <td><?= $registro->regi_telefono; ?></td>
                <td><?= $registro->regi_edad; ?></td>
                <td><?= $registro->comu_nombre; ?></td>
                <td><?= $registro->regi_fecha; ?></td>
                <td><?= $registro->regi_hora; ?></td>
              </tr>
              <?php } 
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>

    <div class="container-fluid pt-5">
      <div class="row">
        <div class="col-12 col-md-10 m-auto pt-4">

            <div class="container-fluid pt-5">
              <div class="row">
                <div class="col-12 col-md-8 pt-4">

                  <h4>X Ganar</h4>
                  <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                      <tr>
                       <th scope="col">Comuna</th>
                       <th scope="col" width="25%">Cantidad</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($comunas as $comuna){ ?>
                      <tr>
                        <td><a href="?opc=filter&comuna_id=<?= $comuna->comuna_id; ?>"><?= $comuna->comu_nombre; ?></a></td>
                        <td class="text-right"><?= numberFormat($comuna->cantidad); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                
                <div class="col-12 col-md-4 pt-4">
                  <h4>Comunas Ganadoras</h4>
                  <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                      <tr>
                       <th scope="col" width="25%"></th>
                       <th scope="col">Comuna</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $i = 1;
                        foreach($ganadores as $ganador){ ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $ganador->gana_comuna; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  

                </div>

              </div>
              
          
          </div>
        </div>
      </div>
    </div>
    <!-- INI Remote Modal -->
    <div class="modal" tabindex="-1" id="remoteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Imagen Etiqueta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="" class="img-fluid" id="remoteImg">
          </div>
        </div>
      </div>
    </div>
    <!-- END Remote Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
      showRemoteModal = (path) => {
          $('#remoteImg').attr('src', path);
          const modal = new bootstrap.Modal(document.getElementById('remoteModal'));
          modal.show();
      }

    </script>
  </body>
</html>