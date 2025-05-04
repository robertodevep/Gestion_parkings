<?php
require_once(__DIR__."/../fpdf/fpdf.php");
require_once(__DIR__."/../modele/ReservationModel.php");
// generation du pdf avec fpdf

if (!isset($_GET['id'])) {
    die("ID de réservation manquant.");
}

$id_reservation = $_GET['id'];
$model = new ReservationModel();
$connect = $model->Connect();

try {
    $req = $connect->prepare("SELECT r.*, u.nom AS nom_user, p.localisation AS localisation_park, r.numero_place
        FROM reservation r
        JOIN utilisateurs u ON r.id_user = u.id_user
        JOIN parking_vh p ON r.id_parking = p.id_parking
        WHERE r.id_reservation = :id");
    $req->execute([':id' => $id_reservation]);
    $res = $req->fetch(PDO::FETCH_ASSOC);

    if (!$res) {
        die("Réservation introuvable.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération de la réservation : " . $e->getMessage());
}

// Génération du PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(20, 15); // marges réduites
$pdf->SetAutoPageBreak(true, 20);

// Couleurs & titre
$pdf->SetFillColor(200, 220, 255); // bleu clair
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 15, utf8_decode('DÉTAIL DE LA RÉSERVATION'), 0, 1, 'C', true);
$pdf->Ln(10);

// Ligne décorative
$pdf->SetDrawColor(100, 100, 100);
$pdf->Line(20, 35, 190, 35);
$pdf->Ln(5);

// Infos réservation
$pdf->SetFont('Arial', '', 11);

function addRow($pdf, $label, $value) {
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 8, utf8_decode($label), 0, 0, 'R');
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 8, utf8_decode($value), 0, 1, 'L');
}

addRow($pdf, 'Nom Utilisateur :', $res['nom_user']);
addRow($pdf, 'Parking :', $res['localisation_park']);
addRow($pdf, 'Numéro Place :', $res['numero_place']);
addRow($pdf, 'Date Début :', $res['date_debut']);
addRow($pdf, 'Date Fin :', $res['date_fin']);
addRow($pdf, 'Nombre d\'heures :', $res['nombre_heure']);
addRow($pdf, 'Montant Total :', number_format($res['montant_total'], 0, ',', ' ') . ' FCFA');
addRow($pdf, 'Statut :', ucfirst($res['statut']));

$pdf->Ln(20);

// Pied de page
$pdf->SetY(-30);
$pdf->SetFont('Arial', 'I', 10);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(0, 10, utf8_decode('MAIRIE DE DOUALA'), 0, 0, 'C');

// Sortie
$filename = "reservation_" . $res['id_reservation'] . ".pdf";
$pdf->Output('I', $filename);
exit;
?>
