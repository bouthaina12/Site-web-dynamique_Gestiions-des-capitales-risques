<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Login</title>
</head>
<body>
<header class="header" id="header" >

<a href="homepage.html" classe="logo" ><h1>Home</h1>
   
</a></header>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("php/config.php");
              if(isset($_POST['submit'])){
                $pseudo = mysqli_real_escape_string($con,$_POST['pseudo']);
                $pwrd = mysqli_real_escape_string($con,$_POST['pwrd']);

                $result = mysqli_query($con,"SELECT * FROM capital_risque WHERE pseudo='$pseudo' AND pwrd='$pwrd' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['pseudo'];
                    $_SESSION['nom'] = $row['nom'];
                    $_SESSION['prenom'] = $row['prenom'];
                    $_SESSION['cin'] = $row['cin'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id_capital_risque'] = $row['id_capital_risque'];
                }else{
                    echo "<div class='message'>
                      <p>Wrong pseudo or mot de passe</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    header("Location: liste_projets.php");
                }
              }else{

            
            ?>
            <header>Connexion Investiseur</header>
            <form action="" method="post" class="form-group">
  <div class="field input mb-3">
    <label for="pseudo" class="form-label">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" autocomplete="off" required class="form-control">
  </div>

  <div class="field input mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="pwrd" id="pwrd" autocomplete="off" required class="form-control">
  </div>

  <div class="field mb-3">
    <input type="submit" class="btn btn-primary" name="submit" value="Login" required style="background-color: rgb(9, 102, 114);">
  </div>

  <div class="links">
    Vous n'avez pas de compte ? <a href="register.php" style="color: rgb(9, 102, 114);">Inscrivez-vous maintenant</a>
  </div>
</form>
        </div>
        <?php } ?>
      </div>
</body>
</html>