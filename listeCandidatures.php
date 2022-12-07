<?php
session_start();
require("Connection_DB.php");
$var = $_SESSION['currentAdminNom'] . " " . $_SESSION['currentAdminPrenom'];

if (isset($_POST["logout"])) {
    session_destroy();
    session_unset();
    header("location: adminLogin.php");
}
if ($var == NULL) {
    header("location: adminLogin.php");
}
$conn = Connection_DB::getConnection();


$sql = "SELECT candidature.candidature_numero as idCandidature,etudiant.cin as cin , etudiant.cne as cne,etudiant.idVille as idVille,etudiant.date_naissance as dateNaissance,candidature.note_regional as regional,candidature.note_national as national,candidature.id_choix1 as idChoix1,candidature.id_choix2 as idChoix2,ville.id as ville,ville.ville as  nomVille,candidature.id_type_bac as idBac,type_bac.type_bac as bac,etudiant.id as idEtudiant,etudiant.nom as nom,etudiant.prenom as prenom,candidature.idEtudiant as idEtudiant,document.chemin as photo
FROM candidature INNER JOIN etudiant INNER JOIN ville INNER JOIN type_bac INNER JOIN document INNER JOIN categorie_document
                                                                                                         ON etudiant.id = candidature.idEtudiant AND etudiant.idVille = ville.id AND candidature.id_type_bac = type_bac.id AND document.document_id = categorie_document.document_id AND document.idCandidature =etudiant.id
WHERE categorie_document.document_id = 4 ";

if (isset($_POST['gi'])) {


    $sql = "SELECT candidature.candidature_numero as idCandidature,etudiant.cin as cin , etudiant.cne as cne,etudiant.idVille as idVille,etudiant.date_naissance as dateNaissance,candidature.note_regional as regional,candidature.note_national as national,candidature.id_choix1 as idChoix1,candidature.id_choix2 as idChoix2,ville.id as ville,ville.ville as  nomVille,candidature.id_type_bac as idBac,type_bac.type_bac as bac,etudiant.id as idEtudiant,etudiant.nom as nom,etudiant.prenom as prenom,candidature.idEtudiant as idEtudiant,document.chemin as photo
FROM candidature INNER JOIN etudiant INNER JOIN ville INNER JOIN type_bac INNER JOIN document INNER JOIN categorie_document
                                                                                                         ON etudiant.id = candidature.idEtudiant AND etudiant.idVille = ville.id AND candidature.id_type_bac = type_bac.id AND document.document_id = categorie_document.document_id AND document.idCandidature =etudiant.id
WHERE categorie_document.document_id = 4  && (candidature.id_choix1=1 or candidature.id_choix2=1) ";

} elseif (isset($_POST['tm'])) {

    $sql = "SELECT candidature.candidature_numero as idCandidature,etudiant.cin as cin , etudiant.cne as cne,etudiant.idVille as idVille,etudiant.date_naissance as dateNaissance,candidature.note_regional as regional,candidature.note_national as national,candidature.id_choix1 as idChoix1,candidature.id_choix2 as idChoix2,ville.id as ville,ville.ville as  nomVille,candidature.id_type_bac as idBac,type_bac.type_bac as bac,etudiant.id as idEtudiant,etudiant.nom as nom,etudiant.prenom as prenom,candidature.idEtudiant as idEtudiant,document.chemin as photo
FROM candidature INNER JOIN etudiant INNER JOIN ville INNER JOIN type_bac INNER JOIN document INNER JOIN categorie_document
                                                                                                         ON etudiant.id = candidature.idEtudiant AND etudiant.idVille = ville.id AND candidature.id_type_bac = type_bac.id AND document.document_id = categorie_document.document_id AND document.idCandidature =etudiant.id
WHERE categorie_document.document_id = 4  && (candidature.id_choix1=2 or candidature.id_choix2=2) ";
} elseif (isset($_POST['timq'])) {
    $sql = "SELECT candidature.candidature_numero as idCandidature,etudiant.cin as cin , etudiant.cne as cne,etudiant.idVille as idVille,etudiant.date_naissance as dateNaissance,candidature.note_regional as regional,candidature.note_national as national,candidature.id_choix1 as idChoix1,candidature.id_choix2 as idChoix2,ville.id as ville,ville.ville as  nomVille,candidature.id_type_bac as idBac,type_bac.type_bac as bac,etudiant.id as idEtudiant,etudiant.nom as nom,etudiant.prenom as prenom,candidature.idEtudiant as idEtudiant,document.chemin as photo
FROM candidature INNER JOIN etudiant INNER JOIN ville INNER JOIN type_bac INNER JOIN document INNER JOIN categorie_document
                                                                                                         ON etudiant.id = candidature.idEtudiant AND etudiant.idVille = ville.id AND candidature.id_type_bac = type_bac.id AND document.document_id = categorie_document.document_id AND document.idCandidature =etudiant.id
WHERE categorie_document.document_id = 4  && (candidature.id_choix1=3 or candidature.id_choix2=3)";
} elseif (isset($_POST['gim'])) {
    $sql = "SELECT candidature.candidature_numero as idCandidature,etudiant.cin as cin , etudiant.cne as cne,etudiant.idVille as idVille,etudiant.date_naissance as dateNaissance,candidature.note_regional as regional,candidature.note_national as national,candidature.id_choix1 as idChoix1,candidature.id_choix2 as idChoix2,ville.id as ville,ville.ville as  nomVille,candidature.id_type_bac as idBac,type_bac.type_bac as bac,etudiant.id as idEtudiant,etudiant.nom as nom,etudiant.prenom as prenom,candidature.idEtudiant as idEtudiant,document.chemin as photo
FROM candidature INNER JOIN etudiant INNER JOIN ville INNER JOIN type_bac INNER JOIN document INNER JOIN categorie_document
                                                                                                         ON etudiant.id = candidature.idEtudiant AND etudiant.idVille = ville.id AND candidature.id_type_bac = type_bac.id AND document.document_id = categorie_document.document_id AND document.idCandidature =etudiant.id
WHERE categorie_document.document_id = 4  && (candidature.id_choix1=4 or candidature.id_choix2=4)";
}

