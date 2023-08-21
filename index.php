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
                  <a href="admin/form.php">
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
                            <img src="image/logo.png" alt="" srcset="">
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
    <div class="container text-center" style="padding: 3em;">
    <center>
      <div class="modal" id="imageModal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modalImage" src="" alt="Image en taille réelle">
      </div>
      </div>
    <div class="row align-items-center" >
        <?php
        // Inclure le fichier de connexion à la base de données
        include 'admin/connexion_bd.php';

        // Récupérer tous les projets de la base de données
        $query = "SELECT * FROM projet";
        $result = mysqli_query($conn, $query);

        // Parcourir les résultats et afficher chaque projet
        while ($row = mysqli_fetch_assoc($result)) {
            $nomProjet = $row['NOM_PROJET'];
            $description = $row['DESCRIPTION'];
            $dateCreation = $row['DATE_CREATION'];
            $datePublication = $row['DATE_PUBLICATION'];

            // Lire les données binaires de l'image et les afficher
            $imageData = $row['IMAGE'];
            $base64Image = base64_encode($imageData);

            echo '
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img style="cursor: pointer;"src="data:;base64,'.$base64Image.'" alt="..." onclick="openModal(\'data:;base64,'.$base64Image.'\')">
                    <div class="card-body">
                        <h5 class="card-title">'.$nomProjet.'</h5>
                        <p class="card-text">'.$description.'</p>
                    </div>
                    <p>créer le '.$dateCreation.'</p>
                </div>
                <i>poster le '.$datePublication.'</i>
            </div>
        ';
        }

        // Fermer la connexion à la base de données
        mysqli_close($conn);
        ?>
    </div>
</center>
<script>
  function openModal(imageSrc) {
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");

    modal.style.display = "block";
    modalImage.src = imageSrc;
  }

  function closeModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
  }
</script>
</body>
</html>

