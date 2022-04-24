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
$rname=$_POST['resortname'];
$raddress=$_POST['resortaddress'];	
$rzipcode=$_POST['resortzipcode'];
$rcity=$_POST['resortcity'];	
$rdescription=$_POST['resortdescription'];
$rimage=$_FILES["resortimage"]["name"];
move_uploaded_file($_FILES["resortimage"]["tmp_name"],"resortsimages/".$_FILES["resortimage"]["name"]);
$sql="INSERT INTO resorts(resortname,resortaddress,resortzipcode,resortcity,resortdescription,resortimage) VALUES(:rname,:raddress,:rzipcode,:rcity,:rdescription,:rimage)";
$query = $dbh->prepare($sql);
$query->bindParam(':rname',$rname,PDO::PARAM_STR);
$query->bindParam(':raddress',$raddress,PDO::PARAM_STR);
$query->bindParam(':rzipcode',$rzipcode,PDO::PARAM_STR);
$query->bindParam(':rcity',$rcity,PDO::PARAM_STR);
$query->bindParam(':rdescription',$rdescription,PDO::PARAM_STR);
$query->bindParam(':rimage',$rimage,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Création de l'hôtel réussie !";
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
			<title>Hypnos | Créer un hôtel</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/mobile.css">
		</head>
	<body>
		<?php include('includes/header.php');?>
		<main class="main mb-5">
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
			<div class="container pt-5"><!-- Début du container -->

				<div class="card shadow-lg"><!-- Début de la carte -->

					<div class="card-header d-flex justify-content-between align-items-center">
						<h2>Créer un hôtel</h2>
						<a href="dashboard.php" class="link">
							<i class="fa-solid fa-arrow-rotate-left"></i>
						</a>
					</div>

					<div class="card-body"><!-- Début du corp de la carte -->

						<form name="resort" method="post" enctype="multipart/form-data"><!-- Début du formulaire -->

							<div class="row g-3 justify-content-center"><!-- 1er input -->
								<div class="col-xl-7 col-lg-7">
									<label for="name" class="col-form">Nom de l'hôtel :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="resortname" id="resortname" placeholder="Nom de l'hôtel" required>
								</div>
							</div><!-- fin 1er input -->

							<div class="row g-3 justify-content-center"><!-- 2ème input -->
								<div class="col-xl-7 col-lg-7">
									<label for="address" class="col-form">Adresse postale :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="resortaddress" id="resortaddress"placeholder="Adresse postale de l'hôtel" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center"><!-- 3eme input -->
								<div class="col-xl-7 col-lg-7">
									<label for="zipcode" class="col-form">Code postal :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="resortzipcode" id="resortzipcode"placeholder="Code postal" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center"><!-- 4eme input -->
								<div class="col-xl-7 col-lg-7">
									<label for="city" class="col-form">Ville :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="resortcity" id="resortcity"placeholder="Ville de l'hôtel" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center"><!-- 5eme input -->
								<div class="col-xl-7 col-lg-7">
									<label for="description" class="col-form">Services inclus :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<textarea type="text" class="form-control input mb-3" style="height: 200px" name="resortdescription"id="resortdescription" placeholder="Description longue" required></textarea>
								</div>
							</div>		
																							
							<div class="row g-3 justify-content-center"><!-- Label image -->
								<div class="col-xl-7 col-lg-7">
									<label for="image" class="col-form">Image mise en avant :</label>
								</div>

								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="file" name="resortimage" class="form-control" id="resortimage" aria-describedby="inputFile" aria-label="Télécharger">
								</div>

								<div class="d-flex justify-content-end">
									<button class="btn btn-hypnos mt-3" type="submit" name="submit">Enregistrer</button>
								</div>
							</div>

						</form>

					</div><!-- Fin du corp de la carte -->

				</div><!-- Fin de la carte -->

			</div><!-- Fin du container -->
		</main>
		<div class="footer">
			<?php include('includes/footer.php');?>
		</div>
	</body>
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</html>
<?php } ?>