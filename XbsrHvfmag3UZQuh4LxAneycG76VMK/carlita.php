<?php 
    if (!defined("INCLUDE_PATH")) {
        define("INCLUDE_PATH", "");
    }
    include_once(INCLUDE_PATH.'class/inc.globals.php');
    include_once(INCLUDE_PATH.'class/class.inputfilter.php');
    include_once(INCLUDE_PATH.'class/class.registro.php');
    
    $registro   = new registro();
    $distritos  = $registro->registrosXDistrito();
    $unicos     = $registro->usuariosUnicos();
    $carlita    = $registro->usuariosCarlita();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 m-auto">
                <h1>Usuarios Unicos : <?php echo numberFormat($carlita); ?></h1>
                <br><br><br><br> 
                <h1>Registros Diarios</h1>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                     <th scope="col">Fecha</th>
                      <th scope="col">U. Totales</th>
                      <th scope="col">U. Unicos</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($unicos as $unico) {
                          $uu = $registro->usuariosUnicosByFecha($unico->regi_fecha); 
                          $tt+= $unico->cantidad;
                          $tuu+= $uu;
                        ?>
                        <tr>
                          <td><?php echo sql2date($unico->regi_fecha); ?></td>
                          <td class="text-right"><?php echo numberFormat($unico->cantidad); ?></td>
                          <td class="text-right"><?php echo numberFormat($uu); ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td class="text-right"><?php echo numberFormat($tt); ?></td>
                          <td class="text-right"><?php echo numberFormat($tuu); ?></td>
                        </tr>
                  </tbody>
                </table>


                <h1>Registros x Distrito</h1>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                     <th scope="col">Distrito</th>
                     <th scope="col">U. Totales</th>
                     <th scope="col">U. Unicos</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($distritos as $distrito) { 
                        $dd         = $registro->registrosXDistritoRut($distrito->comu_distrito);
                        $acumulador+= $distrito->cantidad;
                        $td+= $dd;
                    ?>
                    <tr>
                      <td ><?php echo $distrito->comu_distrito; ?></td>
                      <td class="text-right"><?php echo numberFormat($distrito->cantidad); ?></td>
                      <td class="text-right"><?php echo numberFormat($dd); ?></td>
                    </tr>
                <?php } ?>
                    <tr>
                      <td></td>
                      <td class="text-right"><strong><?php echo numberFormat($acumulador); ?></strong></td>
                      <td class="text-right"><?php echo numberFormat($td); ?></td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>