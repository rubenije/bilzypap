<?php
    error_reporting(0); 
    if (!defined('INCLUDE_PATH')) {
        define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
    }
    include_once(INCLUDE_PATH.'class/inc.globals.php');
    include_once(INCLUDE_PATH.'class/class.inputfilter.php');
    include_once(INCLUDE_PATH.'class/class.informe.php');
  
    $objInforme = new informe();
    $objInforme->changeGanador();  


?>