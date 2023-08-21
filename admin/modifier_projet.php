<?php
include 'connexion_bd.php';

function afficherImage($imageData)
{
    if ($imageData !== null) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" width="100" height="100">';
    }
}

// Vérifier si l'ID_PROJET est spécifié dans l'URL
if (isset($_GET['id'])) {
    $id_projet = $_GET['id'];

    // Récupérer les informations du projet en fonction de l'ID_PROJET
    $sql = "SELECT * FROM projet WHERE ID_PROJET = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_projet);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Vérifier si le formulaire est soumis pour la mise à jour
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom_projet = $_POST["nom_projet"];
            $date_creation = $_POST["date_creation"];
            $description = $_POST["description"];

            // Gestion de l'image (si elle a été soumise)
            if ($_FILES['image']['size'] > 0) {
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
                $imageData = mysqli_real_escape_string($conn, $imageData);
                $sql_update = "UPDATE projet SET NOM_PROJET = ?, DATE_CREATION = ?, IMAGE = ?, DESCRIPTION = ? WHERE ID_PROJET = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ssssi", $nom_projet, $date_creation, $imageData, $description, $id_projet);
            } else {
                $sql_update = "UPDATE projet SET NOM_PROJET = ?, DATE_CREATION = ?, DESCRIPTION = ? WHERE ID_PROJET = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("sssi", $nom_projet, $date_creation, $description, $id_projet);
            }

            if ($stmt_update->execute()) {
                // Rediriger vers la page de la liste des projets après la mise à jour
                header("Location: index.php");
                exit;
            } else {
                echo "Erreur lors de la mise à jour du projet : " . $conn->error;
            }
        }
    } else {
        echo "Projet non trouvé dans la base de données.";
        exit;
    }
} else {
    echo "ID_PROJET non spécifié dans l'URL.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>ict-businesscenter</title>
</head>
<body>
    <header class="header-top">
        <div class="container">
            <div class="row">
              <div class="col-8">
                <div class="topbar-left"></div>
                <ul class="list-inline">
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                      </svg>  <span class="topbar-hightlight">madagascar face le marché madagascar, Yaoundé Cameroun</span> </li>
                    <li>  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                      </svg> <span class="topbar-hightlight"><a href="mailto:ictbc237@gmail.com">ictbc237@gmail.com</a></span> </li>
                </ul>
              </div>

              <div class="col-4">
                <div class="row">
                  <a href="admin/form.html">
                    <button type="button" class="btn btn-light">Connexion</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
    </header>
    <header class="header-bottom" style="padding: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="logo">
                        <a href="index.php">
                            <img src="https://www.ictbusinesscenter.com/images/logos/logo.png" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        </li>
                      </ul>
                </div>
              </div>
        </div>
    </header>
    <div class="section">
        <div class="container" style="padding: 3em;">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2>Modifier le projet</h2>
                    <form method="post">
                        <div class="form-group">
                            <label>Nom du projet:</label>
                            <input type="text" class="form-control" name="nom_projet" value="<?php echo $row['NOM_PROJET']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Date de création:</label>
                            <input type="date" class="form-control" name="date_creation" value="<?php echo $row['DATE_CREATION']; ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label>Image (actuelle):</label><br>
                            <?php afficherImage($row['IMAGE']); ?>
                        </div>
                        <div class="form-group">
                            <label>Nouvelle image:</label><br>
                            <input type="file" name="image">
                        </div> -->
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea class="form-control" name="description" rows="4" required><?php echo $row['DESCRIPTION']; ?></textarea>
                        </div> <br>
                        <input type="submit" value="Modifier" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
