<?php

require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
$idVisiteur = $_SESSION['idVisiteur'];
$leMois = $_GET['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
// Include autoloader
require_once 'dompdf/autoload.inc.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Instantiate and use the dompdf class
$dompdf = new Dompdf();



ob_get_contents();
require('vues/pdf.php');
$html = ob_get_clean();

// Load HTML content
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();
$dompdf->stream();


