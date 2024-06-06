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


<!-- ======================= Cards ================== -->
    
    <!-- ================ Projects Details List ================= -->
    <div class="details">
    <div class="details_table">
        <div class="cardHeader">
            <h2>Liste des Projets</h2>
            <!-- Form for search input -->
            <form id="searchForm" method="GET" action="">
                <div class="search">
                    <label>
                        <input id="searchInput" name="keyword" type="text" placeholder="Search here">
                        <button type="submit" ><ion-icon name="search-outline"></ion-icon></button>
                    </label>
                </div>
            </form>
            <!-- End of Form -->
        </div>
        <table style="border-collapse: collapse;">
            <thead>
                <tr style="border: 1px solid black;">
                    <td style="text-align:center;border: 1px solid black;" width="60px"> Titre</td>
                    <td style="text-align:center;border: 1px solid black;" width="30px"> Activite</td>
                </tr>
            </thead>
            <tbody>
                <?php   
                    if (isset($_GET['keyword'])) {
                        $keyword = $_GET['keyword'];
                        $query = mysqli_query($con, "SELECT * FROM projet WHERE description LIKE '%$keyword%'");
                    } else {
                        $query = mysqli_query($con, "SELECT * FROM projet");
                    }
                    
                    // Check if there are projects
                    if(mysqli_num_rows($query) > 0) {
                        while($result = mysqli_fetch_assoc($query)){
                            $res_id = $result['id_projet'];
                            $res_titre = $result['titre'];
                ?>
                <tr style="border: 1px solid black;">
                    <td style="text-align:center;border: 1px solid black;"><?php echo $res_titre ?></td>
                    <td style="text-item:center;border: 1px solid black;">
                        <a href="editer_projet.php?id_projet=<?php echo $res_id; ?>" class="btn" style="padding: 10px 20px; 
        font-size: 16px; " >editer</a>
                    </td>
                </tr>
                <?php
                        } // End of while loop
                    } else {
                        echo "<tr><td colspan='2' style='text-item:center;border: 1px solid black;'>aucun projets.</td></tr>";
                    }
                ?>
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


</body>
</html>
