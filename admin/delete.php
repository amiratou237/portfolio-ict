<?php
include 'connexion_bd.php';

if (isset($_GET['id'])) {
    $idClient = $_GET['id'];
    $sql = "DELETE FROM client WHERE ID_CLIENT = $idClient";

    if ($conn->query($sql) === TRUE) {
        // client supprimé avec succès, tu peux rediriger vers la liste des clients.
        header("Location: client.php");
        exit;
    } else {
        echo "Erreur lors de la suppression du projet: " . $conn->error;
    }
} else {
    echo "ID du projet non spécifié.";
}
?>