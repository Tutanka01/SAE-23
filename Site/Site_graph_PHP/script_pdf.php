<? 
header("Content-type:application/pdf");
// Generer des pdf avec l'image de la page
require ('Site_graph_PHP\\fpdf\\fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World !');
$pdf->Output();

?>