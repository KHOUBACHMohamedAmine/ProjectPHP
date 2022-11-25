<?php
session_start();
$var=$_SESSION['currentUserName'];

if(isset($_POST["logout"])){
    session_destroy();
    session_unset();
    header("location: login.php");
}
if ($_SESSION['currentUserName']===NULL){
    header("location: login.php");
}


?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Services - Brand</title>
</head>

<body>
<nav id="mainNav" class="navbar navbar-light navbar-expand-md sticky-top navbar-shrink py-3" style="height: 67.976px;">
 class="container"><img class="img-fluid" style="--bs-body-bg: var(--bs-navbar-active-color);margin: -1px;margin-right: 259px;" height="104" width="97" src="ESTS-LOGO-2021-NOUVEAU.png" /><button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div id="navcol-1" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <p class="lead" style="margin-bottom: 42px;margin-top: 46px;margin-right: -603px;width: 268.994px;color: rgb(0,0,0);font-size: 15px;">Vous possédez déjà un compte ?</p>
                </li>
            </ul><a class="btn btn-primary shadow" role="button" href="signup.html" style="margin-left: -130px;">Se Connecter</a>
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
    <div class="container">
        <div class="row d-flex justify-content-center" style="margin-right: 0px;margin-top: -19px;">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg class="bi bi-person" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                            </svg></div>
                        <form class="text-center" method="post">
                            <div class="mb-3"></div>
                            <div class="mb-3"></div>
                            <div class="mb-3"><input class="form-control" type="email" name="nom" placeholder="Nom" /></div><input class="form-control" type="email" name="prenom" placeholder="Prénom" />
                            <div class="mb-3"><input class="form-control" type="date" style="margin-top: 16px;" name="dateNaissance" value="Date Naissance" /></div>
                            <div class="mb-3"><select class="form-select" name="ville">
                                    <option value="Ville" selected>Ville</option>
                                </select></div><input class="form-control" type="tel" name="tel" placeholder="Téléphone" />
                            <div class="mb-3"></div><input class="form-control" type="email" name="email" placeholder="Email" />
                            <div class="mb-3"></div><input class="form-control" type="password" name="password" placeholder="Mot de passe" style="margin-top: 15px;" />
                            <div class="mb-3"><a class="btn btn-primary shadow" role="button" href="signup.html" style="margin-top: 23px;">Créer Compte</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>

