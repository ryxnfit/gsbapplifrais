<div class="container">
    <nav class="bg-light card">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Éléments Forfaitisés</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Éléments Hors-Forfaitisés</a>
		</div>
        <br/>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">
                <div class="card-header">Élément Forfaitisé</div><br/>
                <div class="card-body">
			<form class="form-horizontal" method="POST" action="index.php?uc=gererFrais&action=validerMajFraisForfait">
			  <div class="form-group">
				<?php
						foreach ($lesFraisForfait as $unFrais)
						{
							$idFrais = $unFrais['idfrais'];
							$libelle = $unFrais['libelle'];
							$quantite = $unFrais['quantite'];
					?>
							<div class="form-group">
								<label for="idFrais"><?php echo $libelle ?></label>
                                                          <input class="form-control" placeholder="<?php echo $quantite?>" type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" value="<?php echo $quantite?>" <?php if ($lesInfosFicheFrais['idEtat']!='CR') { echo 'disabled';} ?> />
							</div>

					<?php
						}
					?>
				</div>
				<input class="btn btn-primary" id="ok" type="submit" value="Valider" size="20" <?php if ($lesInfosFicheFrais['idEtat']!='CR') { echo 'disabled';} ?>/>
			  </div>
			</form>
		</div>
	</div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><?php include 'include("vues/v_listeFraisHorsForfait.php")';?></div>
    </div>