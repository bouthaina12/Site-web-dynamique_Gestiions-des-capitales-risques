<?php 
session_start();
include("php/config.php");



// Récupération des données du projet
if (isset($_GET['id_projet'])) {
    $id_projet = mysqli_real_escape_string($con, $_GET['id_projet']);
    $query = mysqli_query($con, "SELECT * FROM projet WHERE id_projet = $id_projet");

    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
        $res_id = $result['id_projet'];
        $res_nombre_actions_a_vendre = $result['nombre_actions_a_vendre'];
        $res_nombre_actions_vendues = $result['nombre_actions_vendues'];
    } else {
        echo "<script>alert('ID du projet non trouvé.');</script>";
        exit; // Assurez-vous de quitter le script après l'alerte
    }
} else {
    echo "<script>alert('ID du projet non fourni.');</script>";
    exit; // Assurez-vous de quitter le script après l'alerte
}

// Traitement de l'achat
if (isset($_GET['buying'])) {
    $nombre_actions_achetees = mysqli_real_escape_string($con, $_GET['buying']);

    // Vérification du nombre d'actions disponibles
    if ($nombre_actions_achetees <= $res_nombre_actions_a_vendre) {
        // Insertion dans la table capital_risque_projet
        $id_capital_risque = $_SESSION['id_capital_risque'];
        $insert_query = "INSERT INTO capital_risque_projet (id_projet, id_capital_risque, nombre_actions_achetees) VALUES ('$id_projet', '$id_capital_risque', '$nombre_actions_achetees')";
        if (mysqli_query($con, $insert_query)) {
            // Mise à jour du nombre d'actions disponibles dans la table projet
            $res_nombre_actions_a_vendre -= $nombre_actions_achetees;
            $update_query = "UPDATE projet SET nombre_actions_a_vendre = '$res_nombre_actions_a_vendre' WHERE id_projet = $id_projet";
            if (mysqli_query($con, $update_query)) {
                echo "<script>alert('L\'achat s\'est fait avec succès!');</script>";
                header("Location: liste_projets.php");
                exit; // Assurez-vous de quitter le script après la redirection
            } else {
                echo "<script>alert('Erreur lors de la mise à jour des données du projet.');</script>";
            }
        } else {
            echo "<script>alert('Erreur lors de l'insertion des données dans la table capital_risque_projet.');</script>";
        }
    } else {
        echo "<script>alert('Le nombre d'actions à acheter dépasse les actions disponibles.');</script>";
    }
} else {
    echo "<script>alert('Paramètre d'achat manquant.');</script>";
}

?>