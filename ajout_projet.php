<?php 
session_start();
include("php/config.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajout projet</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="style/style2.css">
</head>


<body>

    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <br><br>
            
            <?php
            $id = $_SESSION['id_startuper'];
            $query = mysqli_query($con,"SELECT * FROM startuper WHERE id_startuper=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_photo = $result['photo'];
            }
            ?>
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outlin"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li>
                    <a href="dashbord1.php" id="profileLink">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="projects1.php" id="projectLink">
                        <span class="icon">
                            <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title " >Projet</span>
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
<br> <br>
            <!-- ================= New  Projet ================ -->
            <div class="details">
                <div class="cardHeader">
                    <h2>details Projet</h2>
                </div>

<?php
   $erreurtitre = $erreurdescription = $erreur_nombre_actions_a_vendre = $erreurprix_action = '';

if (isset($_POST['ajouterprojet'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $nombre_actions_a_vendre = $_POST['nombre_actions_a_vendre'];
    $prix_action = $_POST['prix_action'];
    $id = $_SESSION['id_startuper'];

    // Vérification du champ titre
    if (trim($titre) === '') {
        $erreurtitre = 'Le nom est requis.';
    }
    // Vérification du champ description
    if (trim($description) === '') {
        $erreurdescription = 'La description est requise.';
    }
    // Vérification du champ nombre_actions_a_vendre
    if (trim($nombre_actions_a_vendre) === '') {
        $erreur_nombre_actions_a_vendre = 'Le nombre d actions a vendre est requis.';
    } elseif (!ctype_digit($nombre_actions_a_vendre) || $nombre_actions_a_vendre < 0) {
        $erreur_nombre_actions_a_vendre = 'Le nombre d actions doit etre compose de chiffres numeriques>0';
    }
    // Vérification du champ prix_action
    if (trim($prix_action) === '') {
        $erreurprix_action = 'Le prix d actions vendues est requis.';
    } elseif (!ctype_digit($prix_action) || $prix_action < 0) {
        $erreurprix_action = 'Le prix d actions doit etre compose de chiffres numeriques>0';
    }

    // Si aucune erreur n'est détectée, insérer le projet dans la base de données
    if (empty($erreurtitre) && empty($erreurdescription) && empty($erreur_nombre_actions_a_vendre) && empty($erreurprix_action)) {
        $insertQuery = "INSERT INTO projet (titre, description, nombre_actions_a_vendre, nombre_actions_vendues, prix_action, id_startuper) VALUES ('$titre', '$description', '$nombre_actions_a_vendre', '0', '$prix_action', '$id')";
        if ($con->query($insertQuery) === TRUE) {
            echo  "<div class='message'>
                      <p>Le projet a été ajouté!</p>
                  </div> <br>";
            echo  "<a href='projects1.php'><button class='btn'>Go Back to Projects Page</button></a>";
        } else {
            echo  "<div class='message'>
                <p>Échec de l'ajout!</p>
                     </div> <br>";
            header("Location: ajout_projet.php");
            exit(0);
        }
    }
}
?>

                <form action="#" method="post"> 
                    <table>
                        <tr>
                            <td width="60px">
                                <label for="titre">Titre</label>
                            </td>
                            <td>
                                <input type="text" name="titre" id="titre" autocomplete="off" required>
                                <span class="erreur"><?php echo $erreurtitre; ?></span>

                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <label for="desc">Description </label>
                            </td>
                            <td>
                               <textarea name="description" id="description" autocomplete="off" required></textarea>

                                <span class="erreur"><?php echo $erreurdescription; ?></span>

                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <label for="nombre">nombre_actions_a_vendre</label>
                            </td>
                            <td>
                                <input type="number" min="0" name="nombre_actions_a_vendre" id="nombre_actions_a_vendre" autocomplete="off" required>
                                <span class="erreur"><?php echo $erreur_nombre_actions_a_vendre; ?></span>

                            </td>
                        </tr>



                        <tr>
                            <td width="60px">
                                <label for="prix">prix_action</label>
                            </td>
                            <td>
                                <input type="text" name="prix_action" id="prix_action" autocomplete="off" required>
                                <span class="erreur"><?php echo $erreurprix_action; ?></span>

                            </td>
                        </tr>
                    </table>
                    <button class="btn" type="submit" name="ajouterprojet">+ajouter</button> <!-- Change <a> to <button> -->
                </form> <!-- Close the form tag -->
            </div>
        </div>
    </div>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="style/dashbord.js"></script>

</body>
</html>
