<div class='card'>
<div class='card-body'>
<form class="form-horizontal" role="form" action="index.php?uc=gererFrais&action=validerCreationFraisForfait" method="post">
                <div class="form-group">
                    <div class="form-group">
                    <label for="date"> Date (jj/mm/aaaa): </label>
                    </br>
                    <input class="form-control" type="date" id="txtDateHF" name="dateFrais" value="<?php if (isset($_POST['dateFrais'])){echo $_POST['dateFrais'];} ?>" />
                    </br></br>
                    <label for="forfaitEtape">Forfait Etape</label>
                    </br>
                    <input class="form-control" type="number" id="forfaitEtape" min="0" name="forfait[]" value="<?php if (isset($_POST['forfait'][0])){echo $_POST['forfait'][0];}else{echo "0";} ?>" />
                    </br></br>
                    <label for="forfaitKilo">Forfait Kilométrique</label>
                    </br>
                    <input class="form-control" type="number" id="forfaitKilo" min="0" name="forfait[]" value="<?php if (isset($_POST['forfait'][1])){echo $_POST['forfait'][1];}else{echo "0";} ?>" />
                    </br></br>
                    <label for="nuiteeHotel">Nuitée Hôtel</label>
                    </br>
                    <input class="form-control" type="number" id="nuiteeHotel" min="0" name="forfait[]" value="<?php if (isset($_POST['forfait'][2])){echo $_POST['forfait'][2];}else{echo "0";} ?>" />
                    </br></br>
                    <label for="repasR">Repas Restaurant</label>
                    </br>
                    <input class="form-control" type="number" id="repasR" min="0" name="forfait[]" value="<?php if (isset($_POST['forfait'][3])){echo $_POST['forfait'][3];}else{echo "0";} ?>" />
                    </br>
                    </div>
                </div>
            <div class="horizontal-form">
                <input class="btn btn-primary" id="ajouter" type="submit" value="Ajouter" />
                <input class="btn btn-primary" id="effacer" type="reset" value="Effacer" />
            </div>
        
            </form>
</div>
</div>
<br>