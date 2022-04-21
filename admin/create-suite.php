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
	$email = $_SESSION['email'];
	$requete = "SELECT id from managers where email = '".$email."'";
	$exec = $dbh->prepare($requete);
	$exec->execute();

	$idManager = $exec->fetch();

	$req = "SELECT resortid from resorts where managerid = '".$idManager['id']."'";
	$exec = $dbh->prepare($req);
	$exec->execute();
	$rid = $exec->fetch();
	$hotelid = $rid['resortid'];

	$sname=$_POST['suitename'];
	$stitle=$_POST['suitetitle'];	
	$slocation=$_POST['suitelocation'];
	$sprice=$_POST['suiteprice'];	
	$sservices=$_POST['suiteservices'];
	$sdescription=$_POST['suitedescription'];	
	$simage=$_FILES["suiteimage"]["name"];
	move_uploaded_file($_FILES["suiteimage"]["tmp_name"],"suitesimages/".$_FILES["suiteimage"]["name"]);

	if($_SESSION['role'] == 'admin'){
		$nomHotel = $_POST['choixHotel'];

		$sql1 = "SELECT resortid from resorts where resortname = '".$nomHotel."'";
		$exec = $dbh->prepare($sql1);
		$exec->execute();
		$hid = $exec->fetch();
		$hotelid = $hid['resortid'];
		$sql="INSERT INTO suites(suitename,suitetitle,resortid,suiteprice,suiteservices,suitedescription,suiteimage) VALUES(:sname,:stitle,:hotelid,:sprice,:sservices,:sdescription,:simage)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':sname',$sname,PDO::PARAM_STR);
		$query->bindParam(':stitle',$stitle,PDO::PARAM_STR);
		// $query->bindParam(':slocation',$slocation,PDO::PARAM_STR);
		$query->bindParam(':hotelid',$hotelid,PDO::PARAM_STR);
		$query->bindParam(':sprice',$sprice,PDO::PARAM_STR);
		$query->bindParam(':sservices',$sservices,PDO::PARAM_STR);
		$query->bindParam(':sdescription',$sdescription,PDO::PARAM_STR);
		$query->bindParam(':simage',$simage,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
	}else{
		$sql="INSERT INTO suites(suitename,suitetitle,resortid,suiteprice,suiteservices,suitedescription,suiteimage) VALUES(:sname,:stitle,:hotelid,:sprice,:sservices,:sdescription,:simage)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':sname',$sname,PDO::PARAM_STR);
		$query->bindParam(':stitle',$stitle,PDO::PARAM_STR);
		// $query->bindParam(':slocation',$slocation,PDO::PARAM_STR);
		$query->bindParam(':hotelid',$hotelid,PDO::PARAM_STR);
		$query->bindParam(':sprice',$sprice,PDO::PARAM_STR);
		$query->bindParam(':sservices',$sservices,PDO::PARAM_STR);
		$query->bindParam(':sdescription',$sdescription,PDO::PARAM_STR);
		$query->bindParam(':simage',$simage,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
	}

	if($lastInsertId)
	{
		$msg="Création de la suite réussie !";
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
			<title>Hypnos | Créer une suite</title>
			<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
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
			<div class="container pt-5">

				<div class="card shadow-lg">

					<div class="card-header d-flex justify-content-between align-items-center">
						<h2>Créer une suite</h2>
						<a href="dashboard.php" class="link">
							<i class="fa-solid fa-arrow-rotate-left"></i>
						</a>
					</div>

					<div class="card-body">

						<form name="suite" method="post" enctype="multipart/form-data">

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="name" class="col-form">Nom de la suite :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="suitename" id="suitename" placeholder="Nom de la suite" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="title" class="col-form">Titre :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="suitetitle" id="suitetitle" placeholder="Type de suite Ex : Comptemporaine, Hight-tech etc..." required>
								</div>
							</div>

							<!-- <div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="location" class="col-form">Hôtel hypnos :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="suitelocation" id="suitelocation" placeholder="Suite remantique avec vue sur le jardin à la Française" required>
								</div>
							</div> -->

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="price" class="col-form">Prix de la nuitée :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="suiteprice" id="suiteprice" placeholder="Prix en €uros" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="services" class="col-form">Services inclus :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="suiteservices" id="suiteservices" placeholder="Liste des services Ex : Wi-Fi gratuit - SPA privatif etc..." required>
								</div>
							</div>		

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="description" class="col-form">Description longue :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<textarea class="form-control input mb-3" style="height: 200px" name="suitedescription" id="suitedescription" placeholder="Description détaillée de la suite et du Room service" required></textarea> 
								</div>
							</div>
																							
							<div class="row g-3 justify-content-center">

								<div class="col-xl-7 col-lg-7">
									<label for="image" class="col-form">Image mise en avant :</label>
								</div>

								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="file" name="suiteimage" class="form-control" id="suiteimage" aria-describedby="inputFile" aria-label="Télécharger">
								</div>

								<div class="row g-3 justify-content-center"><!-- 4eme input -->
									<!-- <div class="col-xl-7 col-lg-7">
										<label for="city" class="col-form">Affecter cette suite à un établissement :</label>
									</div> -->
									<div class="col-xl-7 col-lg-7 justify-content-center">

										<?php
										if($_SESSION['role'] == 'admin')
										{
											echo '<div class="row g-3 justify-content-center">';
											
											$sql = "SELECT * from resorts";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$resortsResults = $query->fetchAll(PDO::FETCH_OBJ);
											
											if($query->rowCount() == 0)
												echo 'Pas de resorts dans la base';
											else
											{
												echo '<select class="form-select form-control input" name="choixHotel" onChange="MM_jumpMenu(\'parent\',this,0)">';
												foreach($resortsResults as $resort)
												{
													?>
													<!-- // echo("oui");
													// $selected = '';
													// if( $result->resortid == $resort->id ){
													// 	$selected = ' selected="selected"';
													// }
													// echo '<option  value="'.$resort->id.'" '.$selected.'>'.$resort->name.'</option>'; -->
													<option value="<?php echo $resort->resortname; ?>"><?php echo $resort->resortname; ?></option> 
													<?php
													
												}
												echo '</select>';
											}

											echo '</div>';
										
										}
										?>
								</div>

								<div class="d-flex justify-content-end">
									<button class="btn btn-hypnos mt-3" type="submit" name="submit">Enregistrer</button>
								</div>

							</div>

						</div>
					</form>
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