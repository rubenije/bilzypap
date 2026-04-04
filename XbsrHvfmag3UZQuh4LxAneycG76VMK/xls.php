<?php
    error_reporting(0); 
    if (!defined('INCLUDE_PATH')) {
        define('INCLUDE_PATH', '');
    }
    include_once(INCLUDE_PATH.'class/inc.globals.php');
    include_once(INCLUDE_PATH.'class/class.inputfilter.php');
    include_once(INCLUDE_PATH.'class/class.informe.php');

    $mes = $get['mes'];

    $objInforme = new informe();
    $elements   = $objInforme->getRegistrosByMes($mes);

    header('Content-type: application/excel');
    $filename = 'registros-'.$mes.'.xls';
    header('Content-Disposition: attachment; filename='.$filename);

    $data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
    <head>
        <!--[if gte mso 9]>
        <xml>
            <x:ExcelWorkbook>
                <x:ExcelWorksheets>
                    <x:ExcelWorksheet>
                        <x:Name>Sheet 1</x:Name>
                        <x:WorksheetOptions>
                            <x:Print>
                                <x:ValidPrinterInfo/>
                            </x:Print>
                        </x:WorksheetOptions>
                    </x:ExcelWorksheet>
                </x:ExcelWorksheets>
            </x:ExcelWorkbook>
        </xml>
        <![endif]-->
    </head>

    <body>
        <table>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Rut</td>
                <td>Email</td>
                <td>Comuna</td>
                <td>Región</td>
                <td>Distrito</td>
                <td>Teléfono</td>
                <td>Nacimiento</td>
                <td>Edad</td>
                <td>Mayor</td>
                <td>Bases</td>
                <td>Fecha</td>
                <td>Hora</td>
            </tr>';
    foreach ($elements as $element) { 
        
    $data.= '<tr>
                <td>'.$element->registro_id.'</td>
                <td>'.strtoupper(html_entity_decode($element->regi_nombre)).'</td>
                <td>'.strtoupper(html_entity_decode($element->regi_apellido)).'</td>
                <td>'.$element->regi_rut.'</td>
                <td>'.$element->regi_email.'</td>
                <td>'.$element->comu_nombre.'</td>
                <td>'.$element->comu_region.'</td>
                <td>'.$element->comu_distrito.'</td>
                <td>'.$element->regi_telefono.'</td>
                <td>'.$element->regi_nacimiento.'</td>
                <td>'.$element->regi_edad.'</td>
                <td>'.$element->regi_mayor.'</td>
                <td>S</td>
                <td>'.sql2date($element->regi_fecha).'</td>
                <td>'.$element->regi_hora.'</td>
            </tr>';
    }
    $data.= '</table>
    </body></html>';

    echo $data;
?>