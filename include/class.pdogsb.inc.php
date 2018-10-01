<?php

    try
    {
            $bdd=new PDO('mysql:host=localhost;dbname=gsbapplifrais;charset=utf8','root','',
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    }
    catch(Exception $e)
    {
            echo'Echec de connexion Ã  la BDD car';
            die('Erreur :'.$e->getMessage());
    }
    
    $req = $bdd->prepare("SELECT id,mdp FROM utilisateurs");
    $req->execute();
    $res=$req->fetchAll();
    
    foreach($res as $utilisateur)
    {
        $mdpCrypte= password_hash($utilisateur['mdp'], PASSWORD_BCRYPT);
        $req = $bdd-> prepare("UPDATE utilisateurs SET mdpCrypte=:mdpCrypte WHERE id=:id");
        $req->bindParam(':mdpCrypte',$mdpCrypte);
        $req->bindParam(':id',$utilisateur['id']);
        $req->execute();
        
    }



?>
﻿<?php

/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbapplifrais';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoGsb=null;
		
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * Retourne les informations d'un utilisateur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le type,le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select utilisateurs.id as id, utilisateurs.nom as nom, utilisateurs.prenom as prenom, utilisateurs.typeProfil as typeProfil from utilisateurs 
		where utilisateurs.login='$login' and utilisateurs.mdp='$mdp'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}
	


	
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idUser,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idUser ='$idUser' 
		and lignefraishorsforfait.mois = '$mois' ";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}
/**
 * Retourne le nombre de justificatif d'un utilisateur pour un mois donné
 
 * @param $id
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($id, $mois){
		$req = "select fichefrais.nbjustificatifs as nb from fichefrais where fichefrais.idUser ='$id' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idUser, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idUser ='$idUser' and lignefraisforfait.mois='$mois' 
		order by lignefraisforfait.idfraisforfait";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table lignefraisforfait
 
 * Met à jour la table lignefraisforfait pour un utilisateur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
	public function majFraisForfait($idUser, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idUser = '$idUser' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}
		
	}
/**
 * met à jour le nombre de justificatifs de la table fichefrais
 * pour le mois et l'utiliateur concerné
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @param $nbJustificatifs
*/
	public function majNbJustificatifs($idUser, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idUser = '$idUser' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);	
	}
/**
 * Teste si un utilisateur possède une fiche de frais pour le mois passé en argument
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idUser,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idUser = '$idUser'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un utilisateur
 
 * @param $idUser 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idUser){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idUser = '$idUser'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un utilisateur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idUser,$mois){
		$dernierMois = $this->dernierMoisSaisi($idUser);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idUser,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idUser, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idUser,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idUser','$mois',0,0,now(),'CR')";
                
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into lignefraisforfait(idUser,mois,idFraisForfait,quantite) 
			values('$idUser','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		 }
	}
        
       

/**
 * Crée un nouveau frais hors forfait pour un utilisateur et un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idUser,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait 
		values(DEFAULT,'$idUser','$mois','$libelle','$dateFr','$montant')";
		PdoGsb::$monPdo->exec($req);
	}
	

/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Retourne les mois pour lesquels un utilisateur a une fiche de frais
 
 * @param $idUser 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
	public function getLesMoisDisponibles($idUser){
		$req = "select fichefrais.mois as mois from fichefrais where fichefrais.idUser ='$idUser' and fichefrais.idEtat in ('CR', 'VA')
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		    "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}
	

/**
 * Retourne les informations d'une fiche de frais d'un utilisateur pour un mois donné
 
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idUser,$mois){
		$req = "select fichefrais.idEtat as idEtat, fichefrais.dateModif as dateModif, fichefrais.nbJustificatifs as nbJustificatifs, 
			fichefrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join etat on fichefrais.idEtat = etat.id 
			where fichefrais.idUser ='$idUser' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idUser 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idUser,$mois,$etat){
		$req = "update fichefrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idUser ='$idUser' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
	
	
}
?>