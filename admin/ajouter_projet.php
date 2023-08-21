<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bd.php';

$client = $_POST['client'];
$type = $_POST['type'];
$categories = $_POST['categories'];
$name = $_POST['name'];
$date_creation = $_POST['date_creation'];
$image = file_get_contents($_FILES['image']['tmp_name']); // Lire les données binaires du fichier
$description = $_POST['description'];

$client_id_query = "SELECT ID_CLIENT FROM client WHERE nom_client = '$client'";
$type_id_query = "SELECT ID_TYPE FROM type WHERE nom_type = '$type'";
$categories_id_query = "SELECT ID_CATEGORIES FROM categories WHERE nom_categories = '$categories'";

$client_id_result = mysqli_query($conn, $client_id_query);
$type_id_result = mysqli_query($conn, $type_id_query);
$categories_id_result = mysqli_query($conn, $categories_id_query);

if (!$client_id_result || !$type_id_result || !$categories_id_result) { // Utiliser || au lieu de !
    die("Error: " . mysqli_error($conn));
}

$client_id = mysqli_fetch_assoc($client_id_result)['ID_CLIENT'];
$type_id = mysqli_fetch_assoc($type_id_result)['ID_TYPE'];
$categories_id = mysqli_fetch_assoc($categories_id_result)['ID_CATEGORIES'];

$insert_query = "INSERT INTO projet (ID_CLIENT, ID_TYPE, ID_CATEGORIES, NOM_PROJET, DATE_CREATION, DATE_PUBLICATION, IMAGE, DESCRIPTION)
                VALUES ('$client_id', '$type_id', '$categories_id', '$name', '$date_creation', NOW(), ?, '$description')";

$stmt = mysqli_prepare($conn, $insert_query);
mysqli_stmt_bind_param($stmt, 's', $image);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>