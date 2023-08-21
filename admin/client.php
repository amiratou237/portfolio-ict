<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bd.php';

// Établir une requête SQL pour récupérer les informations des clients
$sql = "SELECT * FROM client";

// Exécuter la requête SQL
$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
            </div>
          </div>
    </header>
    <header class="header-bottom" style="padding: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="logo">
                        <a href="/plateforme publication/index.php">
                            <img src="https://www.ictbusinesscenter.com/images/logos/logo.png" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.php">Projets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="client.php">Clients</a>
                          </li>
                      </ul>
                </div>
              </div>
        </div>
    </header>
    <div class="container" style="padding: 3em;">
        <h1>Tableau des clients</h1>
        <table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Parcourir les résultats de la requête et afficher les clients
        while ($row = mysqli_fetch_assoc($result)) {
            $idClient = $row['ID_CLIENT'];
            $nomClient = $row['NOM_CLIENT'];
            $numeroTel = $row['NUMERO_TEL'];
        ?>
            <tr>
                <td><?php echo $nomClient; ?></td>
                <td><?php echo $numeroTel; ?></td>
                <td>
                    <!-- Utiliser les liens avec les identifiants de chaque client -->
                    <a href="edit.php?id=<?php echo $idClient; ?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg>
                            <!-- Icône de modification -->
                        </svg> </a>
                    <a href="delete.php?id=<?php echo $idClient; ?>" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg>
                            <!-- Icône de suppression -->
                        </svg></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
        <a href="add.php" class="btn btn-primary" style="float: left;">Ajouter un nouveau client</a>
    </div>

</body>
</html>

