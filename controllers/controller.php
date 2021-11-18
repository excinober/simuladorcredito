<?php
/**
* 
*/

require "models/dbclass.php";
//require "models/urlsclass.php";
//require "models/usuariosclass.php";
require "models/creditosclass.php";

/** Require Includes **/
require "includes/constantes.php";
require "includes/functions.php";

class Controller
{
	public function __construct()
	{
		//$this->urls = new Urls();
		//$this->usuarios = new Usuarios();
		$this->creditos = new Creditos();
	}


/************USUARIOS**************/

	/*public function listarCiudades(){
		$ciudades = $this->usuarios->listarCiudades();
		return $ciudades;
	}*/	


	public function simulator(){

		
		//Simular credito
		$creditoLista = $this->creditos->listarCreditos();
		include "views/creditos.php";

	}
	
	public function simulatorconector($idcredito){

		echo json_encode( $this->creditos->detalleCredito2($idcredito) );

	}
}
?>