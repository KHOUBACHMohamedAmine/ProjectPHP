<?php
require("Connection_DB.php");
session_start();



if (isset($_POST["logout"])) {
    session_destroy();
    session_unset();
    header("location: login.php");
}
if (isset($_POST["editInfoPerso"])) {

    try {

        $nom = $_POST['nom'];
        $idVille = $_POST['ville'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['dateNaissance'];
        $cin = $_POST['cin'];
        $cne = $_POST['cne'];
        $id = $_SESSION['currentUserId'];
        $conn = Connection_DB::getConnection();
        $sql = "UPDATE etudiant SET nom='$nom',idVille='$idVille',prenom='$prenom',date_naissance='$date_naissance',cin='$cin',cne='$cne' WHERE id=$id";
        $stm = $conn->prepare($sql);
        $stm->execute();
        header("location: profile.php");
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

}
$conn = Connection_DB::getConnection();
$id = $_SESSION['currentUserId'];
$sql="SELECT COUNT(*) FROM candidature WHERE idEtudiant='$id'";
$res = $conn->query($sql);
$count = $res->fetchColumn();
$_SESSION['nbrCandidatures']=$count;
if (isset($_POST["candidater"])) {
    $serieBac = $_POST['serieBac'];
    $anneBac = $_POST['anneeBac'];
    $moyenneBac = $_POST['moyenneBac'];
    $moyenneRegional = $_POST['moyenneRegional'];
    $premierChoix = $_POST['premierChoix'];
    $deuxiemechoix = $_POST['deuxiemeChoix'];
    $sql = "INSERT INTO `candidature` (`candidature_date`, `idEtudiant`, `note_regional`, `note_national`, `anneBac`, `id_type_bac`, `id_choix1`, `id_choix2`) VALUES (CURRENT_TIMESTAMP ,?,?,?,?,?,?,?)  ";
    $stm = $conn->prepare($sql);
    $stm->execute([(int)$id,(double)$moyenneRegional,(double)$moyenneBac,(int)$anneBac,(int)$serieBac,(int)$premierChoix,(int)$deuxiemechoix]);
    header("location: profile.php");

}

if(isset($_POST['sendDocs'])){
    $nameBac= $_FILES['bac']['name'];
    $nameRegional= $_FILES['regional']['name'];
    $nameCin= $_FILES['cin']['name'];
    $nameImg= $_FILES['img']['name'];
    $nameBacTemp= $_FILES['bac']['tmp_name'];
    $nameRegionalTemp= $_FILES['regional']['tmp_name'];
    $nameCinTemp= $_FILES['cin']['tmp_name'];
    $nameImgTemp= $_FILES['img']['tmp_name'];
    $newNameBac= "filesUploaded/".uniqid("Bac_",true).$nameBac;
    $newNameRegional= "filesUploaded/".uniqid("Regional_",true).$nameRegional;
    $newNameCin=  "filesUploaded/".uniqid("Cin_",true).$nameCin;
    $newNameImg=  "filesUploaded/".uniqid("Img_",true).$nameImg;
    move_uploaded_file($nameBacTemp,$newNameBac);
    move_uploaded_file($nameRegionalTemp,$newNameRegional);
    move_uploaded_file($nameCinTemp,$newNameCin);
    move_uploaded_file($nameImgTemp,$newNameImg);
    $conn = Connection_DB::getConnection();
    $sql="INSERT INTO `document`(`document_id`, `idCandidature`, `chemin`) VALUES (?,?,?)";
    $stm=$conn->prepare($sql);
    $stm->execute([1,$_SESSION['currentUserId'],$newNameBac]);
    $stm->execute([2,$_SESSION['currentUserId'],$newNameRegional]);
    $stm->execute([3,$_SESSION['currentUserId'],$newNameCin]);
    $stm->execute([4,$_SESSION['currentUserId'],$newNameImg]);


}
$id= $_SESSION['currentUserId'];
$conn = Connection_DB::getConnection();
$stmt = $conn->prepare("SELECT id,nom,prenom,idVille,date_naissance,cin,cne FROM etudiant WHERE id='$id' ");
$stmt->execute();
$currentUser = $stmt->fetch();

if ($_SESSION['currentUserName'] === NULL) {
    header("location: login.php");
}

$nom= $_SESSION['currentUserNom'];

$prenom= $_SESSION['currentUserPrenom'];
$ville= $_SESSION['currentUserVille'];
$dateNaissance=$_SESSION['currentUserDateNaissance'];
$cne=$_SESSION['currentUserCne'];
$cin=$_SESSION['currentUserCin'];
$var= $nom." ".$prenom;

$files=array('bac'=>"",'regional'=>"",'cin'=>"",'img'=>"");
$stmt = $conn->prepare("SELECT document_id,idCandidature,chemin FROM document WHERE idCandidature='$id' ");
$stmt->execute();
$currentUserFiles = $stmt->fetchAll();
foreach ($currentUserFiles as $row) {
    if($row['document_id']==1) $files['bac']=$row['chemin'];
    elseif($row['document_id']==2) $files['regional']=$row['chemin'];
    elseif($row['document_id']==3) $files['cin']=$row['chemin'];
    elseif($row['document_id']==4) $files['img']=$row['chemin'];
}






?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile</title>
    <link rel="icon" href="ESTS-LOGO-2021-NOUVEAU.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="script" href="assets/js/script.min.js">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<body>
<nav class="navbar navbar-light navbar-expand-md py-3">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="home.php"><span
                    class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"
                    style="margin-left: 30px;"><img src="ESTS-LOGO-2021-NOUVEAU.png"
                                                    style="width: 100px;height: 100px;"></span></a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-3"><span
                    class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-3">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link " href="home.php">Acceuil</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Mon Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="candidatures.php">Ma Candidature</a></li>
            </ul>
            <?php echo $var ?>
            <form method="post" action="">
                <button style="margin-left: 15px" class="btn btn-primary" name="logout" type="submit">Se Déconnecter
                </button>
            </form>
        </div>
    </div>
</nav>
<header class="bg-primary-gradient"></header>
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="mb-3" id="page-top"></div>
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow" style="height: 550.929px;"><img
                                        class="rounded-circle mb-3 mt-4" src="assets/img/photo.jpg" width="160"
                                        height="160" alt="">

                            </div>
                        </div>
                    </div>
                     <div class="col-lg-8">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold">Informations Personnelles</p>

                                    </div>
                                    <div class="card-body">
                                              <form method="post">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="username"><strong>Nom</strong><br></label><input
                                                                class="form-control" type="text" id="nom" value="<?php echo $currentUser['nom'];?>" name="nom" ></div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="prenom"><strong>Prénom</strong><br></label><input
                                                                class="form-control" type="text" id="prenom" value="<?php echo $currentUser['prenom'];?>" name="prenom"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="ville"><strong>Ville</strong><br></label>
                                                        <select class="form-select" name="ville">
                                                            <?php
                                                            $conn = Connection_DB::getConnection();
                                                            $sql = 'SELECT id,ville FROM ville ';
                                                            foreach ($conn->query($sql) as $row) {
                                                                ?>
                                        <option value="<?php echo $row['id']; ?>" <?php if ($currentUser['idVille'] == $row['id']) echo 'selected=""'; ?> > <?php echo $row['ville']; ?> </option> ;
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="dateNaissance"><strong>Date
                                                                de Naissance</strong><br></label><input


                                                                value="<?php echo $currentUser['date_naissance'];?>"
                                                                class="form-control" type="date" id="dateNaissance"
                                                                name="dateNaissance"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="cin"><strong>Cin</strong><br></label><input
                                                                class="form-control" type="text" id="cin" value="<?php echo $currentUser['cin'];?>"
                                                                 name="cin"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label"
                                                                             for="cne"><strong>Cne</strong><br></label><input
                                                                class="form-control" type="text" id="cne" value="<?php echo $currentUser['cne'];?>"
                                                                 name="cne"></div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="editInfoPerso" >Modifier vos informations personnelles</button>
                                              </form>
                                    </div>

                                </div>
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold" id="Education">Education
                                        <p class="text-center text-danger">
                                           <?php if ($_SESSION['nbrCandidatures']==0) {
                                            echo "Veuillez effectuer une candidature d'abord";
                                            }
                                            ?></p>
                                        </p>

                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action=""   >
                                            <?php
                                            if ($_SESSION['nbrCandidatures']>0) echo '<fieldset disabled="disabled">';
                                            ?>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="serieBac"><strong>Série
                                                                du Bac</strong><br></label>
                                                        <select class="form-select" name="serieBac">
                                                            <option selected="">Choisissez la série de votre bac </option>
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
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="anneeBac"><strong>Année
                                                                du Bac</strong><br></label><input class="form-control"
                                                                                                  type="text"
                                                                                                  id="anneeBac"
                                                                                                  placeholder="2022"
                                                                                                  name="anneeBac"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label"
                                                                             for="moyenneBac"><strong>Moyenne
                                                                Génerale du Bac</strong><br></label><input class="form-control"
                                                                                                    type="text"
                                                                                                    id="moyenneBac"
                                                                                                    placeholder="20.00"
                                                                                                    name="moyenneBac">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="moyenneRegional"><strong>Moyenne
                                                                Régional</strong><br></label><input class="form-control"
                                                                                                    type="text"
                                                                                                    placeholder="20.00"
                                                                                                    id="moyenneRegional"
                                                                                                    name="moyenneRegional">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label"
                                                                             for="first_name"><strong>Premier Choix&nbsp;</strong><br></label>
                                                        <select class="form-select" name="premierChoix">
                                                            <option selected="">Choisissez votre premier choix </option>

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
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="last_name"><strong>&nbsp;Deuxième
                                                                Choix&nbsp;</strong><br></label>
                                                        <select class="form-select" name="deuxiemeChoix">
                                                            <option selected="">Choisissez votre deuxième choix </option>
                                                            <?php
                                                            $conn=Connection_DB::getConnection();

                                                            foreach ($conn->query($sql) as $row) {

                                                                ?>
                                                                <option value="<?php echo $row['id'];?>" > <?php echo $row['filiere']; ?> </option> ;
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary"

                                                    name="candidater">Candidater
                                            </button><p class="text-danger m-0 fw-bold">
                                                <?php if ($_SESSION['nbrCandidatures']>0) {
                                                echo $msg=$msg="vous avez déjà une candidature courante";
                                                }

                                                ?>
                                            </p>
                                            <?php if ($_SESSION['nbrCandidatures']>0)  echo "</fieldset>"; ?>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Importer Vos Documents</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col offset-lg-0">
                                    <div class="mb-3"><label class="form-label" for="bacFile"><strong>Bac</strong><br></label><input class="form-control" type="file" name="bac"></div>
                                    <iframe src="<?php echo $files['bac']; ?>" frameborder="0"></iframe>
                                </div>
                                <div class="col" >
                                    <div class="mb-3"><label class="form-label" for="regionalFile"><strong>Regional</strong><br></label><input class="form-control" type="file" name="regional"></div>
                                    <iframe src="<?php echo $files['regional']; ?>" frameborder="0"></iframe>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="cinFile"><strong>Cin</strong><br></label><input class="form-control" type="file" name="cin">
                                            <iframe src="<?php echo $files['cin']; ?>" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="imgFile"><strong>Image Personnelle</strong><br></label><input class="form-control" type="file" name="img">
                                            <iframe src="<?php echo $files['img']; ?>" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3" style="text-align: center;margin-top: 10px;">
                                        <button class="btn btn-primary btn-lg text-center shadow-sm" name="sendDocs" type="submit">
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
            </div>
        </footer>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>

</body>

</html>

