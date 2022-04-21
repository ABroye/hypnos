<?php
session_start();
error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$mfirstname=$_POST['managerfirstname'];
$mname=$_POST['managername'];	
$maddress=$_POST['manageraddress'];
$mzipcode=$_POST['managerzipcode'];	
$mcity=$_POST['managercity'];
$memail=$_POST['manageremail'];	
$mpassword=md5($_POST["managerpassword"]);
$sql="INSERT INTO managers(firstname,lastname,address,zipcode,city,email,password) VALUES(:mfirstname,:mname,:maddress,:mzipcode,:mcity,:memail,:mpassword)";
$query = $dbh->prepare($sql);
$query->bindParam(':mfirstname',$mfirstname,PDO::PARAM_STR);
$query->bindParam(':mname',$mname,PDO::PARAM_STR);
$query->bindParam(':maddress',$maddress,PDO::PARAM_STR);
$query->bindParam(':mzipcode',$mzipcode,PDO::PARAM_STR);
$query->bindParam(':mcity',$mcity,PDO::PARAM_STR);
$query->bindParam(':memail',$memail,PDO::PARAM_STR);
$query->bindParam(':mpassword',$mpassword,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Création du directeur réussie !";
}
else 
{
$error="Quelque chose s'est mal passé. Veuillez réessayer";
}
}
?>
<!DOCTYPE HTML>
	<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Créer un directeur</title>
			<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/mobile.css">
		</head>
	<body>
		<?php include('includes/header.php');?>
		<main class="main wrapper-admin mb-5">
			<?php if($error){?>
			<div class="container-fluid shadow border-bottom alert alert-danger">
				<strong>ERREUR : </strong><?php echo htmlentities($error); ?>
			</div>
				<?php } 
							else if($msg){?>
			<div class="container-fluid shadow border-bottom alert alert-success">
				<?php echo htmlentities($msg); ?>
			</div>
				<?php }?>
			<div class="container pt-5">

				<div class="card shadow-lg">

					<div class="card-header d-flex justify-content-between align-items-center">
						<h2>Ajouter un directeur</h2>
						<a href="dashboard.php" class="link">
							<i class="fa-solid fa-arrow-rotate-left"></i>
						</a>
					</div>

					<div class="card-body">
						<div class="row g-3 justify-content-center">
							<div class="col-xl-7 col-lg-7">
								<p class="text-muted">* Champs obligatoires</p>
							</div>
						</div>

						<form name="manager" method="post" enctype="multipart/form-data">

						<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="firstname" class="col-form">Prénom * :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="managerfirstname" id="managerfirstname" placeholder="Prénom du directeur" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="name" class="col-form">Nom * :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="managername" id="managername" placeholder="Nom du directeur" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="address" class="col-form">Adresse postale :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="manageraddress" id="manageraddress" placeholder="Adresse postale">
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="zipcode" class="col-form">Code postal :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="managerzipcode" id="managerzicode" placeholder="Code postal">
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="city" class="col-form">Ville :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="managercity" id="managercity" placeholder="Ville">
								</div>
							</div>		

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="email" class="col-form">Courriel * :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
                  <input type="email" class="form-control input mb-3" name="manageremail" id="manageremail" placeholder="Courriel professionnel" required>
								</div>
							</div>
																							
							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="password" class="col-form-">Mot de passe * :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="password" class="form-control mb-3" name="managerpassword" id="managerpassword" placeholder="Mot de passe" required>
								</div>
								<div class="d-flex justify-content-end">
									<button class="btn btn-hypnos mt-3" type="submit" name="submit">Enregistrer</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</main>
		<div class="">
			<?php include('includes/footer.php');?>
		</div>
	</body>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</html>
<?php } ?>
