<?php

include("vues/v_sommaire.php");
$action = $_GET['action'];
$id = $_SESSION['id'];

if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
else{$action = $_GET['action'];}

switch($action){
	case 'selectionnerMois':{
		$lesMois=$pdo->getLesMoisDisponibles($id);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMois.php");
		break;
	}
	case 'voirEtatFrais':{
		$leMois = $_POST['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($id);
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($id,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");	
	}
    }
?>