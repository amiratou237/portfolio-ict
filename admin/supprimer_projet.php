<?php
include 'connexion_bd.php';
if (isset($_GET['id'])) {
    $projetId = $_GET['id'];
    $sql = "DELETE FROM projet WHERE ID_PROJET = $projetId";

    if ($conn->query($sql) === TRUE) {
        // Projet supprimé avec succès, tu peux rediriger vers la liste des projets.
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur lors de la suppression du projet: " . $conn->error;
    }
} else {
    echo "ID du projet non spécifié.";
}
?>