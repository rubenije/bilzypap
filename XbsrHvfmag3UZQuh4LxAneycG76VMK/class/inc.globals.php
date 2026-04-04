<?php
setlocale(LC_ALL, 'es_ES');

function isValidRut($rut){
    $rut = preg_replace('/[^k0-9]/i', '', $rut);
    $dv  = substr($rut, -1);
    $numero = substr($rut, 0, strlen($rut)-1);
    $i = 2;
    $suma = 0;
    foreach(array_reverse(str_split($numero)) as $v)
    {
        if($i==8)
            $i = 2;

        $suma += $v * $i;
        ++$i;
    }

    $dvr = 11 - ($suma % 11);

    if($dvr == 11)
        $dvr = 0;
    if($dvr == 10)
        $dvr = 'K';

    if($dvr == strtoupper($dv))
        return true;
    else
        return false;
}

function isValidEdad($fecha){

    $mayor = 18;
    $nacio = DateTime::createFromFormat('Y-m-d', date2sql($fecha));
    $calculo = $nacio->diff(new DateTime());

    $edad =  $calculo->y;    

    if ($edad < $mayor){
        //echo "Usted es menor de edad. Su edad es: $edad\n";
        return false;  
    }else{
        //echo "Usted es mayor de edad. Su edad es: $edad\n";
        return true;  
    }
}

function isValidEmail($email){
    if(!empty($email) && is_string($email)){

        $sanitize = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($sanitize, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }
    return false;
}

if(!function_exists('mime_content_type')) {

    function mime_content_type($filename) {

        $mime_types = array(

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
}

function validate_rechapcha($response){
	// Verifying the user's response (https://developers.google.com/recaptcha/docs/verify)
	$verifyURL = 'https://www.google.com/recaptcha/api/siteverify';
	
	// Collect and build POST data
	$post_data = http_build_query(
		array(
			'secret' => '6LcMkaQrAAAAAAO_UH4De7002g0KzpYtX0cHRx8p',
			'response' => $response,
			'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
		)
	);
	
	// Send data on the best possible way
	if(function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec')) {
		// Use cURL to get data 10x faster than using file_get_contents or other methods
		$ch =  curl_init($verifyURL);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
			$response = curl_exec($ch);
		curl_close($ch);
	} else {
		// If server not have active cURL module, use file_get_contents
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $post_data
			)
		);
		$context  = stream_context_create($opts);
		$response = file_get_contents($verifyURL, false, $context);
	}

    // Verify all reponses and avoid PHP errors
	if($response) {
		$result = json_decode($response);
		if ($result->success===true) {
			return true;
		} else {
			return $result;
		}
	}

	// Dead end
	return false; 
}

function getEdadByFecha($fecha_nacimiento){
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}


function checkCodeLaPromoZero($codi_nombre){
    $codi_nombre  = strtoupper(str_replace(' ', '', $codi_nombre));
    $caracteres   = strlen($codi_nombre);
    if($caracteres == 7){
      return ctype_alnum($codi_nombre);
    }
    return false;
}

function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
  // Cálculo de la distancia en grados
  $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
  // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
  switch($unit) {
    case 'km':
      $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
      break;
    case 'mi':
      $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
      break;
    case 'nmi':
      $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
  }
  return round($distance, $decimals);
}

function addCeros($numero,$ceros) {
  $order_diez = explode(".",$numero);
  $dif_diez = $ceros - strlen($order_diez[0]);
  for($m = 0 ;
  $m < $dif_diez;
   $m++)
  {
          @$insertar_ceros .= 0;
  }
  return $insertar_ceros .= $numero;
}


/* Convierte una cadena en formato dd/mm/aaaa a formato de mysql */
function date2sql( $date ) {
    $explode = explode('/', $date);
  return $explode[2].'-'.$explode[1].'-'.$explode[0];
  /*
  if (empty($date)) {
        return;
    }
    list( $day, $month, $year) = split( '[/.-]', $date );   
    return str_pad($year, 4, "0", STR_PAD_LEFT) . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . str_pad($day, 2, "0", STR_PAD_LEFT);
  */
}

/* Convierte una cadena en formato mysql a formato dd/mm/aaaa */
function sql2date( $date ) {
    $explode = explode('-', $date);
  return $explode[2].'/'.$explode[1].'/22';
  
  /*
  if (empty($date)) {
        return;
    }
    list( $year, $month, $day) = split( '[/.-]', $date );
    return str_pad($day, 2, "0", STR_PAD_LEFT) . "/" . str_pad($month, 2, "0", STR_PAD_LEFT) . "/" . str_pad($year, 4, "0", STR_PAD_LEFT);
  */
}

