<?php
session_start();
require("Connection_DB.php");
$conn=Connection_DB::getConnection();
$var=$_SESSION['currentAdminNom']." ".$_SESSION['currentAdminPrenom'];

if(isset($_POST["logout"])){
    session_destroy();
    session_unset();
    header("location: adminLogin.php");
}
if ($_SESSION['currentAdminNom']===NULL){
    header("location: adminLogin.php");
}
if(isset($_POST["editCoeff"])){

$serieBac = $_POST["serieBac"];
$filiereDut= $_POST["filiereDut"];
$coeff= $_POST["coeff"];


    $stm=$conn->prepare("INSERT INTO `facteurs`(`id_type_bac`, `id_filiere`, `facteur`) VALUES (?,?,?);");
    $res=$stm->execute([$serieBac,$filiereDut,$coeff]);
    if ($res){
        header("Location: adminHome.php#coeff");
    }else{
        echo "Erreur d'ajout de coefficient";
    }


}
$stmt = $conn->prepare("SELECT `deadline`, `affichage_Pres`, `date_Cnc`, `date_Result` FROM `config` WHERE id=1; ");
$stmt->execute();
$currentConfiguration = $stmt->fetch();
if(isset($_POST["editConfig"])){

    $deadline = $_POST["dealine"];
    $maxTM=$_POST["maxTM"];
    $maxTIMQ=$_POST["maxTIMQ"];
    $maxGI=$_POST["maxGI"];
    $maxGIM=$_POST["maxGIM"];

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Espace Admin</title>
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
                <li class="nav-item"><a class="nav-link active" href="#">Acceuil</a></li>
                <li class="nav-item"><a class="nav-link" href="listeCandidatures.php">Liste des candidatures</a></li>
                <li class="nav-item"><a class="nav-link" href="listeAdmis.php">Liste des admis</a></li>
            </ul>
            <?php echo $var?><form method="post" action=""> <button style="margin-left: 15px" class="btn btn-primary" name="logout" type="submit">Se Déconnecter</button></form>
        </div>
    </div>
</nav>
<header class="bg-primary-gradient">
    <div class="container pt-4 pt-xl-5">
        <div class="row pt-5">
            <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto"
                 style="filter: hue-rotate(0deg);margin: -13px;height: 20.627px;">
                <div class="text-center"><h1 class="fw-bold" style="font-size: 15.5238px;">Staistiques de la plateforme</h1></div>
            </div>
            <section class="py-4 py-xl-5 ">
                <div class="container py-4 py-xl-5 " style="border-top-style: solid;border-top-color: var(--bs-blue);border-bottom-style: solid;border-bottom-color: var(--bs-blue);">

                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase fw-bold text-primary text-xs mb-1"><span>Nombre d'inscriptions</span></div>
                                            <div class="fw-bold text-dark h5 mb-0"><span>1000</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Nombre de Candidatures</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>500</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>nombre de villes</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>150</span></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span> Nombre de filières</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>4</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>Candidatures TIMQ</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>180</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>Candidatures GIM</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>130</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>Candidatures TM</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>100</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>Candidatures GI</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>180</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                 <div class="row pt-5">
            <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto"
                 style="filter: hue-rotate(0deg);margin: -13px;height: 20.627px;">
                <div class="text-center"><h1 class="fw-bold" style="font-size: 15.5238px;">Configuration de la plateforme</h1></div>
            </div>
            <section class="py-4 py-xl-5 ">
                <div class="container py-4 py-xl-5 " style="border-top-style: solid;border-top-color: var(--bs-blue);border-bottom-style: solid;border-bottom-color: var(--bs-blue);">
                    <div class="row mb-5 " >
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Configuration des dates :</p>

                                        </div>
                                        <div class="card-body" >

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="dateCloture"><strong>Date Cloture</strong><br></label><input
                                                                    class="form-control" type="date" id="dateCloture"  value="<?php echo $currentConfiguration['deadline']?>" name="dateCloture" ></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="affichageResultat"><strong>Date d'affichage des resultats</strong><br></label><input
                                                                    class="form-control" type="date" id="affichageResultat" value="<?php echo $currentConfiguration['date_Result']?>"  name="affichageResultat"></div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="preselection"><strong>Date d'affichage des présélectionnés</strong><br></label><input
                                                                    class="form-control" type="date" id="preselection" value="<?php echo $currentConfiguration['affichage_Pres']?>" name="preselection"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="concours"><strong>Date du concours </strong><br></label><input
                                                                    class="form-control" type="date" id="concours" value="<?php echo $currentConfiguration['date_Cnc']?>"  name="concours"></div>
                                                    </div>
                                                </div>


                                    </div>

                                                </div>

                                                <button type="submit" class="btn btn-primary" name="editConfig" >Modifier Dates</button>

                                        </div>

                                    </div>

                            </div>

                        </div>
                    <div class="row mb-5 " >
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold"> Ajout de filières :</p>

                                        </div>
                                        <div class="card-body" >



                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="filiere"><strong>intitulé de filière à ajouter </strong><br></label><input
                                                                class="form-control" type="text" id="filiere"  name="filiere"></div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary" name="editConfig" >Ajouter</button>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-8">

                        <div class="row">

                            <div class="col"><form method="POST" action="">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold" id="coeff">Configuration des Coefficients :</p>

                                    </div>
                                        <div class="card-body" >
                                            <form method="post">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="serieBac"><strong>Série Bac</strong><br></label>
                                                        <select class="form-select" name="serieBac">
                                                            <option selected="">Choisissez la série de  bac </option>
                                                            <?php
                                                            $conn=Connection_DB::getConnection();
                                                            $sql = 'SELECT id,type_bac FROM type_bac ';

                                                            foreach ($conn->query($sql) as $row) {
                                                                ?>
                                                                <option value="<?php echo $row['id'];?>" > <?php echo $row['type_bac']; ?> </option> ;
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="filiereDut"><strong>Filière DUT</strong><br></label>
                                                        <select class="form-select" name="filiereDut">
                                                            <option selected="">Choisissez une filière </option>

                                                            <?php
                                                            $conn=Connection_DB::getConnection();
                                                            $sql = 'SELECT id,filiere FROM filiere ';

                                                            foreach ($conn->query($sql) as $row) {

                                                                ?>
                                                                <option value="<?php echo $row['id'];?>" > <?php echo $row['filiere']; ?> </option> ;
                                                            <?php } ?>

                                                        </select>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="coeff"><strong>Coefficient</strong><br></label><input
                                                                class="form-control" type="text" id="coeff"  name="coeff"></div>
                                                </div>

                                            </div>

                                        </div>

                                </div>

                                <button type="submit" class="btn btn-primary" name="editCoeff" >Enregistrer Coefficients</button>
                                </form>
                            </div>

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

