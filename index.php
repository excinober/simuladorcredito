<?php 
error_reporting(0);
session_start();

require "controllers/controller.php";

$controller = new Controller();

if (isset($_GET["url"]) && !empty($_GET["url"])) {

	$url = explode("/", $_GET["url"]);
	
	$var1 = $url[0];
	$var2 = $url[1];
	$var3 = $url[2];
	$var4 = $url[3];
	$var5 = $url[4];

	switch ($var1) {

		case URL_ADMIN_SIMULACION:
			if (isset($var2) && !empty($var2)) {

				if ($var2=="Nuevo") {
					$var2 = "";
				}
				$controller->simulatorconector($var2);
				
			}else{
				$controller->simulator();
			}
				
			break;

		case URL_ADMIN_SIMULATORCONECOR:
			$controller->simulatorconector($id);
			break;
	}
}else{

	
	
}

?>