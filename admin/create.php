<?php
// Inclure le fichier de configuration 
require_once "config.php";
 
// Définir des variables et initialiser avec des valeurs vides
$firstname = $name = $address = $zipcode = $city = $salary = "";
$firstname_err = $name_err = $address_err = $zipcode = $city = $salary_err = "";
 
// Traitement des données du formulaire lors de la soumission
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Vérifie le prénom
    $input_firstname = trim($_POST["firstname"]);
    if(empty($input_firstname)){
        $firstname_err = "Veuillez entrer un prénom.";
    } elseif(!filter_var($input_firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $firstname_err = "Veuillez entrer un prénom valide";
    } else{
        $firstname = $input_firstname;
    }

    // Vérifie le nom
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrer un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrer un nom valide.";
    } else{
        $name = $input_name;
    }
    
    // Vérifie l'adresse
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Veuillez entrer une adresse.";     
    } else{
        $address = $input_address;
    }

    // Vérifie le code postal
    $input_zipcode = trim($_POST["zipcode"]);
    if(empty($input_zipcode)){
        $zipcode_err = "Veuillez entrer un code postal.";     
    } else{
        $zipcode = $input_zipcode;
    }

    // Vérifie la ville
    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = "Veuillez entrer une ville.";     
    } else{
        $city = $input_city;
    }
    
    // Vérifie le montant du salaire
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Veuillez entrer le salaire de l'employé.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Veuillez entrer un montant entière positif. EX : 5000";
    } else{
        $salary = $input_salary;
    }
    
    // Vérifie les erreurs de saisie avant les insérer dans la base de données
    if(empty($firstname_err) && empty($name_err) && empty($address_err) && empty($zipcode_err) && empty($city_err) && empty($salary_err)){
        // Prépare une déclaration d'insertion
        $sql = "INSERT INTO managers (firstname, name, address, zipcode, city, salary) VALUES (:firstname, :name, :address, :zipcode, :city, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            // Lie les variables à l'instruction préparée en tant que paramètres
            $stmt->bindParam(":firstname", $param_firstname);
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":zipcode", $param_zipcode);
            $stmt->bindParam(":city", $param_city);
            $stmt->bindParam(":salary", $param_salary);
            
            // Définie les paramètres
            $param_firstname = $firstname;
            $param_name = $name;
            $param_address = $address;
            $param_zipcode = $zipcode;
            $param_city = $city;
            $param_salary = $salary;
            
            // Tentative d'exécution de l'instruction préparée
            if($stmt->execute()){
                // Enregistrements créés avec succès. Redirection vers la page de destination.
                header("location: admin.php");
                exit();
            } else{
                echo "Mince ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }
        }
         
        // Ferme la déclaration
        unset($stmt);
    }
    
    // Ferme la connexion
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Ajouter un employé</h2>
                    <p>Veuillez remplir ce formulaire et le soumettre pour ajouter un enregistrement d'employé à la base de données.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group mb-3">
                            <label>Prénom :</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err;?></span>
                        </div>

                        <div class="form-group mb-3">
                            <label>Nom :</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group mb-3">
                            <label>Adresse postale :</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>

                        <div class="form-group mb-3">
                            <label>Code postal :</label>
                            <input type="text" name="zipcode" class="form-control <?php echo (!empty($zipcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zipcode; ?>">
                            <span class="invalid-feedback"><?php echo $zipcode_err;?></span>
                        </div>

                        <div class="form-group mb-3">
                            <label>Ville :</label>
                            <input type="text" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                            <span class="invalid-feedback"><?php echo $city_err;?></span>
                        </div>

                        <div class="form-group mb-3">
                            <label>Salaire :</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-success" value="Enregistrer">
                        <a href="index.php" class="btn btn-danger ms-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>