<?php 
error_reporting(E_ALL);

if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', '');
}
require_once(INCLUDE_PATH.'class/class.inputfilter.php');
require_once(INCLUDE_PATH.'class/inc.globals.php');
require_once(INCLUDE_PATH.'class/class.informe.php');

$objInforme = new informe();
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-md-10 m-auto pt-4">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="informe.php">BYP</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-md-center" id="navbarNav">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="informe.php">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-enero.php">Enero</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-febrero.php">Febrero</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-marzo.php">Marzo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="informe-abril.php">Abril</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <div class="container-fluid pt-5">
      <div class="row">
        <div class="col-12 col-md-10 m-auto pt-4">
          <h4>Resumen Totales</h4>
          <?php 
            $it     = $objInforme->resumenTotales();
            $iu     = $objInforme->resumenUnicos();
          ?>
          <table class="table" style="font-size: 12px;">
            <tbody>
              <tr>
                <td>Ingresos Totales</td>
                <td class="text-center"><?= numberFormat($it); ?></td>
              </tr>
              <tr>
                <td>Ingresos Unicos</td>
                <td class="text-center"><?= numberFormat($iu); ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <br>
          <h4>Resumen Totales x Día</h4>
          <?php 
            $dias   = $objInforme->getFechaByRegistros();
          ?>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
               <th scope="col">Fecha</th>
               <th scope="col" width="25%">Totales</th>
               <th scope="col" width="25%">Unicos</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($dias as $dia){ 
                $dt = $objInforme->getResumenTotalPorDia($dia->regi_fecha);
                $du = $objInforme->getResumenUnicosPorDia($dia->regi_fecha);

                $resumenfecha[] = $dia->regi_fecha;
                $resumentotales[] = (int) $dt;
                $resumenunicos[] = (int) $du;
                
              ?>
              <tr>
                <td><?= $dia->regi_fecha; ?></td>
                <td class="text-right"><?= numberFormat($dt); ?></td>
                <td class="text-right"><?= numberFormat($du); ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <canvas id="IngresosTotalesDiarios" width="600" height="400"></canvas>
          <br>
          <br>
          <!--
          <h4>Registros x Lugar</h4>
          <?php 
            $lugares   = $objInforme->getLugares();
          ?>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
               <th scope="col">Lugar</th>
               <th scope="col" width="25%">Totales</th>
               <th scope="col" width="25%">Unicos</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($lugares as $lugar){ 
                $lubo = $objInforme->getLugaresTotalesByPremioId($lugar->premio_id);
                $luon = $objInforme->getLugaresUnicosByPremioId($lugar->premio_id);

                $lugarnombre[]   = $premio->prem_nombre;
                $lugartotales[]  = $lubo;
                $lugarunicos[]   = $luon;
              ?>
              <tr>
                <td><?= $lugar->prem_nombre; ?></td>
                <td class="text-right"><?= numberFormat($lubo); ?></td>
                <td class="text-right"><?= numberFormat($luon); ?></td>
              </tr>
              <?php 
                $totGeneral+= $lubo;
                $totUnicos+= $luon;

                } ?>
              <tr>
                <td>Total</td>
                <td class="text-right"><?= numberFormat($totGeneral); ?></td>
                <td class="text-right"><?= numberFormat($totUnicos); ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <br>

          -->

          <h4>Distritos Totales</h4>
          <?php 
            $comunas   = $objInforme->getDistritos();
          ?>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
               <th scope="col">Distrito</th>
               <th scope="col" width="25%">Totales</th>
               <th scope="col" width="25%">Unicos</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($comunas as $comuna){ 
                $cubo = $objInforme->getDistritosTotalesByNombre($comuna->comu_distrito);
                $cuon = $objInforme->getDistritosUnicosByDistrito($comuna->comu_distrito);

                $comunanombre[]   = substr($comuna->comu_distrito, 0, 15);
                $comunatotales[]  = $cubo;
                $comunaunicos[]   = $cuon;
              ?>
              <tr>
                <td><?= $comuna->comu_distrito; ?></td>
                <td class="text-right"><?= numberFormat($cubo); ?></td>
                <td class="text-right"><?= numberFormat($cuon); ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <canvas id="myChartDistrito" width="600" height="400"></canvas>

          <br>
          <br>
          <h4>Edades Totales</h4>
          <?php 
            $edades   = $objInforme->getEdades();
          ?>
          <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <tr>
               <th scope="col">Edad</th>
               <th scope="col" width="25%">Totales</th>
               <th scope="col" width="25%">Unicos</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($edades as $edad){ 
                $et = $objInforme->getRegistroByEdad($edad->regi_edad);
                $eu = $objInforme->getRegistroUnicosByEdad($edad->regi_edad);

                $edadnombre[] = $edad->regi_edad;
                $edadtotal[]  = (int) $et;
                $edadunicos[]  = (int) $eu;
                
              ?>
              <tr>
                <td><?= $edad->regi_edad; ?></td>
                <td class="text-right"><?= numberFormat($et); ?></td>
                <td class="text-right"><?= numberFormat($eu); ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <canvas id="GraficoEdad" width="600" height="400"></canvas>



          <br>
          

          

        </div>
      </div>
      
  
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
  	var chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(231,233,237)'
    };

    var ctx = document.getElementById("myChartDistrito").getContext("2d");

    var data = {
        labels: <?php echo json_encode($comunanombre); ?>,
        datasets: [
            {
                label: "Únicos",
                backgroundColor: chartColors.green,
                data: <?php echo json_encode($comunaunicos); ?>
            },
            {
                label: "Totales",
                backgroundColor: chartColors.red,
                data: <?php echo json_encode($comunatotales); ?>
            },
               
        ]
    };

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            barValueSpacing: 20,
            scales: {
                xAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        }
    });
    


    /* GIROS X DIA  */
    
    var config = {
      type: 'line',
      data: {
        labels: <?php echo json_encode($edadnombre); ?>,
        datasets: [{
          label: "Únicos",
          backgroundColor: chartColors.orange,
          borderColor: chartColors.orange,
          data: <?php echo json_encode($edadunicos); ?>,
          fill: false,
        }, {
          label: "Totales",
          fill: false,
          backgroundColor: chartColors.green,
          borderColor: chartColors.green,
          data: <?php echo json_encode($edadtotal); ?>,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Edades Totales'
        },
        tooltips: {
          mode: 'label',
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Únicos'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Totales'
            }
          }]
        }
      }
    };


    var ctx = document.getElementById("GraficoEdad").getContext("2d");
    window.myLine = new Chart(ctx, config);
    


    /* Ingresos X DIA  */
    

    var config2 = {
      type: 'line',
      data: {
        labels: <?php echo json_encode($resumenfecha); ?>,
        datasets: [{
          label: "Únicos",
          backgroundColor: chartColors.orange,
          borderColor: chartColors.orange,
          data: <?php echo json_encode($resumenunicos); ?>,
          fill: false,
        }, {
          label: "Totales",
          fill: false,
          backgroundColor: chartColors.green,
          borderColor: chartColors.green,
          data: <?php echo json_encode($resumentotales); ?>,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Resumen Ingresos Diarios'
        },
        tooltips: {
          mode: 'label',
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Fecha'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Ingresos'
            }
          }]
        }
      }
    };


    var cti = document.getElementById("IngresosTotalesDiarios").getContext("2d");
    window.myLine = new Chart(cti, config2);
    

    $(".dt-vermas").on('click', function(){
      if($('.distritos-totales').is(':hidden')) {
        $('.distritos-totales').css('display', 'block');
        $(".dt-vermas").html('Ver Menos -');

      }else{
        $('.distritos-totales').css('display', 'none'); 
        $(".dt-vermas").html('Ver Más +');
        
      }

    })


    $(".gt-vermas").on('click', function(){
      if($('.giros-totales').is(':hidden')) {
        $('.giros-totales').css('display', 'block');
        $(".gt-vermas").html('Ver Menos -');

      }else{
        $('.giros-totales').css('display', 'none'); 
        $(".gt-vermas").html('Ver Más +');
        
      }

    })
    </script>

  </body>
</html>