<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	

	class cadena extends DB {
	    
		
		public function getCadenaId($cadena_id){
			if(!empty($cadena_id) && is_numeric($cadena_id)){
				$sql 	= "SELECT * FROM cadena WHERE cadena_id = $cadena_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function saveCadena($data){
        	extract($data);
        	$cadena_id 		= (int) $cadena_id;
        	$cade_orden 		= (int) $cade_orden;
        	
        	$sql = "SELECT COUNT(*) FROM cadena WHERE cadena_id=$cadena_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE cadena SET cade_nombre='$cade_nombre', cade_estado = '$cade_estado', cade_orden = $cade_orden WHERE cadena_id=$cadena_id";
	        } else {
	        	$sql = "INSERT INTO cadena (cade_nombre, cade_estado, cade_orden) VALUES ('$cade_nombre', '$cade_estado', $cade_orden)";
	        }
	        return DB::query($sql);
	    
	    }

		public function getCadenaAll(){
			$sql	= "SELECT 
							*
						FROM cadena
						ORDER BY cade_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function getCadenaPublicAll(){
			$sql	= "SELECT 
							*
						FROM cadena
						WHERE 
							cade_estado = 'A'
						ORDER BY cade_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function deleteCadenaId($cadena_id){
			if(!empty($cadena_id) && is_numeric($cadena_id)){
				$delete = array('cadena_id' => $cadena_id);
	        	return DB::delete('cadena', $delete, 1 );
			}
			return false;
		}

		

	}
?>