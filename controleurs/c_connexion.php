<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
else{$action = $_GET['action'];}

switch($action){
	
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_POST['login'];
		$mdp = $_POST ['mdp'];
		$utilisateur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array($utilisateur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else {
			$id = $utilisateur['id'];
			$nom =  $utilisateur['nom'];
			$prenom = $utilisateur['prenom'];
                        $typeProfil = $utilisateur['typeProfil'];
			connecter($id,$nom,$prenom,$typeProfil);
			include("vues/v_sommaire.php");
			}

			break;	
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>
