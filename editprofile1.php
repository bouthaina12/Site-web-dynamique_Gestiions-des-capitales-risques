<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index2.php");
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changer profile startuper</title>
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
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li>
                    <a href="dashbord1.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="projects1.php">
                        <span class="icon">
                            <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title">Projet</span>
                    </a>
                
                </li>
                <li>
                    <a href="index2.php">
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

                
            </div>


            <!-- ================ Edit Profile ================= -->

    <div class="container_form">
        <div class="box form-box">
        <?php 
                   // Vérification du pseudo dès le chargement de la page
               if (isset($_POST['pseudo'])) {
               $pseudo = $_POST['pseudo'];
           
               $verify_query = mysqli_query($con, "SELECT pseudo FROM startuper WHERE pseudo='$pseudo'");
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
                $photo = $_POST['photo'];
                $pwrd = $_POST['pwrd'];

                $nom_entreprise= $_POST['nom_entreprise'];
                $adresse_entreprise= $_POST['adresse_entreprise'];
                $numero_registre_commerce= $_POST['numero_registre_commerce'];
                $id = $_SESSION['id_startuper'];
                $photo = $_POST['photo'];
                
                /*// Vérification du champ nom
                if (trim($nom) === '') {
                    $erreurNom = 'Le nom est requis.';
                }
                elseif (!preg_match('/^[a-zA-Z\s]+$/', $nom)) {
                    $erreurNom = 'Veuillez saisir un nom contient des lettres alphabetiques seulement.';
                }
                // Vérification du champ prenom
                if (trim($prenom)=== '') {
                    $erreurPrenom = 'Le prénom est requis.';
                } elseif (!preg_match('/^[a-zA-Z\s]+$/', $prenom)) {
                    $erreurPrenom = 'Veuillez saisir un prenoms contient des lettres alphabetiques seulement.';
                }
                
                // Vérification du champ email
                if (trim($email)=== '') {
                    $erreurEmail = 'L\'email est requis.';
                } elseif (!preg_match('/^\S+@\S+\.\S+$/', $email)) {
                    $erreurEmail = 'Veuillez saisir une adresse email valide.';
                }
                
                // Vérification du champ cin
                if (trim($cin)=== '' || !ctype_digit($cin) || strlen($cin) !== 8) {
                    $erreurCin = 'Le numéro CIN doit être composé de 8 chiffres.';
                }
                
                // Vérification du champ pseudo
                if (trim($pseudo)=== '') {
                    $erreurPseudo = 'Le pseudo est requis.';
                }
                // Vérification du champ photo
                if (empty($photo)) {
                    $erreurPhoto = 'photo est requise.';
                }
                // Vérification du champ nom entreprise
                if (trim($nom_entreprise)==='') {
                    $erreurNom_entreprise = 'entreprise est requise.';
                }
                // Vérification du champ adresse entreprise
                if (trim($adresse_entreprise)==='') {
                    $erreurAdresse_entreprise = 'adresse entreprise est requise.';
                }
                // Vérification du champ numero registre
                if (trim($numero_registre_commerce)==='') {
                    $erreurNumero_registre_commerce = 'numero_registre_commerce est requise.';
                }
                elseif (!preg_match('/^[A-Z]\d{10}$/', $numero_registre_commerce)) {
                    $erreurNumero_registre_commerce= 'Le numero doit etre formé par une lettre majuscule suivie de 10 chiffres';
                }
                // Vérification du champ mot de passe
                if (trim($pwrd)=== '') {
                    $erreurMotDePasse = 'Le mot de passe est requis.';
                } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}[$#]$/', $pwrd)) {
                    $erreurMotDePasse = 'Le mot de passe doit contenir au moins 8 caractères alphanumériques et se terminer par $ ou #.';
                }
                */
                // Modification dans la base 


                $edit_query = mysqli_query($con,"UPDATE startuper SET pseudo='$pseudo', email='$email', cin='$cin',photo='$photo', nom='$nom', prenom='$prenom', nom_entreprise='$nom_entreprise', adresse_entreprise='$adresse_entreprise', numero_registre_commerce='$numero_registre_commerce' WHERE id_startuper=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                          <p >     <b> Profile Updated! </b>   </p>
                          </div> <br>";
                     echo "<a href='dashbord1.php'><button class='btn'>Go To dashbord</button>";
       
                }
               }else{

                $id = $_SESSION['id_startuper'];
                $query = mysqli_query($con,"SELECT*FROM startuper WHERE id_startuper=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_nom = $result['nom'];
                    $res_prenom = $result['prenom'];
                    $res_email = $result['email'];
                    $res_cin = $result['cin'];
                    $res_pseudo = $result['pseudo'];

                    $res_photo = $result['photo'];
                    $res_pwrd = $result['pwrd'];

                    $res_nom_entreprise = $result['nom_entreprise'];
                    $res_adresse_entreprise = $result['adresse_entreprise'];
                    $res_numero_registre_commerce = $result['numero_registre_commerce'];
                    

                    $res_id = $result['id_startuper'];
                }

            ?>
            <header>Changer Profile</header>
            <form  id="Form" action="" method="post">
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
                    <input type="number" name="cin" id="cin" value="<?php echo $res_cin; ?>" autocomplete="off" required>
                    <span class="erreur" id="erreurCin"></span>

                </div>
                <div class="field input">
            <label for="Nom entreprise">Nom entreprise</label>
            <input type="text" name="nom_entreprise" value="<?php echo $res_nom_entreprise; ?>"id="nom_entreprise" autocomplete="off" required>
            <span class="erreur" id="erreurNom_entreprise"></span>
        </div>
        <div class="field input">
            <label for="adresse entreprise">Adresse entreprise</label>
            <input type="text" name="adresse_entreprise" id="adresse_entreprise" value="<?php echo $res_adresse_entreprise; ?>"autocomplete="off" required>
            <span class="erreur" id="erreurAdresse_entreprise"></span>
        </div>
        <div class="field input">
            <label for="numero registre">numero_registre_commerce</label>
            <input type="text" name="numero_registre_commerce" id="numero_registre_commerce"value="<?php echo $res_numero_registre_commerce; ?>" autocomplete="off" required>
            <span class="erreur" id="erreurNumero_registre_commerce"></span>
        </div>

        <div class="field input">
            <label for="photo">Photo d'identite</label>
            <input type="file" name="photo" id="photo" value="<?php echo $res_photo; ?>"autocomplete="off" required>
            <span class="erreur" id="erreur_photo"></span>
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