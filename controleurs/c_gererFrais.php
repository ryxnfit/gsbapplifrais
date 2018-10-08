<?php

include("vues/v_sommaire.php");
$action = $_GET['action'];
$id = $_SESSION['id'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
switch($action){
	case 'saisirFrais':{
		if($pdo->estPremierFraisMois($id,$mois)){
			$pdo->creeNouvellesLignesFrais($id,$mois);
		}
		break;
	}
	case 'validerMajFraisForfait':{
                
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($id,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent �tre num�riques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_POST['dateFrais'];
		$libelle = $_POST['libelle'];
		$montant = $_POST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($id,$mois,$libelle,$dateFrais,$montant);
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_POST['idFrais'];
                $id = $_SESSION['id'];
                $mois = getMois(date("d/m/Y"));
                $numAnnee = substr($mois,0,4);
                $numMois = substr($mois,4,2);
                $action = $_POST['action'];
                $pdo->supprimerFraisHorsForfait($idFrais);
		break;
        }
	case 'validerMajFraisForfait':{
                
		$lesFrais = $_POST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($id,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent �tre num�riques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	
	case 'supprimerFrais':{
		
	}
}

$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id,$mois);
$lesFraisForfait= $pdo->getLesFraisForfait($id,$mois);
$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id,$mois);
include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");