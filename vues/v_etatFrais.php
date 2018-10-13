<div class="col-md-6">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title"><h2>Fiche de frais de <?php
echo $month_name . " " . $numAnnee;
?> :</h2></div>
        </div>
        <div class="panel-body">
                </br></br>
        <h3>Etat : <?php
echo $libEtat;
?> depuis le <?php
echo $dateModif;
?> </h3>
                <br/>
    
      <table class="table">
                </br></br>
         <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
$a = '<table><tr>';
foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle'];
                $a .= '<th>' . $libelle . '</th>';
?>    
            <th> <?php
                echo $libelle;
?></th>
         <?php
}

?>
     </tr>
        <tr>
        <?php
$a .= '</tr><tr>';
foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite'];
                $a .= '<td>' . $quantite . '</td>';
                
?>
             <td class="qteForfait"><?php
                echo $quantite;
?> </td>
         <?php
}
$a .= '</tr></table><br /><br /><br /><br /> <p> Montant des frais hors-forfait </p> <table><tr>';
?>
     
        </tr>
    </table>
      <table class="table">
         <caption>Descriptif des éléments hors forfait [<?php
echo $nbJustificatifs;
?> justificatifs reçus]
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>                
             </tr>
             
             <?php

foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = $unFraisHorsForfait['libelle'];
                $date    = strtotime($unFraisHorsForfait['date']);
                $montant = $unFraisHorsForfait['montant'];
                $idFrais = $unFraisHorsForfait['id']?>        
                        <tr>
                            <td> <?php
                echo strftime('%d/%m/%Y',$date);
?></td>
                            <td><?php
                echo $libelle;
?></td>
                            <td><?php
                echo $montant;
?></td>
                            <td> <?php
                if ($lesInfosFicheFrais['idEtat'] != 'CR') {
                                echo '<a></a>';
                } else {
                                echo '<a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=' . $idFrais . '"
                                onclick="return confirm(\'Voulez-vous vraiment supprimer ce frais?\');">Supprimer ce frais</a></td>';
                }
?></tr><?php
}
?>    
        
  </div>
  </div>

</div>