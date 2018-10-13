
<div class="col-md-6" style="position:relative;left:4%;">
	<div class="content-box-large">
		<div class="panel-heading">
			<legend>Eléments hors forfait</legend>
		</div>
		<div class="panel-body">
			<table class="table">
			  <thead>
				<tr>
					<th class="date">Date</th>
					<th class="libelle">Libellé</th>
					<th class="montant">Montant</th>
                                        <th class="action">&nbsp;</th>
				 </tr>
				 <?php    

					foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
					{
						$libelle = $unFraisHorsForfait['libelle'];
						$date = $unFraisHorsForfait['date'];
						$montant=$unFraisHorsForfait['montant'];
						$id = $unFraisHorsForfait['id']
						
				?>		
						<tr>
							<td> <?php echo $date ?></td>
							<td><?php echo $libelle ?></td>
							<td><?php echo $montant ?></td>
							<td> <?php if ($lesInfosFicheFrais['idEtat']!='CR') { echo '<a></a>';}
								else {
									echo '<a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais='.$id.'"
								onclick="return confirm(\'Voulez-vous vraiment supprimer ce frais?\');">Supprimer ce frais</a></td>';
								}
						?></tr><?php		 }  ?>	  
			 </table>
		</div> 
	</div>
</div>