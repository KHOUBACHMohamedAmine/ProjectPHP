<?php
session_start();
$alert="";
require("Connection_DB.php");
if(isset($_POST["signup"])){

    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dateNaissance"]) && !empty($_POST["email"]) && !empty($_POST["ville"]) && !empty($_POST["password"]) && !empty($_POST["phone"])) {
        $prenom = $_POST["prenom"];
        $password = $_POST["password"];
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $ville = $_POST["ville"];
        $dateNaissance = $_POST["dateNaissance"];
        $conn=Connection_DB::getConnection();
        $stm=$conn->prepare("INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `ville`, `email`, `password`, `date_naissance`, `num_tel`) VALUES (null , ?, ?, ?, ?, ?, ?, ?);");
        $res=$stm->execute([$nom,$prenom,$ville,$email,$password,$dateNaissance,$phone]);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PréInscription</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
<h1 >Bienvenue à la plateforme de Préinscription de l'EST SAFI</h1>
<h5 >--Veulliez Créer votre Compte pour importer vos documents--</h5>
<div class="InscriptionForm">
    <?php echo "<p style='color: red'>".$alert."</p>"?>
<form method="post" action="">
  <label for="nom" class="form-label">Nom</label>
    <div class="input-group mb-3">
        <input type="text"   name="nom" class="form-control" >
    </div>
    <label for="prenom" class="form-label">Prenom</label>
    <div class="input-group mb-3">
        <input type="text"  name="prenom" class="form-control"  >
    </div>
    <label for="ville" class="form-label">Ville</label>
    <div class="input-group mb-3">
        <select type="text"  name="ville" class="form-control" >
            <option SELECTED>Choisissez votre Ville</option>

                <option value="Agadir">Agadir</option>
                <option value="Al Hoceima">Al Hoceima</option>
                <option value="Azilal">Azilal</option>
                <option value="Beni Mellal">Beni Mellal</option>
                <option value="Ben Slimane">Ben Slimane</option>
                <option value="Boulemane">Boulemane</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Chaouen">Chaouen</option>
                <option value="El Jadida">El Jadida</option>
                <option value="El Kelaa des Sraghna">El Kelaa des Sraghna</option>
                <option value="Er Rachidia">Er Rachidia</option>
                <option value="Essaouira">Essaouira</option>
                <option value="Fes">Fes</option>
                <option value="Figuig">Figuig</option>
                <option value="Guelmim">Guelmim</option>
                <option value="Ifrane">Ifrane</option>
                <option value="Kenitra">Kenitra</option>
                <option value="Khemisset">Khemisset</option>
                <option value="Khenifra">Khenifra</option>
                <option value="Khouribga">Khouribga</option>
                <option value="Laayoune">Laayoune</option>
                <option value="Larache">Larache</option>
                <option value="Marrakech">Marrakech</option>
                <option value="Meknes">Meknes</option>
                <option value="Nador">Nador</option>
                <option value="Ouarzazate">Ouarzazate</option>
                <option value="Oujda">Oujda</option>
                <option value="Rabat-Sale">Rabat-Sale</option>
                <option value="Safi">Safi</option>
                <option value="Settat">Settat</option>
                <option value="Sidi Kacem">Sidi Kacem</option>
                <option value="Tangier">Tangier</option>
                <option value="Tan-Tan">Tan-Tan</option>
                <option value="Taounate">Taounate</option>
                <option value="Taroudannt">Taroudannt</option>
                <option value="Tata">Tata</option>
                <option value="Taza">Taza</option>
                <option value="Tetouan">Tetouan</option>
                <option value="Tiznit">Tiznit</option>


        </select>
    </div>
    <label for="dateNaissance" class="form-label">Date de naissance</label>
    <div class="input-group mb-3">
        <input type="date"  name="dateNaissance" class="form-control"  >
    </div>
    <label for='email' class="form-label">Email</label>
    <div class="input-group mb-3">
        <input type="email"  name='email' class="form-control"  >
    </div>

    <label for='phone' class="form-label">Phone</label>
    <div class="input-group mb-3">
        <input type="text"  name='phone' class="form-control"  >
    </div>
    <label for='password' class="form-label">Mot de Passe</label>
    <div class="input-group mb-3">
        <input type="password"  name='password' class="form-control"  >
    </div>
    <label for='passwordConfirmation' class="form-label">Confirmer Votre Mot de Passe</label>
    <div class="input-group mb-3">
        <input type="password"  name="passwordConfirmation" id='passwordConfirmation' class="form-control"  >
    </div>
        <button style="margin-left: 150px;margin-top: 30px" class="btn btn-primary btn-lg" name="signup" type="submit">Créer votre Compte</button>

    </form>

</div>

</body>
</html>

