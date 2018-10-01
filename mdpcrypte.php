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