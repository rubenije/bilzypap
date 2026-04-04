<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	

	class codigo extends DB {
	    
		
		public function getCodigoId($codigo_id){
			if(!empty($codigo_id) && is_numeric($codigo_id)){
				$sql 	= "SELECT * FROM codigo WHERE codigo_id = $codigo_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function saveCodigo($data){
        	extract($data);
        	$codigo_id 			= (int) $codigo_id;
        	$codi_orden 		= (int) $codi_orden;
        	
        	$sql = "SELECT COUNT(*) FROM codigo WHERE codigo_id=$codigo_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE codigo SET codi_nombre='$codi_nombre', codi_estado = '$codi_estado' WHERE codigo_id=$codigo_id";
	        } else {
	        	$sql = "INSERT INTO codigo (codi_nombre, codi_estado) VALUES ('$codi_nombre', '$codi_estado')";
	        }
	        return DB::query($sql);
	    
	    }

		public function getCodigoAll(){
			$sql	= "SELECT 
							*
						FROM codigo
						ORDER BY codi_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function deleteCodigoId($codigo_id){
			if(!empty($codigo_id) && is_numeric($codigo_id)){
				$delete = array('codigo_id' => $codigo_id);
	        	return DB::delete('codigo', $delete, 1 );
			}
			return false;
		}


		public function changeEstadoInactivo($codigo_id){
			if(!empty($codigo_id) && is_string($codigo_id)){
				$codigo_id 	= strtoupper(trim($codigo_id));
				$prefix 	= substr($codigo_id, 0, 1);

        		$sql = "UPDATE codigo_".$prefix." SET codi_estado = 'I' WHERE codigo_id='$codigo_id' AND codi_estado = 'A'";
	        	return DB::query($sql);	
        	}
        	return false;
	    }


	    public function changeEstadoActivo($codigo_id){
	    	if(!empty($codigo_id) && is_string($codigo_id)){
	    		$codigo_id 	= strtoupper(trim($codigo_id));
				$prefix 	= substr($codigo_id, 0, 1);

	        	$sql = "UPDATE codigo_".$prefix." SET codi_estado = 'A' WHERE codigo_id='$codigo_id' AND codi_estado = 'I'";
		        return DB::query($sql);
	       	}
	       	return false;
	    
	    }

		public function checkCodigoById($codigo_id){
			if(!empty($codigo_id) && is_string($codigo_id)){
				$codigo_id 	= strtoupper(trim($codigo_id));
				$prefix 	= substr($codigo_id, 0, 1);
				
				$sql 	= "SELECT COUNT(*) FROM codigo_".$prefix." WHERE codigo_id = '$codigo_id' AND codi_estado = 'A' LIMIT 1";
				if( (int) DB::getOne( $sql ) ){
	        		return true;
	        	}else{
	        		return false;
	        	}
			}
			return false;		
	    }

		

	}
?>