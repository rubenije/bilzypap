<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	

	class producto extends DB {
	    
		
		public function getProductoId($producto_id){
			if(!empty($producto_id) && is_numeric($producto_id)){
				$sql 	= "SELECT * FROM producto WHERE producto_id = $producto_id";
	        	return DB::getRow( $sql );
			}
			return false;		
	    }

	    public function saveProducto($data){
        	extract($data);
        	$producto_id 		= (int) $producto_id;
        	$prod_orden 		= (int) $prod_orden;
        	
        	$sql = "SELECT COUNT(*) FROM producto WHERE producto_id=$producto_id";
	        if (DB::getOne($sql)) {
	            $sql = "UPDATE producto SET prod_nombre='$prod_nombre', prod_estado = '$prod_estado', prod_orden = $prod_orden WHERE producto_id=$producto_id";
	        } else {
	        	$sql = "INSERT INTO producto (prod_nombre, prod_estado, prod_orden) VALUES ('$prod_nombre', '$prod_estado', $prod_orden)";
	        }
	        return DB::query($sql);
	    
	    }

		public function getProductoAll(){
			$sql	= "SELECT 
							*
						FROM producto
						ORDER BY prod_orden ASC";
			return 	DB::getAll( $sql );
		}

		public function getProductoPublicAll(){
			$sql	= "SELECT producto_id, prod_nombre FROM producto ORDER BY prod_orden ASC";
			return 	DB::getAll( $sql );
		}

		public function deleteProductoId($producto_id){
			if(!empty($producto_id) && is_numeric($producto_id)){
				$delete = array('producto_id' => $producto_id);
	        	return DB::delete('producto', $delete, 1 );
			}
			return false;
		}
	}
?>