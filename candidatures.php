<?php
session_start();
require("Connection_DB.php");
$id = $_SESSION['currentUserId'];
$var = $_SESSION['currentUserName'];
if (isset($_POST["deleteCandidature"])) {
    $conn = Connection_DB::getConnection();
    $sql = "DELETE FROM candidature WHERE idEtudiant=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$id]);
    $_SESSION['nbrCandidatures']=0;
    header("location : profile.php");
}if (isset($_POST["printReçu"])) {
echo "printing";
}
if (isset($_POST["logout"])) {
    session_destroy();
    session_unset();
    header("location: login.php");
}
if ($_SESSION['currentUserName'] === NULL) {

    header("location: login.php");
}
if ($_SESSION['nbrCandidatures']==0) {
    $filiereChoix1="";
    $filiereChoix2="";
    header("location: profile.php");

}else{
    $conn = Connection_DB::getConnection();
    $sql = "SELECT id_choix1,id_choix2 FROM candidature WHERE idEtudiant='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $currentUserCandidature = $stmt->fetch();
    $idChoix1 = $currentUserCandidature['id_choix1'];
    $idChoix2 = $currentUserCandidature['id_choix2'];
    $stmt2 = $conn->prepare("SELECT filiere FROM filiere WHERE id='$idChoix1'");
    $stmt2->execute();
    $currentUserCandidatureChoix1 = $stmt2->fetch();
    $filiereChoix1 = $currentUserCandidatureChoix1['filiere'];
    $stmt3 = $conn->prepare("SELECT filiere FROM filiere WHERE id='$idChoix2'");
    $stmt3->execute();
    $currentUserCandidatureChoix2 = $stmt3->fetch();
    $filiereChoix2 = $currentUserCandidatureChoix2['filiere'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
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
                <li class="nav-item"><a class="nav-link " href="home.php">Acceuil</a></li>
                <li class="nav-item"><a class="nav-link " href="profile.php">Mon Profil</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Mes Candidatures</a></li>
            </ul>
            <?php echo $var ?>
            <form method="post" action="">
                <button style="margin-left: 15px" class="btn btn-primary" name="logout" type="submit">Se Déconnecter</button>
            </form>
        </div>
    </div>
</nav>
<div class="container"
     style="border: 2.90476px solid var(--bs-blue);border-radius: 23px;padding: 53px;margin-top: 25px;">
    <div class="row"><form method="post" action="">
        <div class="col-md-12">
          <!-- <p class="text-danger text-center"> <?php
/*               if ($_SESSION['nbrCandidatures']==0) {
                   echo "Pas De andidatures";
               }
            */?></p>-->
            <h1>Ma Candidature :
                <button class="btn btn-danger btn-lg" type="submit"  name="deleteCandidature" style="transform: translate(514px);">Supprimer
                    candidature
                </button>
                <a class="btn btn-primary btn-lg" href="pdfGenerator.php"  style="transform: translate(514px);">Imprimer Reçu
                </a>
            </h1>

        </div></form>
    </div>
    <div class="row" style="margin-top: 37px;margin-bottom: 41px;">
        <div class="col-md-3"
             style="text-align: center;color: var(--bs-body-bg);background: var(--bs-blue);border-radius: 13px;"><label
                    class="col-form-label"
                    style="font-family: ABeeZee, sans-serif;line-height: 33px;letter-spacing: 1px;font-weight: bold;font-size: 18px;">Filières
                choisies:</label></div>
    </div>
    <div class="row">
        <div class="col-md-12"
             style="border-style: solid;border-color: var(--bs-blue);border-radius: 21px;margin-bottom: 22px;padding: 24px;">
            <h1 style="font-size: 20.5238px;">Premier choix:</h1>
            <p style="font-weight: bold;color: var(--bs-blue);font-size: 20.5238px;">
                <?php echo $filiereChoix1 ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"
             style="border-style: solid;border-color: var(--bs-blue);border-radius: 21px;margin-bottom: 22px;padding: 24px;">
            <h1 style="font-size: 20.5238px;">Deuxième choix:</h1>
            <p style="font-weight: bold;color: var(--bs-blue);font-size: 20.5238px;"><?php echo $filiereChoix2 ?></p>
        </div>
    </div>
</div>


</html>
</body>
</html>
