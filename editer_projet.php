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
    <title> </title>
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
                    <a href="dashbord2.php" id="profileLink">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="projets_a_finacer.php" id="projectLink">
                        <span class="icon">
                            <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title " >Projets  à financer</span>
                    </a>
                
                </li>
                <li>
                    <a href="projets_finances.php" >
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title " >Projets  financès</span>
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

                

        </div>


            <!-- ================ Projet ================= -->
<div id="projet">

    <!-- ================ Projects Details List ================= -->
    <div class="details">
    <div class="details_table">
        <div class="cardHeader">
        <?php


if (isset($_GET['id_projet'])) {
    $id_projet = mysqli_real_escape_string($con, $_GET['id_projet']);

    $query = mysqli_query($con, "SELECT * FROM projet WHERE id_projet = $id_projet");


    if (mysqli_num_rows($query) > 0) {
        while ($result = mysqli_fetch_assoc($query)) {
            $res_id = $result['id_projet'];
            $res_titre = $result['titre'];
            $res_description = $result['description'];
            $res_nombre_actions_a_vendre = $result['nombre_actions_a_vendre'];
            $res_nombre_actions_vendues = $result['nombre_actions_vendues'];
            $prix_action = $result['prix_action'];
        }
    } else {
        echo "<script>alert('ID du projet non fourni.');</script>";
    }}



?>
            <h2>Description de Projet</h2>
            <!-- Form for investing input -->
            <form id="buyingForm" method="GET" action="acheter.php">
                <div class="search">
                    <label>
                        <input type="hidden" name="id_projet" value="<?php echo $res_id; ?>">

                        <input id="buyInput" name="buying" type="number"  min="0" placeholder=" buy here">
                        <button type="submit" onclick="return confirm('Voulez-vous vraiment investir dans ce projet ?');"><ion-icon name="cart-outline" ></ion-icon></button>
                    </label>
                </div>
            </form>
            <!-- End of Form -->
        </div>
        <table style="border-collapse: collapse;">
            <thead>
                <tr style="border: 1px solid black;">
                    <td style="text-align:center;border: 1px solid black;" width="60px"> Titre</td>
                    <td style="text-align:center;border: 1px solid black;"  width="60px"> Description</td>
                    <td style="text-align:center;border: 1px solid black;"  width="60px"> Actions reste a vendre</td>
                    <td  style="text-align:center;border: 1px solid black;" width="60px"> Prix Action</td>
            </thead>
            <tbody>
        
    
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
                        <td style="text-align:center;border: 1px solid black;"><?php echo $prix_action?></td>
                </tr>

            </tbody>
        </table>
    </div>

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