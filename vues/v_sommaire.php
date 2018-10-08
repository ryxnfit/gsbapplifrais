<!DOCTYPE html>
<html>
  <head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <title>Gestion de frais GSB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body background="assets/img/laboratoire.jpg">
      
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Galaxy Swiss Bourdin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="btn btn-outline-secondary" href="index.php?uc=gererFrais&action=saisirFrais" class="btn btn-outline-secondary">Saisir mes fiches de frais</a>
      </li>
      <li class="nav-item active">
        <a class="btn btn-outline-secondary" href="index.php?uc=etatFrais&action=selectionnerMois" >Mes fiches de frais</a>
      </li>
    </ul>
      <ul class="navbar-nav mx-auto">
          <li class="nav-item">
              <a class="nav-link"><?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                                        echo '<h5>'.strftime("%B %Y")."</h5>";?></a>
      </li>
      </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link"><?php echo '<h6>'.$_SESSION['prenom']."  ".$_SESSION['nom']."</h6>"?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php
                    $typeProfil = $_SESSION['typeProfil'];
                    
                    switch($typeProfil)
                    {
                        case 'v':
                            echo "<h6>Visiteur médical</h6>";
                            break;
                        case 'c':
                            echo "<h6>Comptable</h6>";
                            break;
                    }
                    ?></a>
      <li class="active"><a href="index.php?uc=connexion&action=deconnexion" class="btn btn-outline-secondary">Se déconnecter </a></li>
      </li>
    </ul>
  </div>
</nav>
   	
	<div class="page-content">
    	<div class="row">

  
