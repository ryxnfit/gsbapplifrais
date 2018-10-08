<?php
session_start();
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");

$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_GET['uc']) || !$estConnecte){
     $_GET['uc'] = 'connexion';
}	 
else
{
    $uc = $_GET['uc'];
}

switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");
                break;
	}
	case 'gererFrais' :{
		include("controleurs/c_gererFrais.php");
                break;
	}
	case 'etatFrais' :{
		include("controleurs/c_etatFrais.php");
                break; 
        }
    }
?>