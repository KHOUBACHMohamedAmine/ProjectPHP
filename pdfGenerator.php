<?php
require_once ("fpdf/fpdf.php");
require_once ("Connection_DB.php");

session_start();
$sql = "SELECT candidature.candidature_numero as idCandidature,etudiant.cin as cin , etudiant.cne as cne,etudiant.idVille as idVille,etudiant.date_naissance as dateNaissance,candidature.note_regional as regional,candidature.note_national as national,candidature.id_choix1 as idChoix1,candidature.id_choix2 as idChoix2,ville.id as ville,ville.ville as  nomVille,candidature.id_type_bac as idBac,type_bac.type_bac as bac,etudiant.id as idEtudiant,etudiant.nom as nom,etudiant.prenom as prenom,candidature.idEtudiant as idEtudiant,document.chemin as photo
FROM candidature INNER JOIN etudiant INNER JOIN ville INNER JOIN type_bac INNER JOIN document INNER JOIN categorie_document
                                                                                                         ON etudiant.id = candidature.idEtudiant AND etudiant.idVille = ville.id AND candidature.id_type_bac = type_bac.id AND document.document_id = categorie_document.document_id AND document.idCandidature =etudiant.id
WHERE categorie_document.document_id = 4  && candidature.idEtudiant=?";
$conn=Connection_DB::getConnection();
$stm=$conn->prepare($sql);
$stm->execute([$_SESSION['currentUserId']]);
$infoSet =$stm->fetch();
    $choix1 = $infoSet['idChoix1'];
    $sql = "SELECT filiere FROM filiere where id= '$choix1';";
    $choix2 = $infoSet['idChoix2'];
    $sql2 = "SELECT filiere FROM filiere where id= '$choix2';";
    $fil1 = $conn->query($sql)->fetch()['filiere'];
    $fil2 = $conn->query($sql2)->fetch()['filiere'];

$pdf = new FPDF('P', 'mm', 'A5');
$pdf->AddPage();

// Début en police Arial normale taille 10
$pdf->Image('ESTS-LOGO-2021-NOUVEAU.png',50,-5,40);


$pdf->Ln(18);
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(0, 10,iconv('UTF-8', 'windows-1252', 'numéro de candidature : ') .$infoSet['idCandidature'], 'LTRB', 1, 'C');
$pdf->Ln(50);
$pdf->Image($infoSet['photo'],50,50,40);
// Saut de ligne
$pdf->Ln(10);
$pdf->Cell(48, 5, 'Nom et Prenom', 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['nom']." ".$infoSet['prenom'], 1, 1, 'L', 0);
$pdf->Cell(48, 5, 'Cin', 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['cin'], 1, 1, 'L', 0);
$pdf->Cell(48, 5, 'Cne', 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['cne'], 1, 1, 'L', 0);
$pdf->Cell(48, 5, 'Date Naissance', 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['dateNaissance'], 1, 1, 'L', 0);
$pdf->Cell(48, 5, iconv('UTF-8', 'windows-1252', 'Baccalauréat'), 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['bac'], 1, 1, 'L', 0);
$pdf->Cell(48, 5, 'Note National', 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['national'], 1, 1, 'L', 0);
$pdf->Cell(48, 5,iconv('UTF-8', 'windows-1252', 'Note Régional') , 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5, $infoSet['regional'], 1, 1, 'L', 0);
$pdf->Cell(48, 5, 'Premier Choix ', 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5,$fil1 , 1, 1, 'L', 0);
$pdf->Cell(48, 5,iconv('UTF-8', 'windows-1252', 'Deuxième Choix') , 'LTRB', 0, 'L', 0);   //empty cell with left,top, and right borders
$pdf->Cell(80, 5,$fil2 , 1, 1, 'L', 0);

$pdf->Output('', '', true);
?>
