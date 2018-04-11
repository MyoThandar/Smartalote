<?php
require_once(ROOT.DS.'vendors' . DS . 'dompdf' . DS . 'dompdf' . DS . 'autoload.inc.php');

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$options->set('enable_css_float', TRUE);
// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));

$dompdf->set_base_path(ROOT.DS."app/webroot/img/user");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();
$filename = "CV_".$user_id;

// Output the generated PDF to Browser
$dompdf->stream($filename);