/* Asigna un valor por defecto en caso de que $var sea vacia, sino devuelve el mismo valor */
function nvl( $var, $value ) {
   if (empty($var) || is_null($var)) return $value;
   else return $var;
}

/* Convierte un valor en paginas a su valor en filas (filas comenzado desde 0) */
function pages2rows ( $page, $maxrows ) {
    return ( $page - 1 ) * $maxrows;
}

/* Convierte un valor en filas a su valor en paginas */
function rows2pages ($rows, $maxrows) {
    if ($maxrows > 0 && $rows > 0) {
        return ((int) ($rows/$maxrows)) + (1 and $rows%$maxrows);
    } else {
        return false;
    }
}

/* Sube archivos borrando el anterior con algunas validaciones extras */
function upload ($file, $filename, $oldfile="") {

    // Sube el archivo solo si no es el mismo
    if ($filename!=$oldfile) {

        // Borrar el anterior
        if (!empty($oldfile)) unlink($oldfile);

        // Finalmente subir el archivo
        if (!empty($filename) && is_uploaded_file($file)) {

            if (move_uploaded_file($file, $filename)) {

            };
        }

    }

}

function debug($message) {
	if ($GLOBALS["debug"]) echo $message."<br>";
}

function dbg() {
	$GLOBALS["debug"]=!$GLOBALS["debug"];
}

function str_trunc($string, $length, $text="...") {
	if (strlen($string) > $length) return substr($string, 0, $length).$text;
	else return $string;
}

function show_error ($message, $exit=false) {
	echo "<font color=\"FF0000\"><b>Error:</b></font><br>&nbsp;<br>$message";
	if ($exit) exit();
}

function numberFormat($number) {
	return number_format($number, 0, ",", ".");
}

function is_number($value) {
    if (function_exists('is_numeric')) {
        return is_numeric($value);
    }
    if (function_exists('preg_match')) {
        return preg_match('/^[0-9]+$/', $value);
    }
    if (function_exists('ereg')) {
        return ereg('^[0-9]+$', $value);
    }
    return false;
}

function request($var) {
    if (array_key_exists($var, $_REQUEST)) {
        return $_REQUEST[$var];
    } else {
        return null;
    }
}

function br2empty($value) {
    $value = preg_replace('/\n/m', '', $value);
    $value = preg_replace('/\r/m', '', $value);
	return $value;
}

function charTr($text) {
	$translation_table = array(
		"á" => "a", 
		"é" => "e",
		"í" => "i",
		"ó" => "o",
		"ú" => "u");
	return strtr($text, $translation_table);		
}	

function serializeObjectArray($array) {
	if (is_array($array)) {
		foreach($array as $key => $mixedVar){
			if (gettype($mixedVar) == "object") {

				if (method_exists($mixedVar, "toString") && method_exists($mixedVar, "value")) {
					$objects[] = "value=".$mixedVar->value()."&text=".$mixedVar->toString();
				} else {
					$vars = get_object_vars($mixedVar);

					foreach($vars as $name => $value) {
						$text[] = $name."=".$value;
					}

					$objects[] = implode("&", $text);
				}
			} 
		}
		return implode("|", $objects);
	}
}

/* Verifica si $value es un correo valido */
function isMail($value) {
	return eregi("^([a-zA-Z0-9_\\-]+\\.{0,1})+@([a-zA-Z0-9_\\-]+\\.)+[a-zA-Z0-9_\\-]+$", $value);    
}
function getMonth($month) {
	$months="Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre";
	$months=explode(",", $months);	
	return $months[$month - 1];
}

function getLongDate($day = NULL, $month = NULL, $year = NULL) {
	if (is_null($day) && is_null($month) && is_null($year)) {	
		list($day, $month, $year) = explode("/", date("j/n/Y"));
	}
	return $day." de ".getMonth($month)." de ".$year;
}

function pre (&$var) {
    echo "<pre>" . var_export($var, true) . "</pre>";
}


function getExtension($file) {
	echo $file."<br>";
  	$pos = strrpos($file, '.');
  	if(!$pos) {
    	return 'Unknown Filetype';
  	}
  	$str = substr($file, $pos, strlen($file));
  	return $str;
}

function check_mask ($addr, $cidr) {
    list($ip, $mask) = explode('/', $cidr);
    $mask = intval($mask);
  //  echo "<pre>$ip - $mask - $addr - $cidr</pre>";
  
    if ($mask < 1 || $mask > 32) {
        return false;
    }
    if (check_addr($ip) && check_addr($addr)) {
        $mask = 0xffffffff << (32 - $mask);
        return intval(((ip2long($addr) & $mask) == (ip2long($ip) & $mask)));
    } else {
        return false;
    }
}

function check_addr ($addr) {
    $ip = ip2long($addr);
    if ($ip == -1 || $ip == false) {
        return false;
    }
    return true;
}

