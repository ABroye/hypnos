<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM managers WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $name = $row["firstname"];
                $name = $row["name"];
                $address = $row["address"];
                $name = $row["zipcode"];
                $name = $row["city"];
                $salary = $row["salary"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Mince ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir une fiche employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Voir une fiche gérant(e)</h1>

                    <div class="form-group">
                        <label>Prénom :</label>
                        <p><b><?php echo $row["firstname"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Nom :</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Adresse postale :</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Code postal :</label>
                        <p><b><?php echo $row["zipcode"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Ville :</label>
                        <p><b><?php echo $row["city"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Salaire</label>
                        <p><b><?php echo $row["salary"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>