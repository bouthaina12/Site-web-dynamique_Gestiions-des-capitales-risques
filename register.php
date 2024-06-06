<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Register</title>
</head>
<body>
<header class="header" id="header" >
    <a href="homepage.html" class="logo"><h1>Home</h1></a>
</header>

<div class="container">
    <div class="box form-box">
    <?php 
class investor {
  public $nom;
  public $prenom;
  public $email;
  public $cin;
  public $pseudo;
  public $pwrd;
  public $erreurs = [];

  public function __construct($nom, $prenom, $email, $cin, $pseudo, $pwrd){
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->email = $email;
    $this->cin = $cin;
    $this->pseudo = $pseudo;

    $this->pwrd = $pwrd;
   
  }

 

  public function save() {
    include("php/config.php");
    if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];

    $verify_query = mysqli_query($con, "SELECT pseudo FROM capital_risque
     WHERE pseudo='$pseudo'");
    if (mysqli_num_rows($verify_query) != 0) {
        $erreurPseudo = 'Ce pseudo est déjà utilisé. Veuillez en choisir un autre.';
    }
}
// 2. Prepare SQL INSERT statement
$sql = "INSERT INTO capital_risque (nom, prenom, email, cin, pseudo,pwrd) 
VALUES (?, ?, ?, ?, ?, ?)";

// 3. Prepare and execute the statement
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $this->nom,
 $this->prenom, $this->email, $this->cin, $this->pseudo, $this->pwrd);
$result = mysqli_stmt_execute($stmt);

// 4. Check execution result and return accordingly
if ($result) {
  return true;
} else {
  // Handle potential errors 
  return false;
}
}}

class Register {
  public function __construct() {
    include("php/config.php");
  }

  public function handleRegistration() {
    if (isset($_POST['submit'])) {
      $investor = new investor(
        $_POST['nom'],$_POST['prenom'],
        $_POST['email'],$_POST['cin'],
        $_POST['pseudo'], $_POST['pwrd'], );
 if ($investor->save()) {
        // Registration successful message
        echo "<div class='message'>
                <p>Registration successfully!</p>
              </div> <br>";
      } else {
        // Display validation errors
        echo "<ul>";
        foreach ($investor->erreurs as $erreur) {
          echo "<li>$erreur</li>";
        }
        echo "</ul>";}}}}
 $register = new Register();
 $register->handleRegistration();

        ?>

        
        

        
        <header>Inscrivez-vous en tant que Investisseur</header>
        <form id="Form" action="" method="post" class="form-group">

  <div class="field input mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" name="nom" id="nom" autocomplete="off" required class="form-control">
    <span class="erreur" id="erreurNom"></span>
  </div>

  <div class="field input mb-3">
    <label for="prenom" class="form-label">Prénom</label>
    <input type="text" name="prenom" id="prenom" autocomplete="off" required class="form-control">
    <span class="erreur" id="erreurPrenom"></span>
  </div>

  <div class="field input mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" name="email" id="email" autocomplete="off" required class="form-control">
    <span class="erreur" id="erreurEmail"></span>
  </div>

  <div class="field input mb-3">
    <label for="cin" class="form-label">CIN</label>
    <input type="text" name="cin" id="cin" autocomplete="off" required class="form-control">
    <span class="erreur" id="erreurCin"></span>
  </div>

  <div class="field input mb-3">
    <label for="pseudo" class="form-label">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" autocomplete="off" required class="form-control">
    <span class="erreur" id="erreur_pseudo"></span>
  </div>

  <div class="field input mb-3">
    <label for="pwrd" class="form-label">Mot de passe</label>
    <input type="password" name="pwrd" id="pwrd" autocomplete="off" required class="form-control">
    <span class="erreur" id="erreurmotdepasse"></span>
  </div>

  <div class="field mb-3">
    <input type="submit" class="btn btn-primary" name="submit" value="S'inscrire" style="background-color: rgb(9, 102, 114);">
  </div>

  <div class="links">
    Vous avez déjà un compte ? <a href="index.php" style="color: rgb(9, 102, 114);">Connectez-vous</a>
  </div>

</form>
    </div>
</div>
<script src="style/controljs.js"></script>
</body>
</html>