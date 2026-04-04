<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	

	class pregunta extends DB {
	    
		
		public function getPreguntaId($pregunta_id){
			if(!empty($pregunta_id) && is_numeric($pregunta_id)){
				$sql 	= "SELECT * FROM pregunta WHERE pregunta_id = $pregunta_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function savePregunta($data){
        	extract($data);
        	$pregunta_id 		= (int) $pregunta_id;
        	$categoria_id 		= (int) $categoria_id;
        	$preg_orden 		= (int) $preg_orden;

        	$sql = "SELECT COUNT(*) FROM pregunta WHERE pregunta_id=$pregunta_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE pregunta SET preg_pregunta='$preg_pregunta', preg_respuesta='$preg_respuesta', preg_estado = '$preg_estado', preg_orden = $preg_orden WHERE pregunta_id=$pregunta_id";
	        } else {
	        	$sql = "INSERT INTO pregunta (preg_pregunta, preg_respuesta, preg_estado, preg_orden) VALUES ('$preg_pregunta', '$preg_respuesta', '$preg_estado', $preg_orden)";
	        }
	        return DB::query($sql);
	    
	    }

		public function getPreguntaAll(){
			$sql	= "SELECT 
							P.*
						FROM pregunta P
						ORDER BY preg_orden ASC";
			return 	DB::getAll( $sql );
		}


		public function deletePreguntaId($pregunta_id){
			if(!empty($pregunta_id) && is_numeric($pregunta_id)){
				$delete = array('pregunta_id' => $pregunta_id);
	        	return DB::delete('pregunta', $delete, 1 );
			}
			return false;
		}

		public function getPublicPreguntaAll(){
			$sql	= "SELECT * FROM pregunta WHERE preg_estado = 'A' ORDER BY preg_orden ASC";
			return 	DB::getAll( $sql );
		}

		public function getPreguntaByCategoriaId($categoria_id = 0){
			if(!empty($categoria_id) && is_numeric($categoria_id)){
				$sqlWhere	= "AND categoria_id = $categoria_id";
			}
			$sql	= "SELECT * FROM pregunta WHERE preg_estado = 'A' $sqlWhere ORDER BY preg_orden ASC";
			return 	DB::getAll( $sql );
		}

		

	}
?>