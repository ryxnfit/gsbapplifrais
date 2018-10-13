<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function addElementFrais()
{
    $(document).ajaxStart(function()
    {
      $('#addFrais').click(function()
      {
        $.ajax(
        {
            type:'post',
            url: "vues/v_ajoutFraisForfait.php", // path to your PHP file
            dataType:"html",
            success: function(data)
            {
               // If you want to add the data at the bottom of the <div> use .append()
               $('#elements').append(data);

               // Or if you want to add the data at the top of the div
            }; // success
        }); // ajax
       }
    )};
}
</script>﻿

<div class='container'>
    <nav class='bg-light card'>
        <div class='nav nav-tabs' id='nav-tab' role='tablist'>
          <a class='nav-item nav-link active' id='nav-home-tab' data-toggle='tab' href='#nav-home' role='tab' aria-controls='nav-home' aria-selected='<?php if(!isset($_POST['forfait'])){echo "true";}else{echo "false";} ?>'>Ajouter un nouveau frais forfait</a>
          <a class='nav-item nav-link' id='nav-profile-tab' data-toggle='tab' href='#nav-profile' role='tab' aria-controls='nav-profile' aria-selected='<?php if(isset($_POST['forfait'])){echo "true";}else{echo "false";} ?>'>Ajouter un nouveau frais hors-forfait</a>
        </div>
    </nav>
    <div class='tab-content' id='nav-tabContent'>
        <div class='tab-pane fade show active' id='nav-home' role='tabpanel' aria-labelledby='nav-home-tab'>
            <?php include("v_ajoutFraisForfait.php"); ?>
            <br>
            <div id="elements"></div>
            <input class="btn btn-primary" type="button" id="addFrais" onclick="addElementFrais();" value="+1 Nouveau Frais" />
        </div>
        <div class='tab-pane fade show active' id='nav-profile' role='tabpanel' aria-labelledby='nav-profile-tab'>
            <?php include("v_ajoutFraisHorsForfait.php"); ?>
        </div>
    </div>
</div>