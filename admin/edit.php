<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bd.php';

// Check if the ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
 $idClient = $_GET['id'];

 // Fetch the client data based on the provided ID
 $query = "SELECT * FROM client WHERE ID_CLIENT = $idClient";
 $result = mysqli_query($conn, $query);

 if (!$result || mysqli_num_rows($result) == 0) {
 die("Client not found.");
 }

 $row = mysqli_fetch_assoc($result);
 $nomClient = $row['NOM_CLIENT'];
 $numeroTel = $row['NUMERO_TEL'];

 // Handle form submission when the user updates the client information
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Get the updated data from the form submission
 $newNomClient = $_POST['nomClient'];
 $newNumeroTel = $_POST['numeroTel'];

 // Update the client information in the database
 $updateQuery = "UPDATE client SET NOM_CLIENT = '$newNomClient', NUMERO_TEL = '$newNumeroTel' WHERE ID_CLIENT = $idClient";
 $updateResult = mysqli_query($conn, $updateQuery);

 if ($updateResult) {
 // Redirect to the client list page after successful update
 header("Location: client.php");
 exit();
 } else {
 die("Failed to update client information: " . mysqli_error($connection));
 }
 }
} else {
 die("Invalid client ID.");
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
                    <form method="post" action="">
                        <label for="nomClient">Nom du client:</label>
                        <input type="text" id="nomClient" name="nomClient" value="<?php echo $nomClient; ?>"><br><br>

                        <label for="numeroTel">Numéro de téléphone:</label>
                        <input type="text" id="numeroTel" name="numeroTel" value="<?php echo $numeroTel; ?>"><br><br>

                        <input type="submit" value="Modifier">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
