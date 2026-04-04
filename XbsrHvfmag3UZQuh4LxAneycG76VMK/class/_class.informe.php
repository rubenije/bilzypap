<?php 

	if (!defined("INCLUDE_PATH")) {
		define("INCLUDE_PATH", "");
	}
	include_once(INCLUDE_PATH.'class/class.DB.php');	
	include_once(INCLUDE_PATH.'class/class.log.php');	
	

	class informe extends DB {

		public $meses = '08,09,10';


		/* RESUMEN TOTALES */
		public function resumenTotales(){
			$sql = "SELECT 
						count(*) as total 
					FROM registro R
					INNER JOIN premio P ON (P.premio_id = R.premio_id) 
					WHERE 
						R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
			return (int) DB::getOne( $sql );
		}
		


		/* RESUMEN UNICOS */
		public function resumenUnicos(){
			$sql = "SELECT 
						distinct(regi_rut) 
					FROM registro R 
					INNER JOIN premio P ON (P.premio_id = R.premio_id)
					WHERE 
						R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
			$elements = DB::getAll( $sql );
			return count($elements);
		}

		/* RESUMEN TOTALES X DIA */
		public function getFechaByRegistros(){
			$sql = "SELECT 
						distinct(R.regi_fecha) 
					FROM registro R 
					INNER JOIN premio P ON (P.premio_id = R.premio_id)
					WHERE 
						R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses) ORDER BY R.regi_fecha DESC";
			return DB::getAll( $sql );
		}


		
		public function getResumenTotalPorDia($regi_fecha){
			if(!empty($regi_fecha) && is_string($regi_fecha)){
				$sql = "SELECT 
							count(*) as total 
						FROM registro R 
						INNER JOIN premio P ON (P.premio_id = R.premio_id)
						WHERE 
							R.regi_fecha = '$regi_fecha' AND R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
				return DB::getOne( $sql );
			}
			return false;
		}

		public function getResumenUnicosPorDia($regi_fecha){
			$sql = "SELECT 
						distinct(regi_rut) 
					FROM registro R 
					INNER JOIN premio P ON (P.premio_id = R.premio_id)
					WHERE 
						R.regi_fecha = '$regi_fecha' AND R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
			$elements = DB::getAll( $sql );
			return count($elements);
		}


		/* RESUMEN POR DISTRITO TOTALES */
		public function getDistritos(){
			$sql = "SELECT 
						distinct(C.comu_distrito) 
					FROM registro R 
					INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
					INNER JOIN premio P ON (P.premio_id = R.premio_id)
					WHERE 
						R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses) ORDER BY C.comu_distrito";
			return DB::getAll( $sql );
		}

		public function getDistritosTotalesByNombre($comu_distrito){
			if(!empty($comu_distrito) && is_string($comu_distrito)){
				
				$sql = "SELECT 
							count(*) as total 
						FROM registro R 
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						INNER JOIN premio P ON (P.premio_id = R.premio_id)
						WHERE 
							C.comu_distrito LIKE '$comu_distrito' AND R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
				return (int) DB::getOne($sql);
			}
			return false;
		}


		public function getDistritosUnicosByDistrito($comu_distrito){
			if(!empty($comu_distrito) && is_string($comu_distrito)){
				$sql = "SELECT 
							distinct(R.regi_rut) 
						FROM registro R 
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						INNER JOIN premio P ON (P.premio_id = R.premio_id)
						WHERE 
							C.comu_distrito LIKE '$comu_distrito' AND R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
				$elements = DB::getAll( $sql );
				return count($elements);
			}
		}


		/* RESUMEN POR EDADES TOTALES */
		public function getEdades(){
			$sql = "SELECT 
						distinct(R.regi_edad) 
					FROM registro R 
					INNER JOIN premio P ON (P.premio_id = R.premio_id)
					wHERE 
						R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses) ORDER BY R.regi_edad ASC";
			return DB::getAll( $sql );
		}

		public function getRegistroByEdad($regi_edad){
			if(!empty($regi_edad) && is_string($regi_edad)){
				$sql = "SELECT 
							count(*) as total 
						FROM 
							registro R 
							INNER JOIN premio P ON (P.premio_id = R.premio_id)
						WHERE 
							R.regi_edad = '$regi_edad' AND R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
				return (int) DB::getOne($sql);
			}
			return false;
		}

		public function getRegistroUnicosByEdad($regi_edad){
			if(!empty($regi_edad) && is_string($regi_edad)){
				$sql = "SELECT 
							distinct(R.regi_rut) 
						FROM 
							registro R 
							INNER JOIN premio P ON (P.premio_id = R.premio_id)
						WHERE 
							R.regi_edad LIKE '$regi_edad' AND R.regi_edad >= 17 AND R.regi_edad <= 100 AND MONTH(R.regi_fecha) IN ($this->meses)";
				$elements = DB::getAll( $sql );
				return count($elements);
			}
		}


		/* REGISTRO LANDING */
		public function getRegistrosByMes($regi_mes){
			if(!empty($regi_mes) && is_string($regi_mes)){
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
							C.comu_distrito,
							DATE_FORMAT(R.regi_fecha, '%Y%m') as 'regi_directorio',
							R.regi_etiqueta,
							P.prem_nombre 
						FROM registro R
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						INNER JOIN premio P ON (P.premio_id = R.premio_id) 
						WHERE 
						DATE_FORMAT(R.regi_fecha, '%m') = '$regi_mes' 
						AND R.regi_edad >= 17 
						AND R.regi_edad <= 100
						ORDER BY
							R.registro_id DESC";
				return DB::getAll( $sql );
			}
			return false;
		}


		public function getRegistrosByComunaId($comuna_id){
			if(!empty($comuna_id) && is_numeric($comuna_id)){
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
							R.comuna_id,
							C.comu_nombre,
							C.comu_region,
							DATE_FORMAT(R.regi_fecha, '%Y%m') as 'regi_directorio',
							R.regi_etiqueta, 
							P.prem_nombre
						FROM registro R
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						INNER JOIN premio P ON (P.premio_id = R.premio_id) 
						WHERE 
						R.comuna_id = $comuna_id
						AND R.regi_edad >= 17 
						AND R.regi_edad <= 100
						AND MONTH(R.regi_fecha) IN ($this->meses)
						ORDER BY
							R.regi_rut DESC";
				return DB::getAll( $sql );
			}
			return false;
		}


		public function getRegistrosByComunaIdRandom($comuna_id, $registro_id = ''){
			if(!empty($registro_id) && is_numeric($registro_id)){
				$sqlWhere = "AND R.registro_id = $registro_id ";
			}
			if(!empty($comuna_id) && is_numeric($comuna_id)){
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
							C.comuna_id,
							C.comu_nombre,
							C.comu_region,
							DATE_FORMAT(R.regi_fecha, '%Y%m') as 'regi_directorio',
							R.regi_etiqueta,
							P.prem_nombre
						FROM registro R
						INNER JOIN comuna C ON (C.comuna_id = R.comuna_id) 
						INNER JOIN premio P ON (P.premio_id = R.premio_id) 
						WHERE 
						R.comuna_id = $comuna_id 
						$sqlWhere
						AND R.regi_edad >= 17 
						AND R.regi_edad <= 100
						AND MONTH(R.regi_fecha) IN ($this->meses)
						ORDER BY
							RAND()
						LIMIT 1";
				return DB::getRow( $sql );
			}
			return false;
		}

		public function changeGanador(){
			$sql = "SELECT ganador_id FROM ganador WHERE gana_estado = 'P' AND gana_fecha = DATE_FORMAT( CURDATE() - 1 , '%Y-%m-%d') LIMIT 1";
			echo $sql."<br>";
			$log = new log();
			$log->write($sql);

			$ganador_id = (int) DB::getOne( $sql );
			$log->write('ganador_id = '.$ganador_id);
			
			echo $ganador_id."<br>";
			if($ganador_id > 0){
				$sql 	= "UPDATE ganador SET gana_estado = 'A' WHERE ganador_id = $ganador_id AND gana_estado = 'P'";
				$log->write($sql);
				echo $sql."<br>";
				//return DB::query($sql);	
			}
			
		}

		public function getComunasGanadores(){
			$sql = "SELECT gana_comuna FROM ganador WHERE gana_comuna <> 'INDETERMINADO'";
			return DB::getAll($sql);
		}

		public function getComunasUnicas(){
			$sql = "SELECT 
						COUNT(*)  cantidad, C.comuna_id, C.comu_nombre 
					FROM registro R 
					INNER JOIN comuna C ON (R.comuna_id = C.comuna_id) 
					WHERE 
						R.regi_edad >= 17 
						AND R.regi_edad <= 100
						AND C.comu_nombre NOT IN (SELECT gana_comuna FROM ganador WHERE gana_comuna <> 'INDETERMINADO')
					GROUP BY 
						C.comuna_id, C.comu_nombre 
					ORDER BY `cantidad` DESC";
			return DB::getAll($sql);
			
		}
	}
?>