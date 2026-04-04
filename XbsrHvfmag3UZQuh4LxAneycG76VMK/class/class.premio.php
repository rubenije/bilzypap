<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	

	class premio extends DB {
	    
		
		public function getPremioId($premio_id){
			if(!empty($premio_id) && is_numeric($premio_id)){
				$sql 	= "SELECT * FROM premio WHERE premio_id = $premio_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function savePremio($data){
        	extract($data);
        	$premio_id 		= (int) $premio_id;
        	$prem_orden 		= (int) $prem_orden;
        	
        	$sql = "SELECT COUNT(*) FROM premio WHERE premio_id=$premio_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE premio SET prem_nombre='$prem_nombre',  prem_cantidad='$prem_cantidad',  prem_tipo='$prem_tipo', prem_estado = '$prem_estado', prem_orden = $prem_orden WHERE premio_id=$premio_id";
	        } else {
	        	$sql = "INSERT INTO premio (prem_nombre, prem_cantidad, prem_tipo, prem_estado, prem_orden) VALUES ('$prem_nombre', '$prem_cantidad', '$prem_tipo', '$prem_estado', $prem_orden)";
	        }
	        return DB::query($sql);
	    
	    }

		public function getPremioAll(){
			$sql	= "SELECT 
							*
						FROM premio
						ORDER BY prem_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function getPremioPublicAll(){
			$sql	= "SELECT 
							*
						FROM premio
						WHERE 
							prem_estado = 'A'
						ORDER BY prem_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function deletePremioId($premio_id){
			if(!empty($premio_id) && is_numeric($premio_id)){
				$delete = array('premio_id' => $premio_id);
	        	return DB::delete('premio', $delete, 1 );
			}
			return false;
		}

		

	}
?>