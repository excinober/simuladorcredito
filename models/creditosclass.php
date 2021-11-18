<?php

/**
 * 
 */

class Creditos extends Database
{
//insertar credito//
public function crearCredito($nombre="", $montoMax=0, $tasa = 0, $plazos= 0, $fondoMutual= 0, $segLinea= 0){


	$idcreditos = $this->insertar("INSERT INTO `creditos`(			
										`nombre`,
										`monto_max`,
										`tasa`, 
										`plazos`, 
										`fondo_mutual`,
										`seguro_linea`) VALUES (
										'$nombre',
										'$montoMax',
										'$tasa',
										'$plazos',
										'$fondoMutual',
										'$segLinea')");
	return $idcreditos;
}

	public function listarCreditos(){

		$query = $this->consulta("SELECT  `idcredito`, `nombre`,`monto_max`,`tasa`, `plazos`, `fondo_mutual`,`seguro_linea` FROM `creditos` WHERE `idcredito` ");
		
		return $query;

	}

	public function detalleCredito($idcredito){
		$query = $this->consulta("SELECT `idcredito`, `nombre`, `monto_max`, `tasa`, `plazos`, `fondo_mutual`, `seguro_linea` FROM `creditos` WHERE `idcredito` = '$idcredito'");
		return $query;
	}

	public function detalleCredito2(){
		$idcredito = $_POST['id'];
		$query = $this->consulta("SELECT  `monto_max`, `plazos`, `tasa`, `fondo_mutual`, `seguro_linea`  FROM `creditos` WHERE `idcredito` = '$idcredito'");
		return $query;
	}

	public function actualizarCredito($idcredito,$nombre="", $montoMax=0, $tasa = 0, $plazos= 0, $fondoMutual= 0, $segLinea= 0){
		
		$query = $this->actualizar("UPDATE `creditos` SET 
										`nombre`='$nombre',
										`monto_max`='$montoMax',							
										`tasa`='$tasa',
										`plazos`='$plazos',
										`fondo_mutual`='$fondoMutual',
										`seguro_linea`='$segLinea'
										WHERE `idcredito`='$idcredito'");

		
		return $query;
	}

	public function eliminarcredito($idcredito){
		
		$filas = $this->actualizar("DELETE FROM `creditos` WHERE `idcredito`='$idcredito'");
		
		return $filas;
	}

	/*public function categoriasCatalogo(){
		
		$query = $this->consulta("SELECT DISTINCT `categorias`.`idcategoria`, `categorias`.`nombre`, `categorias`.`url`, `categorias`.`imagen`, `categorias`.`icono`, `categorias`.`menu`, `categorias`.`estado`, `categorias`.`padre` FROM `categorias` JOIN `productos` ON (`productos`.`categorias_idcategoria` = `categorias`.`idcategoria`) WHERE `categorias`.`estado` = 1 AND `productos`.`estado` = 1 AND `productos`.`catalogo` = 1");
		
		return $query;
	}*/
}

?>