function check_remoteaddr ($strhosts) {
    $hosts = array();
    if (ereg(';', $strhosts)) {
        $hosts = split(';', $strhosts);
    } else {
        return check_mask($_SERVER['REMOTE_ADDR'], $strhosts);
    }
    $isok = false;
    foreach ($hosts as $host) {
        if (check_mask($_SERVER['REMOTE_ADDR'], $host)) {
            $isok = true;
        }
    }
    return $isok;
}

function quot2htmlcode($value) {
	return preg_replace('/(\")/m', '&quot;', $value);
}

//funciones de encriptado y desencriptado - mover a un archivo global.
function encrypt($string, $key = '') {
	$key = $_SERVER[SERVER_NAME]; // mod by Jean
   	$result = '';
   	
   	for($i=0; $i<strlen($string); $i++) {
    	$char = substr($string, $i, 1);
     	$keychar = substr($key, ($i % strlen($key))-1, 1);
     	$char = chr(ord($char)+ord($keychar));
     	$result.=$char;
   	}
	return base64_encode($result);
}
 
function decrypt($string, $key = '') {
	$key = $_SERVER[SERVER_NAME]; // mod by Jean
   	$result = '';
  	$string = base64_decode($string);
 
   	for($i=0; $i<strlen($string); $i++) {
    	$char = substr($string, $i, 1);
     	$keychar = substr($key, ($i % strlen($key))-1, 1);
    	$char = chr(ord($char)-ord($keychar));
     	$result.=$char;
   	}
 	return $result;
}


function randomPassword(){
	$len 	= 6;
    $pass 	= '';
    $lchar 	= 0;
    $char 	= 0;

    for($i = 0; $i < $len; $i++){
    	while($char == $lchar){
        	$char = rand(48, 109);
            if($char > 57) $char += 7;
            if($char > 90) $char += 6;
        }
		$pass .= chr($char);
        $lchar = $char;
   	}
	return $pass;
}

function date2varchar($fecha) {
	$trozo= explode("/", $fecha);
			
	return $trozo[2].$trozo[1].$trozo[0];
}



/**
 * Retorna el nombre del día. Ejemplo: Lunes.
 *
 * @return string
 */
function getNombreDia(){
	$dia_actual = date("w");
	$dias = array(0 => 'Domingo',1 => 'Lunes',2 => 'Martes',3 => 'Miercoles',4 => 'Jueves',5 => 'Viernes',6 => 'Sabado');
	return $dias[$dia_actual];
}

function toGroup(&$elements, $numItems = 2) {
    $lines = array();
    if (is_array($elements)) {
        $item = true;

        $item = current($elements);
        while($item) {
            $line = array();
            for ($i = 1; $item && $i <= $numItems; $i++) {
                $line[] = $item;
                $item = next($elements);
            }
            $lines[] = $line;
        }

    }
    return $lines;
}

/**
 * Retorna el nombre del Mes. Ejemplo: Enero.
 *
 * @return string
 */
function getMes($mes = NULL){
	$mes_actual = (is_null($mes)) ? date("n") : $mes;
	$meses = array(1 => 'Enero',2 => 'Febrero',3 => 'Marzo',4 => 'Abril',5 => 'Mayo',6 => 'Junio',7 => 'Julio',8 => 'Agosto',9 => 'Septiembre',10 => 'Octubre',11 => 'Noviembre',12 => 'Julio');
	return $meses[$mes_actual]; 
}

/**
 * Retorna la fecha actual en formato: Jueves 5 de Junio de 2007
 *
 * @return string
 */
function getFechaUCV(){
	$dia = date("d");
	$anio = 	date("Y");
	$fecha = getNombreDia()." ".$dia." de ".getMes()." del ".$anio;
	return 	$fecha;
}

function diaSemana($fecha, $texto = 1){ 
	if(empty($fecha)){
		$fecha = date('Y-m-d');
	}
    list($ano,$mes,$dia) = explode("-",$fecha);
    $numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
     
      if ($texto == 0)
        return $numerodiasemana;
      
      switch($numerodiasemana)
      {
         case 0: return "DOMINGO";
         case 1: return "LUNES";
         case 2: return "MARTES";
         case 3: return "MIERCOLES";
         case 4: return "JUEVES";
         case 5: return "VIERNES";
         case 6: return "SABADO";
      }
}

function getFechaIntercambio($date){
	$explode = explode("-",$date);
	$mes = getMes((int) $explode[1]);
	$dia = ucfirst(strtolower(diaSemana($date)));
	$dateFormat = "$dia ".$explode[2]." de $mes - ".$explode[0];
	return $dateFormat;
}


function getNumeroCamiseta(){
  for ($i=0; $i < 100 ; $i++) { 
    $num[] = $i;
  }
  return $num;
}



?>