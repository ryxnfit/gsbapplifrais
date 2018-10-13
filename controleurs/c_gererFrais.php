<?php

include("vues/v_sommaire.php");
$action = $_GET['action'];
$id = $_SESSION['id'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);

if(!isset($_GET['action'])){
	$action = 'demandeConnexion';
}
else{$action = $_GET['action'];}

switch($action){
	case 'saisirFrais':{
            include("vues/v_ajoutFrais.php");
		if($pdo->estPremierFraisMois($id,$mois)){
			$pdo->creeNouvellesLignesFrais($id,$mois);
		}
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
	case 'validerCreationFrais':{
		$dateFrais = $_POST['dateFrais'];
		$libelle = $_POST['libelle'];
		$montant = $_POST['montant'];
                
		if (valideInfosFrais($dateFrais,$libelle,$montant) == true)
                {
                    $pdo->creeNouveauFraisHorsForfait($id,$mois,$libelle,$dateFrais,$montant);
                    echo "<h3>Frais ajouté</h3>";
                }
                else {
                    include("vues/v_erreurs.php");
                    include("vues/v_ajoutFrais.php");}
		break;
	}
        case 'validerCreationFraisForfait':{
		$dateFrais = $_POST['dateFrais'];
                $lesFrais = is_array($_POST['forfait']);
                
		if (estDateValide($dateFrais) == true && lesQteFraisValides($lesFrais) == true)
                {
                    $pdo->creeNouvellesLignesFrais($id,$mois,$lesFrais);
                    echo "<h3>Frais ajouté</h3>";
                }
                else {
                    include("vues/v_erreurs.php");
                    include("vues/v_ajoutFrais.php");}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_GET['idFrais'];
                $id = $_SESSION['id'];
                $mois = getMois(date("d/m/Y"));
                $numAnnee = substr($mois,0,4);
                $numMois = substr($mois,4,2);
                $action = $_GET['action'];
                $pdo->supprimerFraisHorsForfait($idFrais);
                include("vues/v_etatFrais.php");
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
}

$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id,$mois);
$lesFraisForfait= $pdo->getLesFraisForfait($id,$mois);
$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id,$mois);