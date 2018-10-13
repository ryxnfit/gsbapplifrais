<div class="col-md-6">
	<div class="content-box-large">
		<div class="panel-heading">
			<div class="panel-title"><h2>Mes fiches de frais</h2></div>
		</div>
		  	<div class="panel-body">
				<h3>Mois à sélectionner : </h3>
				<form class="form-horizontal" action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">				
					<select class="form-control" id="lstMois" name="lstMois">
									<?php
						foreach ($lesMois as $unMois)
						{
							$mois = $unMois['mois'];
							$numAnnee =  $unMois['numAnnee'];
							$numMois = $unMois['numMois'];
                                                        
                                                        setlocale(LC_TIME, "fr_FR");
                                                        $month_name = strftime("%B", mktime(0, 0, 0, $numMois, 10));
                                                        
							if($mois == $moisASelectionner){
                                                            ?>
                                                        <option selected value="<?php echo $mois; ?>">
                                                            <?php
                                                                setlocale(LC_TIME, "fr_FR");
                                                                $month_name = strftime("%B", mktime(0, 0, 0, $numMois, 10));
                                                                echo $month_name." ".$numAnnee ?>
                                                        </option>
                                                         <?php
                                                        }
							else{
                                                            ?>
                                                            <option selected value="<?php echo $mois; ?>">
                                                            <?php
                                                                setlocale(LC_TIME, "fr_FR");
                                                                $month_name = strftime("%B", mktime(0, 0, 0, $numMois, 10));
                                                                echo $month_name." ".$numAnnee ?>
                                                        </option>
                                                            <?php
                                                        }
                                                }
                                                ?>
					</select>
					<div class="form-horizontal">
						<input class="form-control" id="ok" type="submit" value="Valider" />
						<input class="form-control" id="annuler" type="reset" value="Effacer"/>
					</div>
				</form>
			</div>
	</div>
</div>
		