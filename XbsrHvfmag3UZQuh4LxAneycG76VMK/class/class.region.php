<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	

	class region extends DB {
	    
		
		public function getRegionId($region_id){
			if(!empty($region_id) && is_numeric($region_id)){
				$sql 	= "SELECT * FROM region WHERE region_id = $region_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function saveRegion($data){
        	extract($data);
        	$region_id 		= (int) $region_id;
        	$regi_orden 		= (int) $regi_orden;
        	
        	$sql = "SELECT COUNT(*) FROM region WHERE region_id=$region_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE region SET regi_nombre='$regi_nombre', regi_corto='$regi_corto', regi_estado = '$regi_estado', regi_orden = $regi_orden WHERE region_id=$region_id";
	        } else {
	        	$sql = "INSERT INTO region (regi_nombre, regi_corto, regi_estado, regi_orden) VALUES ('$regi_nombre', '$regi_corto', '$regi_estado', $regi_orden)";
	        }
	        return DB::query($sql);
	    
	    }

		public function getRegionAll(){
			$sql	= "SELECT 
							*
						FROM region
						ORDER BY regi_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function deleteRegionId($region_id){
			if(!empty($region_id) && is_numeric($region_id)){
				$delete = array('region_id' => $region_id);
	        	return DB::delete('region', $delete, 1 );
			}
			return false;
		}

		

	}
?>