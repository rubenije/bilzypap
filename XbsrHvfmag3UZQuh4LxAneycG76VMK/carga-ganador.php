<?php
    error_reporting(E_ALL & ~E_NOTICE); 
    if (!defined('INCLUDE_PATH')) {
        define('INCLUDE_PATH', '');
    }
    include_once(INCLUDE_PATH.'class/class.home.php');
    include_once(INCLUDE_PATH.'class/class.ganador.php');
    
    $ganador  = new ganador();
    if($post['opc'] == 'loadData'){

    }
    $elements   = $ganador->changeInfo($post['data']);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("include_head.php"); ?>

    <!-- Data Tables -->
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
    <?php include("include_menu.php"); ?>
    <div id="page-wrapper" class="gray-bg">
    <?php include("include_top.php"); ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Ganador</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Ganador</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-3">
                    <p>&nbsp;</p>
                    <a href="ganadores.xlsx" class="btn btn-primary btn-lg">Plantilla Excel</a>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Instrucciones de Carga
                        </div>
                        <div class="panel-body">
                            <p>1.- Descargar la Plantilla Excel.<br>
                    2.- Hacer las modificaciones de los datos y copiar la columna E. "No eliminar la columna A"<br>
                    <img src="demo.png"><br>
                    3.- Pegar los datos en el cuadro info.<br>
                    <img src="demo2.png"><br>
                    4.- Hacer click en Guardar Cambios.<br></p>
                        </div>
                    </div>
                    
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Modificar Ganadores</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
                           <input type="hidden" name="opc" value="loadData">

                            <div class="form-group"><label class="col-sm-2 control-label">Info</label>
                                <div class="col-md-6"><textarea name="data" rows="50" class="form-control"></textarea></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        
                            
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <!-- <button class="btn btn-white" type="submit">Cancel</button>-->
                                    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <?php include("include_footer.php"); ?>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                "pageLength": 50,
                "language": {
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
        });
    </script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>

</html>