<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> iediter profile investor </title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="style/style2.css">

</head>


<body>


    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
            <li>
                    <a href="homepage.html">
                        <span class="icon">
                            <ion-icon name="Home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>e
                <li>
                    <a href="dashbord2.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="projets_a_financer.php">
                        <span class="icon">
                            <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title">Projet a financer</span>
                    </a>
                
                </li>
                <li>
                    <a href="projets_finances.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Projet  finances</span>
                    </a>
                
                </li>
                <li>
                    <a href="php/logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title log" >Deconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="img/<?php echo $res_photo ?>" alt="">
                </div>
            </div>


            <!-- ================ Edit Profile ================= -->

    <div class="container_form">
        <div class="box form-box">
        <?php 
                   // Vérification du pseudo dès le chargement de la page
               if (isset($_POST['pseudo'])) {
               $pseudo = $_POST['pseudo'];
           
               $verify_query = mysqli_query($con, "SELECT pseudo FROM capital_risque WHERE pseudo='$pseudo'");
               if (mysqli_num_rows($verify_query) != 0) {
                   $erreurPseudo = 'Ce pseudo est déjà utilisé. Veuillez en choisir un autre.';
               }
           }
               if(isset($_POST['submit'])){
                $pseudo = $_POST['pseudo'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $cin = $_POST['cin'];
                $pwrd = $_POST['pwrd'];
                $id = $_SESSION['id_capital_risque'];
                
                // Modification dans la base 


                $edit_query = mysqli_query($con,"UPDATE capital_risque SET pseudo='$pseudo', email='$email', cin='$cin', nom='$nom', prenom='$prenom' WHERE id_capital_risque=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                          <p class='classe1'>     <b> Profile Updated! </b>   </p>
                          </div> <br>";
                     echo "<a href='dashbord2.php'><button class='btn'>Go To dashbord</button>";
       
                }
               }else{

                $id = $_SESSION['id_capital_risque'];
                $query = mysqli_query($con,"SELECT*FROM capital_risque WHERE id_capital_risque=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_nom = $result['nom'];
                    $res_prenom = $result['prenom'];
                    $res_email = $result['email'];
                    $res_cin = $result['cin'];
                    $res_pseudo = $result['pseudo'];
                    $res_pwrd = $result['pwrd'];
                    $res_id = $result['id_capital_risque'];
                }

            ?>
            <header>Change Profile</header>
            <form id="Form" action="" method="post">
                <div class="field input">
                    <label for="pseudo">pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" value="<?php echo $res_pseudo; ?>" autocomplete="off" required>
                    <span class="erreur" id="erreur_pseudo"></span>

                </div>
                <div class="field input">
                      <label for="nom">Nom</label>
                     <input type="text" name="nom" id="nom"  value="<?php echo $res_nom; ?>" autocomplete="off" required>
                     <span class="erreur" id="erreurNom"></span>
               </div>
               <div class="field input">
                     <label for="prenom">Prénom</label>
                     <input type="text" name="prenom" id="prenom"  value="<?php echo $res_prenom; ?>" autocomplete="off" required>
                      <span class="erreur" id="erreurPrenom"></span>
               </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_email; ?>" autocomplete="off" required>
                    <span class="erreur" id="erreurEmail"></span>

                </div>

                <div class="field input">
                    <label for="cin">cin</label>
                    <input type="text" name="cin" id="cin" value="<?php echo $res_cin; ?>" autocomplete="off" required>
                    <span class="erreur" id="erreurCin"></span>

                </div>


        <div class="field input">
            <label for="pwrd">Mot de passe</label>
            <input type="password" name="pwrd" id="pwrd"  value="<?php echo $res_pwrd?>"; autocomplete="off" required>
            <span class="erreur" id="erreurmotdepasse"></span>
        </div>
       
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
            


 <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="style/dashbord.js"></script>
    <script src="style/controljs.js"></script>
</body>
</html>