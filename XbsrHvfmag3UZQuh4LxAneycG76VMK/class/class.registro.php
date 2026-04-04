<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	
	include_once(INCLUDE_PATH.'class/class.log.php');	
	

	class registro extends DB {
	    
		
		public function getRegistroId($registro_id){
			if(!empty($registro_id) && is_numeric($registro_id)){
				$sql 	= "SELECT * FROM registro WHERE registro_id = $registro_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

		public function getRegistroByUid($regi_uid){
			if(!empty($regi_uid) && is_string($regi_uid)){
				$sql 	= "SELECT * FROM registro WHERE regi_uid = '$regi_uid' AND regi_estado = 'A' AND premio_id IS NULL";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function saveRegistro($data){
			$data 			= DB::filter($data);
        	extract($data);
        	
        	//$registro_id 	= (int) $registro_id;
        	$comuna_id 		= (int) $comuna_id;
			//$codi_nombre 	= strtoupper($codi_nombre);
			$regi_rut 			= trim($regi_rut);
			$regi_nacimiento	= date2sql($regi_nacimiento);
			$regi_edad 			= getEdadByFecha($regi_nacimiento);

			$regi_fecha 	= date('Y-m-d');
			$regi_hora 		= date('H:i:s');
			$regi_etiqueta  = DB::uploadFileImage('regi_etiqueta');
			
			$log = new log();
			$log->write($regi_etiqueta);

			if($regi_etiqueta){
				$filepath 	= './uploads/'.date('Ym').'/'.$regi_etiqueta;
				$regi_hash 	= hash_file('sha256', $filepath);
			}
			
	        $sql = "SELECT COUNT(*) FROM registro WHERE regi_hash='$regi_hash'";
	        $log->write($sql);

	        if (!DB::getOne($sql)) {
	        	$sql = "INSERT INTO registro (comuna_id, regi_nombre, regi_apellido, regi_rut, regi_email, regi_telefono, regi_nacimiento, regi_edad, regi_mayor, regi_bases, regi_fecha, regi_hora, regi_estado, regi_etiqueta, regi_hash) VALUES ";
				$sql.= "($comuna_id, '$regi_nombre', '$regi_apellido', '$regi_rut', '$regi_email', '$regi_telefono', '$regi_nacimiento', '$regi_edad', '$regi_mayor', '$regi_bases', '$regi_fecha', '$regi_hora', 'A', '$regi_etiqueta', '$regi_hash')";
				$log->write($sql);
	        	return DB::query($sql);
	    	}else{
	    		$log->write('Imagen ya existe en nuestros registros.');
	    	}
			return false;
			
	        
	    }


	    
	    public function getTotal($eval = 0){

	    	if($eval == 7){
	    		$where = "AND R.regi_fecha BETWEEN SUBDATE(CURDATE(), INTERVAL 1 DAY) AND CURDATE()";
	    	}
			if($eval == 15){
				$where = "AND R.regi_fecha BETWEEN SUBDATE(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
			}
	    	if($eval == 1){
	    		$where = "AND R.regi_fecha BETWEEN SUBDATE(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()";
	    	}

			$sql	= "SELECT
						count(*)
						FROM registro R
						WHERE 
							1=1
							AND R.regi_fecha != '2019-12-01'
							$where";
			return 	(int) DB::getOne( $sql );
		}


	    public function getRegistroFilterAll($data){
	    	extract($data);
	    	$fecha_desde = date2sql($fecha_desde);
	    	$fecha_hasta = date2sql($fecha_hasta);
	    	$producto_id = (int) $producto_id;
	    	
	    	if(!empty($fecha_desde) && !empty($fecha_hasta)){
	    		$whereDate = "AND R.regi_fecha >= '$fecha_desde' AND R.regi_fecha <= '$fecha_hasta' ";
	    	}
	    	if($producto_id > 0){
	    		$whereProducto = "AND R.producto_id = $producto_id";
	    	}
			$sql	= "SELECT
							R.registro_id,
							R.codi_nombre,
							R.regi_nombre,
							R.regi_telefono,
							R.regi_email,
							R.regi_rut,
							P.prod_nombre,
							TRIM(C.comu_nombre) as 'comu_nombre',
							C.comu_region,
							C.comu_distrito, 
							R.regi_fecha,
							R.regi_hora,
							R.regi_estado 
						FROM registro R
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						INNER JOIN producto P ON (P.producto_id = R.producto_id)
						WHERE 
							1=1
							$whereDate 
							$whereProducto 
							AND R.regi_fecha != '2019-12-01'
						ORDER BY 
							R.registro_id DESC";

			
			return 	DB::getAll( $sql );
		}

		public function getRegistroAll(){
			$sql = "SELECT 
							R.registro_id,
							R.regi_apellido,
							R.regi_nombre,
							R.regi_rut,
							R.regi_email,
							R.regi_telefono,
							R.regi_nacimiento,
							R.regi_edad,
							R.regi_mayor,
							R.regi_bases,
							R.regi_fecha,
							R.regi_hora,
							C.comu_nombre,
							C.comu_region,
							DATE_FORMAT(R.regi_fecha, '%Y%m') as 'regi_directorio',
							R.regi_etiqueta 
						FROM registro R
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						WHERE 
							R.regi_edad >= 17 
							AND R.regi_edad <= 100
						ORDER BY
							R.registro_id ASC 
						LIMIT 2000";

			//echo $sql;
			return 	DB::getAll( $sql );
		}


		public function deleteRegistroId($registro_id){
			if(!empty($registro_id) && is_numeric($registro_id)){
				$delete = array('registro_id' => $registro_id);
	        	return DB::delete('registro', $delete, 1 );
			}
			return false;
		}

		public function getPublicRegistroAll(){
			$sql	= "SELECT * FROM registro WHERE regi_estado = 'A' ORDER BY regi_orden ASC";
			return 	DB::getAll( $sql );
		}

	}
?>