<?php 
foreach($_REQUEST['erreurs'] as $erreur)
foreach($_SERVER['erreurs'] as $erreur)
	{
      echo "<script language=\"javascript\">";
	  echo "alert ('$erreur')";
	  echo "</script>";;
	}
?>