$infoSet = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Espace Admin - Liste Candidatures</title>
    <link rel="icon" href="ESTS-LOGO-2021-NOUVEAU.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="script" href="assets/js/script.min.js">
    <link rel="stylesheet" href="assets/css/Countdown-styles.css">
    <link rel="stylesheet" href="assets/css/Countdown.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<body>
<nav class="navbar navbar-light navbar-expand-md py-3">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span
                    class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"
                    style="margin-left: 30px;"><img src="ESTS-LOGO-2021-NOUVEAU.png"
                                                    style="width: 100px;height: 100px;"></span></a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-3"><span
                    class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-3">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link " href="adminHome.php">Acceuil</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Liste des candidatures</a></li>
                <li class="nav-item"><a class="nav-link" href="listeAdmis.php">Liste des admis</a></li>
            </ul>
            <?php echo $var ?>
            <form method="post" action="">
                <button style="margin-left: 15px" class="btn btn-primary" name="logout" type="submit">Se Déconnecter
                </button>
            </form>
        </div>
    </div>
</nav>

<header class="bg-primary-gradient">
    <div class="container-fluid">
        <div class="card shadow mt-5">
            <div class="card-header py-3">
                <form method="post" action="">
                    <p class="text-primary m-0 fw-bold"> Liste des candidatures
                        <button type="submit" style="margin-left: 75%" name="gi" class="btn-primary btn">GI</button>
                        <button class="btn-primary btn" type="submit" name="gim">GIM</button>
                        <button class="btn-primary btn" type="submit" name="timq">TIMQ</button>
                        <button class="btn-primary btn" type="submit" name="tm">TM</button>

                    </p>
                </form>

            </div>
            <div class="card-body">

                <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                    <table id="dataTable" class="table my-0">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Cin</th>
                            <th>Cne</th>
                            <th>ville</th>
                            <th>date de naissance</th>
                            <th>Baccalauréat</th>
                            <th>Note Baccalauréat</th>
                            <th>Note Regional</th>
                            <th>choix 1</th>
                            <th>choix 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($infoSet as $row) {
                            $conn = Connection_DB::getConnection();
                            $choix1 = $row['idChoix1'];
                            $sql = "SELECT filiere FROM filiere where id= '$choix1';";
                            $choix2 = $row['idChoix2'];
                            $sql2 = "SELECT filiere FROM filiere where id= '$choix2';";
                            $fil1=$conn->query($sql)->fetch()['filiere'];
                            $fil2=$conn->query($sql2)->fetch()['filiere'];

                            echo "<tr>
                            <td><img class='rounded-circle me-2' width='30' height='30' src='" . $row['photo'] . "'/> " . $row['nom'] . "</td>
                           
                            <td>" . $row['prenom'] . "</td>
                            <td>" . $row['cin'] . "</td>
                            <td>" . $row['cne'] . "</td>
                            <td>" . $row['nomVille'] . "</td>
                            <td>" . $row['dateNaissance'] . "</td>
                            <td>" . $row['bac'] . "</td>
                            <td>" . $row['national'] . "</td>
                            <td>" . $row['regional'] . "</td>
                            <td>" . $fil1 . "</td>
                            <td>" . $fil2 . "</td>
                        </tr>";
                        }

                        ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>


</header>
<footer class="text-center py-4">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col"><p class="text-muted my-2">Copyright&nbsp;© 2022 Brand</p></div>
            <div class="col">
                <ul class="list-inline my-2">
                    <li class="list-inline-item me-4">
                        <div class="bs-icon-circle bs-icon-primary bs-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                 viewBox="0 0 16 16" class="bi bi-facebook">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                            </svg>
                        </div>
                    </li>
                    <li class="list-inline-item me-4">
                        <div class="bs-icon-circle bs-icon-primary bs-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                 viewBox="0 0 16 16" class="bi bi-twitter">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                            </svg>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="bs-icon-circle bs-icon-primary bs-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                 viewBox="0 0 16 16" class="bi bi-instagram">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                            </svg>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-inline my-2"></ul>
                <p class="text-muted my-2">Privacy policy &amp; Terms of use</p></div>
        </div>
    </div>
</footer>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bold-and-bright.js"></script>
<script src="assets/js/Countdown-1.js"></script>
<script src="assets/js/Countdown.js"></script>
<script id="bs-live-reload" data-sseport="54208" data-lastchange="1669477970217" src="/js/livereload.js"></script>
</body>
</html>



