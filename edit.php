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
    <link rel="stylesheet" href="style/style.css">
    <title>Changer Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="homepage.html"> HOME</a></p>
        </div>

        <div class="right-links">
            <a href="php/logout.php">Changer Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $cin = $_POST['cin'];

                $id = $_SESSION['id_startuper'];

                $edit_query = mysqli_query($con,"UPDATE startuper SET pseudo='$pseudo', email='$email', cin='$cin' WHERE id_startuper=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='dashbord1.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id_startuper'];
                $query = mysqli_query($con,"SELECT*FROM startuper WHERE id_startuper=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_pseudo= $result['pseudo'];
                    $res_email = $result['email'];
                    $res_cin = $result['cin'];
                }

            ?>
            <header>Change Profile</header>
            <form  id="Form" action="" method="post">
                <div class="field input">
                    <label for="username">pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" value="<?php echo $res_pseudo; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="cin">cin</label>
                    <input type="number" name="cin" id="cin" value="<?php echo $res_cin; ?>" autocomplete="off" required>
                </div>
                
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
    <script src="style/controljs.js"></script>
</body>
</html>