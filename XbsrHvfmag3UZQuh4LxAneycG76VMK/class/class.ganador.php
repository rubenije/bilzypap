<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	
	

	class ganador extends DB {
	    
	    public function getGanadorId($ganador_id){
			if(!empty($ganador_id) && is_numeric($ganador_id)){
				$sql 	= "SELECT * FROM ganador WHERE ganador_id = $ganador_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }


	    public function saveGanador($data){
        	extract($data);
        	$ganador_id 		= (int) $ganador_id;
        	
        	$sql = "SELECT COUNT(*) FROM ganador WHERE ganador_id=$ganador_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE ganador SET gana_rut='$gana_rut', gana_nombre='$gana_nombre', gana_comuna = '$gana_comuna', gana_estado = '$gana_estado' WHERE ganador_id=$ganador_id";
	        } else {
	        	$sql = "INSERT INTO ganador (gana_rut, gana_nombre, gana_comuna, gana_fecha, gana_estado) VALUES ('$gana_rut', '$gana_nombre', '$gana_comuna', '$gana_fecha', '$gana_estado')";
	        }
	        return DB::query($sql);
	    
	    }


	    public function getGanadorAll(){
			$sql	= "SELECT * FROM ganador ORDER BY gana_fecha ASC";
			return 	DB::getAll( $sql );
		}


		public function getGanadorPublicAll(){
			$sql		= "SELECT * FROM ganador WHERE gana_estado = 'A' ORDER BY ganador_id ASC";
			$elements  = DB::getAll( $sql );
			return toGroup($elements, 1);
		}

		public function getGanadorDelDia(){
			$date = date('Y-m-d');
			$sql = "SELECT * FROM ganador WHERE gana_estado = 'A' ORDER BY gana_fecha DESC LIMIT 1";
			return DB::getRow($sql);
		}

	
		public function deleteGanadorId($ganador_id){
			if(!empty($ganador_id) && is_numeric($ganador_id)){
				$delete = array('ganador_id' => $ganador_id);
	        	return DB::delete('ganador', $delete, 1 );
			}
			return false;
		}

	}
?>