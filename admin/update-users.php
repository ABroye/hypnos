<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname = $name = $address = $zipcode = $city = $salary = "";
$firstname_err = $name_err = $address_err = $zipcode_err = $city_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_firstname = trim($_POST["firstname"]);
    if(empty($input_firstname)){
        $firstname_err = "Veuillez entrer un prénom";
    } elseif(!filter_var($input_firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $firstname_err = "Veuillez entrer un prénom valide.";
    } else{
        $firstname = $input_firstname;
    }

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrer un nom";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrer un valide.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Veuillez entrer une adresse postale.";     
    } else{
        $address = $input_address;
    }

    $input_zipcode = trim($_POST["zipcode"]);
    if(empty($input_zipcode)){
        $zipcode_err = "Veuillez entrer un code postal.";
    } elseif(!filter_var($input_zipcode, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9\s]+$/")))){
        $zipcode_err = "Veuillez entrer un code postal valide. EX : 04100";
    } else{
        $zipcode = $input_zipcode;
    }

    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = "Veuillez entrer une ville.";
    } elseif(!filter_var($input_city, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $city_err = "Veuillez entrer une ville valide.";
    } else{
        $city = $input_city;
    }

    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($name_err) && empty($address_err) && empty($zipcode_err) && empty($city_err) && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE managers SET firstname=:firstname, name=:name, address=:address, zipcode=:zipcode, city=:city, salary=:salary WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":firstname", $param_firstname);
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":zipcode", $param_zipcode);
            $stmt->bindParam(":city", $param_city);
            $stmt->bindParam(":salary", $param_salary);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_name = $name;
            $param_address = $address;
            $param_zipcode = $zipcode;
            $param_city = $city;
            $param_salary = $salary;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Mince! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM managers WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $firstname = $row["firstname"];
                    $name = $row["name"];
                    $address = $row["address"];
                    $zipcode = $row["zipcode"];
                    $city = $row["city"];
                    $salary = $row["salary"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour une fiche employé</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mettre à jour une fiche employé</h2>
                    <p>Veuillez modifier le formulaire pour mettre à jour le dossier de l'employé.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                            <label>Prénom :</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Nom :</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Adresse postale :</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Code postal :</label>
                            <input type="text" name="zipcode" class="form-control <?php echo (!empty($zipcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zipcode; ?>">
                            <span class="invalid-feedback"><?php echo $zipcode_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Ville :</label>
                            <input type="text" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                            <span class="invalid-feedback"><?php echo $city_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-success" value="Mettre à jour">
                        <a href="index.php" class="btn btn-danger ml-2">annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>