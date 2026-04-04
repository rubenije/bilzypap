<?php 

header("Expires: 0");
header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!defined('INCLUDE_PATH')) {
    define('INCLUDE_PATH', 'XbsrHvfmag3UZQuh4LxAneycG76VMK/');
}
require_once(INCLUDE_PATH.'class/inc.globals.php');
require_once(INCLUDE_PATH.'class/class.inputfilter.php');
require_once(INCLUDE_PATH.'class/class.registro.php');
require_once(INCLUDE_PATH.'class/class.log.php');

$server = $_SERVER['SERVER_ADDR'];

function validFileUpload($name){

    $allowedTypes = [
        'image/png' => 'png',
        'image/jpeg' => 'jpe',
        'image/jpeg' => 'jpeg',
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif',
        'image/bmp' => 'bmp'    
    ];
    $filepath = $_FILES[$name]['tmp_name'];
    $filesize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);

    
    if (!in_array($filetype, array_keys($allowedTypes))) {
        return false;
    }
    

    //if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
    $maxFileSize = 20485760;
    if($filesize > $maxFileSize){
        return false;
    }
    
    return true;
}

$log = new log();

if($post['opc'] == 'sendFormHome' && !empty($post['recaptchaResponse'])){
//if($post['opc'] == 'sendFormHome'){

    header('Content-Type: application/json');

    //$isValidRecapcha = validate_rechapcha($post['recaptchaResponse']);
    if(empty($post['regi_nombre'])){
        $json 	= array('status' => 'fail', 'data' => array('field' => 'regi_nombre', 'message' => 'Campo nombre es requerido') );
        echo json_encode($json);
        exit;
    }
    if(empty($post['regi_apellido'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_apellido', 'message' => 'Campo apellido es requerido') );
        echo json_encode($json);
        exit;
    }
    if(empty($post['comuna_id'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'comuna_id', 'message' => 'Debe seleccionar una Comuna') );
        echo json_encode($json);
        exit;
    }
    if(empty($post['regi_telefono'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_telefono', 'message' => 'Campo teléfono es requerido') );
        echo json_encode($json);
        exit;
    }
    if(empty($post['regi_email'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_email', 'message' => 'Campo email es requerido') );
        echo json_encode($json);
        exit;
    }
    if(!isValidEmail($post['regi_email'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_email', 'message' => 'Campo email no es válido') );
        echo json_encode($json);
        exit;
    }
    if(empty($post['regi_rut'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_rut', 'message' => 'Campo rut es requerido') );
        echo json_encode($json);
        exit;
    }
    if(!isValidRut($post['regi_rut'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_rut', 'message' => 'Campo rut no es válido') );
        echo json_encode($json);
        exit;
    }
    if(empty($post['regi_nacimiento'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_nacimiento', 'message' => 'Campo fecha de nacimiento es requerido') );
        echo json_encode($json);
        exit;
    }
    if(!isValidEdad($post['regi_nacimiento'])){
        $json = array('status' => 'fail', 'data' => array('field' => 'regi_nacimiento', 'message' => 'Campo fecha de nacimiento no es válido') );
        echo json_encode($json);
        exit;
    }

    $isValidFile = validFileUpload('regi_etiqueta');

    $msg = "regi_nombre : ".$post['regi_nombre']."\n";
    $msg.= "regi_apellido : ".$post['regi_apellido']."\n";
    $msg.= "comuna_id : ".$post['comuna_id']."\n";
    $msg.= "regi_telefono : ".$post['regi_telefono']."\n";
    $msg.= "regi_email : ".$post['regi_email']."\n";
    $msg.= "regi_rut : ".$post['regi_rut']."\n";
    $msg.= "regi_nacimiento : ".$post['regi_nacimiento']."\n";
    $msg.= "isValidFile : ".$isValidFile."\n";
    $msg.= "isValidRecapcha : ".$isValidRecapcha."\n";
     
    $log->write($msg);
    
    if( $isValidFile ){
    //if( $isValidRecapcha && $isValidFile ){
        $uid = uniqid();
        $post['regi_uid'] = $uid;
        $registro = new registro();
        $save = $registro->saveRegistro($post);
        
        $log->write('save : '.$save);
        if($save){

            $_SESSION['SAVE']               = true;
            $_SESSION['UID']                = $uid;
            $_SESSION['REGI_NOMBRE']        = $post['regi_nombre'];
            $_SESSION['REGI_APELLIDO']      = $post['regi_apellido'];
            $_SESSION['COMUNA_ID']          = $post['comuna_id'];
            $_SESSION['REGI_TELEFONO']      = $post['regi_telefono'];
            $_SESSION['REGI_EMAIL']         = $post['regi_email'];
            $_SESSION['REGI_RUT']           = $post['regi_rut'];
            $_SESSION['REGI_NACIMIENTO']    = $post['regi_nacimiento'];
            
            $json = array('status' => 'success', 'modal' => 'modalFelicidades', 'message' => 'Premio seleccionado correctamente');
            echo json_encode($json);
            exit;
        }else{
            $json   = array('status' => 'error', 'modal' => 'modalUps', 'type' => 'save');
            echo json_encode($json);
            exit;
        }
    }
    
}

?>