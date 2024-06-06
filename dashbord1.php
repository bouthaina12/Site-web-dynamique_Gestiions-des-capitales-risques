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
<?php 
            
            $id = $_SESSION['id_startuper'];
            $query = mysqli_query($con,"SELECT * FROM startuper WHERE id_startuper=$id");


            while($result = mysqli_fetch_assoc($query)){
                $res_nom = $result['nom'];
                $res_prenom = $result['prenom'];
                $res_email = $result['email'];
                $res_pseudo = $result['pseudo'];
                $res_photo = $result['photo'];
                $res_nom_entreprise= $result['nom_entreprise'];
                $res_adresse_entreprise= $result['adresse_entreprise'];
                $res_numero_registre_commerce= $result['numero_registre_commerce'];
                $res_cin = $result['cin'];
                $res_pwrd = $result['pwrd'];
                $res_id = $result['id_startuper'];
            }
            
            ?>

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
                        <span class="title log" >Déconnexion</span>
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


            <!-- ================ Profile ================= -->

<div id="profile">
            <div class="details">
                <div class="details_table">
                    <div class="cardHeader">
                        <h2>Profile</h2>
                       <?php echo "<a href='editprofile1.php?id_startuper=$res_id' class='btn'>Change Profile</a>";?>
                    </div>

                    <table>
                        

                        <tbody>
                            <tr>
                                <td >Pseudo</td>
                                <td><p> <b><?php echo $res_pseudo ?></b></p></td>
                            </tr>
                            <tr>
                                <td >Nom</td>
                                <td><p> <b><?php echo $res_nom ?></b></p></td>
                            </tr>

                            <tr>
                                <td>Prenom</td>
                                <td><b><?php echo $res_prenom ?></b></td>
                                
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
                                <td>Pseudo</td>
                                <td><?php echo $res_pseudo ?></td>
                                
                            </tr>

                            <tr>
                                <td>Nom entreprise</td>
                                <td><?php echo $res_nom_entreprise ?></td>

                            </tr>

                            <tr>
                                <td>Adresse_entreprise</td>
                                <td><?php echo $res_adresse_entreprise ?>
                            </td>

                            </tr>

                            <tr>
                                <td>Numero_registre_commerce</td>
                                <td><b><?php echo $res_numero_registre_commerce ?></b></td>
                                
                            </tr>
                            <tr>
                                <td>Mot de passe</td>
                                <td><b><?php echo $res_pwrd ?></b></td>
                                
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

</body>
</html>