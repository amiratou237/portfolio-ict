<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bd.php';
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
                    <center><h1>Ajouter un nouveau Projet</h1></center>
                    <form action="ajouter_projet.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="client">Client</label>
                            <select class="form-control" id="client" name="client">
                                <?php
                                $sql = "SELECT nom_client FROM client";
                                $results = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<option value='" . $row['nom_client'] . "'>" . $row['nom_client'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <a href="add.php">nouveau client ?</a>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type">
                                <?php
                                $sql = "SELECT nom_type FROM type";
                                $results = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<option value='" . $row['nom_type'] . "'>" . $row['nom_type'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select class="form-control" id="category" name="categories">
                                <?php
                                $sql = "SELECT nom_categories FROM categories";
                                $results = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<option value='" . $row['nom_categories'] . "'>" . $row['nom_categories'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Nom du projet</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="date">date création</label>
                            <input type="date" class="form-control" id="date" name="date_creation">
                        </div>
                        <input type="hidden" name="date_publication" value="<?php echo date('Y-m-d H:i:s'); ?>"> <br>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div> <br>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <input class="btn btn-outline-danger" type="reset" value="supprimer">
                    </form>
                </div>
              </div>
        </div>
    </div>
</body>
</html>
