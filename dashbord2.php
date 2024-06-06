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
    <title>Investor dashbord</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="style/style2.css">
</head>


<body>
<?php 
            
            $id = $_SESSION['id_capital_risque'];
            $query = mysqli_query($con,"SELECT * FROM capital_risque WHERE id_capital_risque=$id");
            //La fonction mysqli_query() est une fonction de l'API MySQLi  
            //en PHP qui permet d'exécuter une requête SQL sur une base de données MySQL

            /*La fonction mysqli_fetch_assoc() est une fonction de l'API MySQLi (MySQL Improved)
             en PHP qui permet de récupérer une ligne de résultat sous forme de tableau associatif 
             à partir d'un ensemble de résultats (résultat d'une requête SQL SELECT).*/ 

            while($result = mysqli_fetch_assoc($query)){
                $res_nom = $result['nom'];
                $res_prenom = $result['prenom'];
                $res_email = $result['email'];
                $res_pseudo = $result['pseudo'];
                $res_cin = $result['cin'];
                $res_pwrd = $result['pwrd'];
                $res_id = $result['id_capital_risque'];
            }
            
            ?>

    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation" style="background-color:rgb(9, 102, 114);">
            <ul>
                
            

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
                  <span class="icon">
                   <ion-icon name="home-outline"></ion-icon>
                  </span>             
               </div>
            </div>


            <!-- ================ Profile ================= -->
            <div class="details">
                <div class="details_table">
                    <div class="cardHeader">
                        <h2>Profile</h2>
                       <?php echo "<a href='editprofile2.php?id_capital_risque=$res_id' class='btn'>Changer Profile</a>";?>
                    </div>

                    <table>
                        

                        <tbody>
                            <tr>
                                <td >Pseudo</td>
                                <td> <?php echo $res_pseudo ?></td>
                            </tr>
                            <tr>
                                <td >Nom</td>
                                <td> <?php echo $res_nom ?></td>
                            </tr>

                            <tr>
                                <td>Prenom</td>
                                <td><?php echo $res_prenom ?></td>
                                
                            </tr>

                            <tr>
                                <td><b></b>Email</b></td>
                                <td><?php echo $res_email ?></td>
                                
                            </tr>

                            <tr>
                                <td>Cin</td>
                                <td><?php echo $res_cin ?></td>
                                
                            </tr>

                            <tr>
                                <td>Mot de passe</td>
                                <td><?php echo $res_pwrd ?></td>
                                
                            </tr>

                            
                        </tbody>
                    </table>
                </div>
        </div>

            


 <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="style/dashbord.js"></script>

</body>
</html>