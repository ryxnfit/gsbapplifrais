<div class='card'>
<div class='card-body'>
<form class="form-horizontal" role="form" action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
                <div class="form-group">
                    <div class="form-group">
                    <label for="txtDateHF"> Date (jj/mm/aaaa): </label>
                    </br>
                    <input class="form-control" type="date" id="txtDateHF" name="dateFrais" value="<?php if (isset($_POST['dateFrais'])){echo $_POST['dateFrais'];} ?>" />
                    </br></br>
                    <label for="txtLibelleHF">Libellé</label>
                    </br>
                    <input class="form-control" type="text" id="txtLibelleHF" name="libelle" value="<?php if (isset($_POST['libelle'])){echo $_POST['libelle'];} ?>" />
                    </br></br>
                    <label for="txtMontantHF">Montant : </label>
                    </br>
                    <input class="form-control" type="text" id="txtMontantHF" name="montant" value="<?php if (isset($_POST['montant'])){echo $_POST['montant'];} ?>" />
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