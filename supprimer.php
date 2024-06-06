<?php
session_start();
include("php/config.php");
// Vérifier si l'ID du projet est passé en paramètre
if (isset($_GET['id_projet'])) {
// Échapper l'ID du projet pour éviter les injections SQL
$id_projet = mysqli_real_escape_string($con, $_GET['id_projet']);
        
    // Requête pour récupérer le nombre d'actions vendues du projet
    $query = mysqli_query($con, "SELECT nombre_actions_vendues 
    FROM projet WHERE id_projet = $id_projet");
    
    if ($query) {
        $result = mysqli_fetch_assoc($query);
        $nombre_actions_vendues = $result['nombre_actions_vendues'];
        
        // Vérifier si le nombre d'actions vendues est égal à zéro
        if ($nombre_actions_vendues == 0) {
            // Supprimer le projet
            $delete_query = mysqli_query($con, "DELETE FROM projet
             WHERE id_projet = $id_projet");
            
            if ($delete_query) {
                echo "<script>alert('Le projet a été supprimé avec succès.');</script>";
            } else {
                echo "<script>alert('Une erreur s'est produite lors de la suppression du projet.');</script>";
            }
        } else {
            echo "<script>alert('Vous ne pouvez pas supprimer ce projet car des actions ont déjà été vendues.');</script>";
        }
    } else {
        echo "<script>alert('Une erreur s'est produite lors de la récupération du nombre d'actions vendues.');</script>";
    }
} else {
    echo "<script>alert('ID du projet non fourni.');</script>";
}

// Redirection vers la page des projets après la suppression
echo "<script>window.location.href = 'projects1.php';</script>";
?>