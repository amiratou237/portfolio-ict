<?php
session_start();

if(!isset($_SESSION['pseudo'])) {
    header("Location: form.php");
    exit();
}
?>
<?php
include 'connexion_bd.php';

function afficherImage($imageData)
{
    if ($imageData !== null) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" width="100" height="100">';
    }
}

$sql = "SELECT projet.*, client.NOM_CLIENT, type.NOM_TYPE, categories.NOM_CATEGORIES FROM projet
        LEFT JOIN client ON projet.ID_CLIENT = client.ID_CLIENT
        LEFT JOIN type ON projet.ID_TYPE = type.ID_TYPE
        LEFT JOIN categories ON projet.ID_CATEGORIES = categories.ID_CATEGORIES";
$result = $conn->query($sql);
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
      <h1>Liste des projets</h1>
      <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID_PROJET</th>
                    <th>NOM_CLIENT</th>
                    <th>NOM_TYPE</th>
                    <th>NOM_CATEGORIE</th>
                    <th>NOM_PROJET</th>
                    <th>DATE_CREATION</th>
                    <th>DATE_PUBLICATION</th>
                    <th>IMAGE</th>
                    <th>DESCRIPTION</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID_PROJET'] . "</td>";
                        echo "<td>" . $row['NOM_CLIENT'] . "</td>";
                        echo "<td>" . $row['NOM_TYPE'] . "</td>";
                        echo "<td>" . $row['NOM_CATEGORIES'] . "</td>";
                        echo "<td>" . $row['NOM_PROJET'] . "</td>";
                        echo "<td>" . $row['DATE_CREATION'] . "</td>";
                        echo "<td>" . $row['DATE_PUBLICATION'] . "</td>";
                        echo "<td>";
                        afficherImage($row['IMAGE']);
                        echo "</td>";
                        echo "<td>" . $row['DESCRIPTION'] . "</td>";
                        echo "<td>
                            <a href='modifier_projet.php?id=" . $row['ID_PROJET'] . "' class='btn btn-primary'>Modifier</a>
                            <a href='supprimer_projet.php?id=" . $row['ID_PROJET'] . "' class='btn btn-danger'>Supprimer</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Aucun projet trouvé dans la base de données.</td></tr>";
                }
                ?>
            </tbody>
        </table>



      <a href="add-projet.php" class="btn btn-primary">Ajouter un nouveau projet</a>
    </div>
</body>
</html>


