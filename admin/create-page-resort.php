<?php
session_start();
error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit11']))
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

	$pname=$_POST['pagename'];
	$ptitle=$_POST['pagetitle'];	
	$paddress=$_POST['pageaddress'];
	$pzipcode=$_POST['pagezipcode'];	
	$pcity=$_POST['pagecity'];
	$pdescription=$_POST['pagedescription'];
	$pimage=$_FILES["pageimage"]["name"];
	move_uploaded_file($_FILES["pageimage"]["tmp_name"],"pagesimages/".$_FILES["pageimage"]["name"]);
	if($_SESSION['role'] == 'admin'){
		$nomHotel = $_POST['choixHotel'];

		$sql1 = "SELECT resortid from resorts where resortname = '".$nomHotel."'";
		$exec = $dbh->prepare($sql1);
		$exec->execute();
		$hid = $exec->fetch();
		$hotelid = $hid['resortid'];
		$sql="INSERT INTO pages_resort(pagename,pagetitle,pageaddress,pagezipcode,pagecity,pagedescription,pageimage,resortid) VALUES(:pname,:ptitle,:paddress,:pzipcode,:pcity,:pdescription,:pimage,:hotelid)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':pname',$pname,PDO::PARAM_STR);
		$query->bindParam(':ptitle',$ptitle,PDO::PARAM_STR);
		$query->bindParam(':paddress',$paddress,PDO::PARAM_STR);
		$query->bindParam(':pzipcode',$pzipcode,PDO::PARAM_STR);
		$query->bindParam(':pcity',$pcity,PDO::PARAM_STR);
		$query->bindParam(':pdescription',$pdescription,PDO::PARAM_STR);
		$query->bindParam(':pimage',$pimage,PDO::PARAM_STR);
		$query->bindParam(':hotelid',$hotelid,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
	}else{
		$sql="INSERT INTO pages_resort(pagename,pagetitle,pageaddress,pagezipcode,pagecity,pagedescription,pageimage,resortid) VALUES(:pname,:ptitle,:paddress,:pzipcode,:pcity,:pdescription,:pimage,:hotelid)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':pname',$pname,PDO::PARAM_STR);
		$query->bindParam(':ptitle',$ptitle,PDO::PARAM_STR);
		$query->bindParam(':paddress',$paddress,PDO::PARAM_STR);
		$query->bindParam(':pzipcode',$pzipcode,PDO::PARAM_STR);
		$query->bindParam(':pcity',$pcity,PDO::PARAM_STR);
		$query->bindParam(':pdescription',$pdescription,PDO::PARAM_STR);
		$query->bindParam(':pimage',$pimage,PDO::PARAM_STR);
		$query->bindParam(':hotelid',$hotelid,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
	}
	
if($lastInsertId)
{
$msg="Création de la page réussie !";
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
			<title>Hypnos | Créer une page hôtel</title>
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
						<h2>Créer une page hôtel</h2>
						<a href="dashboard.php" class="link">
							<i class="fa-solid fa-arrow-rotate-left"></i>
						</a>
					</div>

					<div class="card-body">

						<form name="suite" method="post" enctype="multipart/form-data">

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="name" class="col-form">Nom de la page :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="pagename" id="pagename" placeholder="Nom de la page" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="title" class="col-form">Titre :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="pagetitle" id="pagetitle" placeholder="Titre de la page" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="description" class="col-form">Description longue :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<textarea class="form-control input mb-3" style="height: 200px" name="pagedescription" id="pagedescription" placeholder="Description détaillée de l'hôtel" required></textarea> 
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="address" class="col-form">adress :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="pageaddress" id="pageaddress" placeholder="Adresse de l'hôtel" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="zipcode" class="col-form">code postal :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="pagezipcode" id="pagezipcode" placeholder="Code postal de l'hôtel" required>
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="city" class="col-form">Ville :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="pagecity" id="pagecity" placeholder="Ville de l'hôtel" required>
								</div>
							</div>		

							<div class="row g-3 justify-content-center">

								<div class="col-xl-7 col-lg-7">
									<label for="image" class="col-form">Image de l'hôtel :</label>
								</div>

								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="file" name="pageimage" class="form-control" id="pageimage" aria-describedby="inputFile" aria-label="Télécharger">
								</div>

								<div class="row g-3 justify-content-center"><!-- 4eme input -->
									<div class="col-xl-7 col-lg-7">
										<label for="city" class="col-form">Choisissez votre établissement :</label>
									</div>
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


										<?php
										if($_SESSION['role'] == 'manager')
										{
										?>
									<div class="row g-3 justify-content-center">
										<div class="col-xl-7 col-lg-7">
											<label for="resortid" class="col-form">Resort ID (à cacher) :</label>
										</div>
										<div class="col-xl-7 col-lg-7 justify-content-center">
											<input type="text" class="form-control input mb-3" name="resortid" id="resortid" placeholder="" value="$_SESSION['managerresort']->id"  required>
										</div>
									</div>
										<?php
										}
										?>
								</div>

								<div class="d-flex justify-content-end">
									<button class="btn btn-hypnos mt-3" type="submit" name="submit11">Enregistrer</button>
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