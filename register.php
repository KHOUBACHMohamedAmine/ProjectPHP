<?php
session_start();
$alert="";
require("Connection_DB.php");
if(isset($_POST["signup"])){

    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dateNaissance"]) && !empty($_POST["email"]) && !empty($_POST["ville"]) && !empty($_POST["password"]) && !empty($_POST["phone"] ) && !empty($_POST["cin"] )&& !empty($_POST["cne"] ) ) {
        $prenom = $_POST["prenom"];
        $password = $_POST["password"];
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $ville = $_POST["ville"];
        $cin = $_POST["cin"];
        $cne = $_POST["cne"];
        $dateNaissance = $_POST["dateNaissance"];
        $conn=Connection_DB::getConnection();
        $stm=$conn->prepare("INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `idVille`, `email`, `password`, `date_naissance`, `num_tel`, `cin` , `cne`) VALUES (null , ?, ?, ?, ?, ?, ?, ? , ? , ?);");
        $res=$stm->execute([$nom,$prenom,$ville,$email,$password,$dateNaissance,$phone,$cin,$cne]);
        if ($res){
            $_SESSION['currentUserName']=$nom.$prenom;
            header("Location: Home.php");
        }else{
            echo "Erreur de création de votre compte";
        }



}else{
        $alert="Veuillez remplir tous les champs soigneusement";
    }
} ?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Création de Compte</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="/Footer-Clean-icons.css">
</head>

<body>
<nav class="navbar navbar-light navbar-expand-md sticky-top navbar-shrink py-3" id="mainNav" style="height: 67.976px;">
    <div class="container"><img class="img-fluid" style="margin: -1px 259px -1px -1px;" height="104" width="97" src="assets/img/ESTS-LOGO-2021-NOUVEAU.png"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <p class="lead" style="margin-bottom: 42px;margin-top: 46px;margin-right: -603px;width: 268.994px;color: rgb(0,0,0);font-size: 15px;">Vous possédez déjà un compte ?</p>
                </li>
            </ul><a class="btn btn-primary shadow" role="button" href="login.php" style="margin-left: -130px;">Se Connecter</a>
        </div>
    </div>
</nav>
<section class="py-5">
    <div class="container py-5">
        <div class="row mb-4 mb-lg-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <p class="fw-bold text-success mb-2"></p>
                <h3 class="fw-bold">Créer Compte</h3>
            </div>
        </div>
    </div>
</section>
<section class="position-relative py-4 py-xl-5" style="margin-top: -134px;">
    <div class="InscriptionForm">
        <?php echo "<p style='color: red'>".$alert."</p>"?>

    <div class="container">
        <div class="row d-flex justify-content-center" style="margin-right: 0px;margin-top: -19px;">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                            </svg></div>
                        <form class="text-center" method="post">
                            <div class="mb-3"></div>
                            <div class="mb-3"></div>
                            <div class="mb-3"><input class="form-control" type="text" name="nom" placeholder="Nom"></div>
                            <input class="form-control" type="text" name="prenom" placeholder="Prénom">
                            <div class="mb-3"><input class="form-control" type="date" style="margin-top: 16px;" name="dateNaissance" value="Date Naissance"></div>
                            <div class="mb-3"><select class="form-select" name="ville">
                                    <option selected="">sélectionner votre ville</option>
                                        <?php
                                        $conn=Connection_DB::getConnection();
                                        $sql = 'SELECT id,ville FROM ville ';
                                        foreach ($conn->query($sql) as $row) {
                                            echo "<option value=".$row['id'].">".$row['ville']."</option>" ;
                                        }

                                        ?>

                                </select></div>
                            <div class="mb-3"><input class="form-control" type="tel" name="phone" placeholder="Téléphone"></div>
                            <div class="mb-3"><input class="form-control" type="text" name="cin" placeholder="Cin"></div>
                            <div class="mb-3"> <input class="form-control" type="text" name="cne" placeholder="Cne"></div>
                            <div class="mb-3"></div><input class="form-control" type="email" name="email" placeholder="Email">
                            <div class="mb-3"></div><input class="form-control" type="password" name="password" placeholder="Mot de passe" style="margin-top: 15px;">
                            <div class="mb-3"><button class="btn btn-primary shadow"  type="submit" name="signup" style="margin-top: 23px;">Créer Compte</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/bold-and-bright.js"></script>
<script id="bs-live-reload" data-sseport="58637" data-lastchange="1669403171787" src="assets/js/livereload.js"></script>


</body></html>

