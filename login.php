<?php
require_once "Connection_DB.php";
session_start();
try
{

    if(isset($_POST["login"]))
    {
        if(empty($_POST["username"]) || empty($_POST["password"]))
        {
            $message = '<label>All fields are required</label>';
        }
        else
        {
            $query = "SELECT * FROM etudiant WHERE email = :username AND password = :password";
            $conn=Connection_DB::getConnection();
            $statement = $conn->prepare($query);


            $statement->execute(
                array(
                    'username'     =>     $_POST["username"],
                    'password'     =>     $_POST["password"]
                )
            );
            $count = $statement->rowCount();
            if($count > 0)
            {
                $mail=$_POST["username"];
                $stmt = $conn->prepare("SELECT nom,prenom FROM etudiant WHERE email=?");
                $stmt->execute([$mail]);
                $nom_prenom = $stmt->fetch();
                $_SESSION['currentUserName']=$nom_prenom['nom']." ".$nom_prenom['prenom'];
                header("location: home.php");
            }
            else
            {
                $message = '<label>Wrong Data</label>';
            }
        }
    }
}
catch(PDOException $error)
{
    $message = $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="">
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<br />
<div class="container" style="width:500px;height:300px;border-radius:10px;background-color: white">
    <?php
    if(isset($message))
    {
        echo '<label class="text-danger">'.$message.'</label>';
    }
    ?>
    <h3 align="">Login</h3><br />
    <form method="post">
        <label class="form-label" >Username</label>
        <input type="text" name="username" class="form-control" />
        <br />
        <label class="form-label" >Password</label>
        <input type="password" name="password" class="form-control" />
        <br />
        <input type="submit" name="login" class="btn btn-primary btn-lg" value="Login" />
    </form>
</div>
<br />
</body>
</html>
