<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
        ?>
        
        ﻿<div class="col-md-6">
	<div class="content-box-large">
		<div class="panel-heading">
			<div class="panel-title"><h2>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> :</h2></div>
		</div>
		<div class="panel-body">
				</br></br>
        <h3>Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br></br> </h3>
				</br></br> 
	
  	<table class="table">
				</br></br>
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
		 $a = '<table><tr>';
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
			$a.= '<th>'.$libelle.'</th>';
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		
		?>
		</tr>
        <tr>
        <?php
		$a.='</tr><tr>';
          foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
				$a.='<td>'.$quantite.'</td>';
				
		?>
                <td class="qteForfait"><?php echo $quantite?> </td>
		 <?php
          }
		  $a.='</tr></table><br /><br /><br /><br /> <p> Montant des frais hors-forfait </p> <table><tr>';
		?>
		
		</tr>
    </table>
  	<table class="table">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>                
             </tr>
			 
			 <?php $a.='<th>Date</th>
                <th>Libellé</th>
                <th>Montant</th>'; ?>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
			
			$a.='</tr><tr><td>'.$date.'</td><td>'.$libelle.'</td><td>'.$montant.'</td>';
			
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
             </tr>
        <?php 
          }
		  
		  $a.='</tr></table>';
		?>
    </table>
	
	
	
  </div>
  </div>













    </body>
</html>
