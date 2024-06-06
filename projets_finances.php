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
                            <ion-icon name="home_outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li>
                    <a href="dashbord2.php" id="profileLink">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="projets_a_financer.php" id="projectLink">
                        <span class="icon">
                            <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title " >Projets a financer</span>
                    </a>
                
                </li>
                <li>
                    <a href="projets_finances.php" id="projectLink">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title " >Projets  finances</span>
                    </a>
                
                </li>
                <li>
                    <a href="index.php">
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


            </div>


            <!-- ================ Projet ================= -->
<div id="projet">


<!-- ======================= Cards ================== -->
    <div class="cardBox">
        <div class="card">
        <?php   
    // Initialisation des variables
    $result_totalProjets = 0;
    $result_totalActionsAchetees = 0;
    $result_totalMontantInvesti = 0;
    $id = $_SESSION['id_capital_risque'];
    
    // Requête pour récupérer le total des projets et des actions achetées
    $query_total = mysqli_query($con, "SELECT COUNT(*) AS total_projets, SUM(nombre_actions_achetees) AS total_actions_achetees FROM capital_risque_projet WHERE id_capital_risque=$id");
    
    // Vérifier si la requête a abouti
    if ($query_total && mysqli_num_rows($query_total) > 0) {
        $row = mysqli_fetch_assoc($query_total);
        $result_totalProjets = $row['total_projets'];
        $result_totalActionsAchetees = $row['total_actions_achetees'];
    }

    // Requête pour récupérer le total du montant investi
    $query_montant = mysqli_query($con, "SELECT SUM(prix_action * nombre_actions_achetees) AS total_montant_investi FROM capital_risque_projet INNER JOIN projet ON capital_risque_projet.id_projet = projet.id_projet WHERE id_capital_risque=$id");
    
    // Vérifier si la requête a abouti
    if ($query_montant && mysqli_num_rows($query_montant) > 0) {
        $row = mysqli_fetch_assoc($query_montant);
        $result_totalMontantInvesti = $row['total_montant_investi'];
    }
?>
            <div>
                <div class="numbers"><?php echo $result_totalProjets ?></div>
                <div class="cardName">Total projets</div>
            </div>

            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><?php echo $result_totalActionsAchetees ?></div>
                <div class="cardName">total Actions Achetees</div>
            </div>

            <div class="iconBx">
                <ion-icon name="cart-outline"></ion-icon>
            </div>
        </div>

 

        <div class="card" >
            <div>
                <div class="numbers"><?php echo $result_totalMontantInvesti ?></div>
                <div class="cardName">total Montant Investi</div>
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
                <h2>Liste des Projets finances</h2>
            </div>
            <table    style="border-collapse: collapse;">
                <thead>
                    <tr style="border: 1px solid black;">
                        <td style="text-align:center;border: 1px solid black;"  width="60px" > Titre</td>
                        <td style="text-align:center;border: 1px solid black;"  width="60px"> Nombre d'actions achetes</td>
                        <td style="text-align:center;border: 1px solid black;"  width="60px"> Prix total de mon investissement </td>

                    </tr>
                </thead>
                <tbody>
                    <?php   
                       // Initialisation des variables
                        $totalProjets = 0;
                        $totalActionsAchetees = 0;
                        $totalMontantInvesti = 0;
                        $id = $_SESSION['id_capital_risque'];
                        $query = mysqli_query($con,"SELECT * FROM capital_risque_projet WHERE id_capital_risque=$id");
                        // Check if there are projects
                        if(mysqli_num_rows($query) > 0 &&$query) {
                            while($result = mysqli_fetch_assoc($query)) {
                                $res_id = $result['id'];
                                $res_id_projet = $result['id_projet'];
                                $nombre_actions_achetees = $result['nombre_actions_achetees'];
                                // Mise à jour des variables avec les nouvelles valeurs
                                $totalProjets++;
                                $totalActionsAchetees += $nombre_actions_achetees;

                                // Récupération du prix d'une action
                                $prix_query = mysqli_query($con, "SELECT prix_action FROM projet WHERE id_projet=$res_id_projet");
                                if($prix_query && mysqli_num_rows($prix_query) > 0) { // Vérification de la requête
                                    $prix_result = mysqli_fetch_assoc($prix_query);
                                    $prix_action = $prix_result['prix_action'];
                                    $montant_investit = $prix_action * $nombre_actions_achetees;
                                    $totalMontantInvesti += $montant_investit;

                                } else {
                                    $montant_investit = 0; // Si la requête échoue, définir le montant sur 0
                                }
                                // Récupération du titre du projet
                                $titre_query = mysqli_query($con, "SELECT titre FROM projet WHERE id_projet=$res_id_projet");
                                if($titre_query && mysqli_num_rows($titre_query) > 0) { // Vérification de la requête
                                    $titre_result = mysqli_fetch_assoc($titre_query);
                                    $res_titre = $titre_result['titre'];
                                } else {
                                    $res_titre = "Titre inconnu"; // Si la requête échoue, définir un titre par défaut
                                }
                                ?>
                    <tr style="border: 1px solid black;">
                        <td style="text-align:center;border: 1px solid black;"><?php echo $res_titre ?></td>
                                   

                        <td style="text-align:center;border: 1px solid black;"><?php echo $nombre_actions_achetees?></td>
                        <td style="text-align:center;border: 1px solid black;"><?php echo $montant_investit ?></td>
        
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