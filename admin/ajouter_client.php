<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bd.php';

$nom_client = $_POST['nom_client'];
$nom_projet = $_POST['nom_projet'];
$numero_tel = $_POST['numero_tel'];

$requete = "INSERT INTO client (NOM_CLIENT, NOM_PROJET, NUMERO_TEL) VALUES ('$nom_client', '$nom_projet', '$numero_tel')";

if ($conn->query($requete) === TRUE) {
    header("Location: client.php");
    echo "Le client a été ajouté avec succès.";
} else {
    echo "Erreur : " . $requete . "<br>" . $conn->error;
}

$conn->close();
?>