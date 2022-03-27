<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper-admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="mt-5 mb-3 clearfix">
                        <h2>Détails des gérant(e)s</h2>
                        <a href="create.php" class="btn btn-success float-end"><i class="fa fa-plus"></i> Ajouter un gérant(e)</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM managers";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Prénom</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Adresse postale</th>";
                                        echo "<th>Code postal</th>";
                                        echo "<th>Ville</th>";
                                        echo "<th>Salaire</th>";
                                        echo "<th>Gestion</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['firstname'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['zipcode'] . "</td>";
                                        echo "<td>" . $row['city'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read-user.php?id='. $row['id'] .'" class="me-3" title="Voir la fiche" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update-users.php?id='. $row['id'] .'" class="me-3" title="Mettre à jour la fiche" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" title="Supprimé la fiche" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Aucun enregistrement n\'a été trouvé.</em></div>';
                        }
                    } else{
                        echo "Mince ! Quelque chose s\'est mal passé. Veuillez réessayer plus tard.";
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                    <a href="logout.php" class="btn btn-danger ms-3 float-end">Déconnexion</a>
                </div>
            </div>        
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</body>
</html>