<?php 
    if (isset($_SERVER['erreurs']))
    {
foreach($_SERVER['erreurs'] as $erreur)
	{
      echo "<script language=\"javascript\">";
	  echo "alert ('$erreur')";
	  echo "</script>";;
	}
    }
?>
