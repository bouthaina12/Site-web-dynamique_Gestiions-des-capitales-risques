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
    <title></title>
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
                        <span class="title log" >Sign Out</span>
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
                    <img src="img/<?php echo $_SESSION['photo'] ?>" alt="">
                </div>
            </div>


            <!-- ================ Projet ================= -->
<div id="projet">


<!-- ======================= Cards ================== -->
    <div class="cardBox">
        <div class="card">

            <!-- Récupérer les totaux à partir de la base de données -->
<?php   
    $id = $_SESSION['id_startuper'];
    $totalProjetsQuery = mysqli_query($con,"SELECT COUNT(*) AS total_projets FROM projet WHERE id_startuper=$id");
    $totalActionsAVendreQuery = mysqli_query($con,"SELECT SUM(nombre_actions_a_vendre) AS total_actions_a_vendre FROM projet WHERE id_startuper=$id");
    $totalActionsVenduesQuery = mysqli_query($con,"SELECT SUM(nombre_actions_vendues) AS total_actions_vendues FROM projet WHERE id_startuper=$id");
    $totalMontantCollecteQuery = mysqli_query($con,"SELECT SUM(prix_action * nombre_actions_vendues) AS total_montant_collecte FROM projet WHERE id_startuper=$id");

    // Initialisation des variables
    $result_totalProjets = 0;
    $result_totalActionsAVendre = 0;
    $result_totalActionsVendues = 0;
    $result_totalMontantCollecte = 0;

    // Récupérer les valeurs des totaux
    if($totalProjetsQuery && $totalActionsAVendreQuery && $totalActionsVenduesQuery && $totalMontantCollecteQuery) {
        $result_totalProjetsData = mysqli_fetch_assoc($totalProjetsQuery);
        $result_totalActionsAVendreData = mysqli_fetch_assoc($totalActionsAVendreQuery);
        $result_totalActionsVenduesData = mysqli_fetch_assoc($totalActionsVenduesQuery);
        $result_totalMontantCollecteData = mysqli_fetch_assoc($totalMontantCollecteQuery);

        // Assigner les valeurs aux variables
        $result_totalProjets = $result_totalProjetsData['total_projets'];
        $result_totalActionsAVendre = $result_totalActionsAVendreData['total_actions_a_vendre'];
        $result_totalActionsVendues = $result_totalActionsVenduesData['total_actions_vendues'];
        $result_totalMontantCollecte = $result_totalMontantCollecteData['total_montant_collecte'];
    }
?>
    <div>
        <div class="numbers"><?php echo $result_totalProjets; ?></div>
        <div class="cardName">Total projets</div>
    </div>
    <div class="iconBx">
        <ion-icon name="eye-outline"></ion-icon>
    </div>
</div>

<div class="card">
    <div>
        <div class="numbers"><?php echo $result_totalActionsAVendre; ?></div>
        <div class="cardName">Total actions à vendre</div>
    </div>
    <div class="iconBx">
        <ion-icon name="cart-outline"></ion-icon>
    </div>
</div>

<div class="card">
    <div>
        <div class="numbers"><?php echo $result_totalActionsVendues; ?></div>
        <div class="cardName">Total actions vendues</div>
    </div>
    <div class="iconBx">
        <ion-icon name="chatbubbles-outline"></ion-icon>
    </div>
</div>

<div class="card">
    <div>
        <div class="numbers"><?php echo $result_totalMontantCollecte; ?></div>
        <div class="cardName">Total montant collecté</div>
    </div>
    <div class="iconBx">
        <ion-icon name="cash-outline"></ion-icon>
    </div>
</div>

</div>
    <!-- ================ Projects Details List ================= -->
    <div id="projet">
    <!-- ================ Projects Details List ================= -->
    <div class="details">
        <div class="details_table">
            <div class="cardHeader">
                <h2>Liste des Projets</h2>
                <a href="ajout_projet.php" class="btn">+ajouter projet</a>
            </div>
            <table    style="border-collapse: collapse;">
                <thead>
                    <tr style="border: 1px solid black;">
                        <td style="text-align:center;border: 1px solid black;"  width="60px" > Titre</td>
                        <td style="text-align:center;border: 1px solid black;"  width="60px"> Description</td>
                        <td style="text-align:center;border: 1px solid black;"  width="60px"> Actions a vendre</td>
                        <td  style="text-align:center;border: 1px solid black;" width="60px"> Action vendues</td>
                        <td  style="text-align:center;border: 1px solid black;" width="60px"> Montant collecté</td>
                        <td  style="text-align:center;border: 1px solid black;" width="60px"> Statut</td>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        $id = $_SESSION['id_startuper'];
                        $query = mysqli_query($con,"SELECT * FROM projet WHERE id_startuper=$id");
                        // Check if there are projects
                        if(mysqli_num_rows($query) > 0) {
                            while($result = mysqli_fetch_assoc($query)){
                                $res_id = $result['id_projet'];
                                $res_titre = $result['titre'];
                                $res_description = $result['description'];
                                $res_nombre_actions_a_vendre = $result['nombre_actions_a_vendre'];
                                $res_nombre_actions_vendues = $result['nombre_actions_vendues'];
                                $prix_action = $result['prix_action'];
                                $montant_collecte = $prix_action * $res_nombre_actions_vendues; // Calculating collected amount
                    ?>
                    <tr style="border: 1px solid black;">
                        <td style="text-align:center;border: 1px solid black;"><?php echo $res_titre ?></td>
                        <td id="description_<?php echo $res_id; ?>" style="text-align: center; border: 1px solid black;word-break: break-all;">

    <!-- Limiter la quantité de texte affichée initialement à 100 caractères -->
   
   <?php 
        $trimmed_description = strlen($res_description) > 9 ? substr($res_description, 0, 9) . '...' : $res_description;
        echo $trimmed_description;
    ?>
    <?php if (strlen($res_description) > 9): ?>
        <a href="#" onclick="showFullDescription('<?php echo $res_id; ?>', '<?php echo $res_description; ?>')">Voir plus</a>
    <?php endif; ?>

                        </td>               

                        <td style="text-align:center;border: 1px solid black;"><?php echo $res_nombre_actions_a_vendre ?></td>
                        <td style="text-align:center;border: 1px solid black;"><?php echo $res_nombre_actions_vendues ?></td>
                        <td style="text-align:center;border: 1px solid black;"><?php echo $montant_collecte ?></td>
                        <td style="text-item:center;border: 1px solid black;">
            
                        <a href="supprimer.php?id_projet=<?php echo $res_id; ?>" class="btn" onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php
                            } // End of while loop
                        } else {
                            echo "<tr><td colspan='5'   style='text-item:center;border: 1px solid black;'>aucun projets.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="style/dashbord.js"></script>

<script>
    function showFullDescription(id, fullDescription) {
        var descriptionCell = document.getElementById('description_' + id);
        descriptionCell.innerHTML = fullDescription;
    }
</script>


</body>
</html>