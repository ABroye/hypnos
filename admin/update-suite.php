<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$sid=intval($_GET['sid']);	
if(isset($_POST['submit']))
{
	// $nomHotel = $_POST['choixHotel'];
	$sname=$_POST['suitename'];
	$stitle=$_POST['suitetitle'];	
	$slocation=$_POST['choixHotel'];
	$sprice=$_POST['suiteprice'];	
	$sservices=$_POST['suiteservices'];
	$sdescription=$_POST['suitedescription'];	
	$simage=$_FILES["suiteimage"]["name"];
	$sql="UPDATE suites set suitename=:sname,suitetitle=:stitle,suitelocation=:slocation,suiteprice=:sprice,suiteservices=:sservices,suitedescription=:sdescription where suiteid=:sid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':sname',$sname,PDO::PARAM_STR);
	$query->bindParam(':stitle',$stitle,PDO::PARAM_STR);
	$query->bindParam(':slocation',$slocation,PDO::PARAM_STR);
	$query->bindParam(':sprice',$sprice,PDO::PARAM_STR);
	$query->bindParam(':sservices',$sservices,PDO::PARAM_STR);
	$query->bindParam(':sdescription',$sdescription,PDO::PARAM_STR);
	$query->bindParam(':sid',$sid,PDO::PARAM_STR);
	$query->execute();
	$msg="Détails de la suite mis à jour !";
}
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Mise à jour d'une suite</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/mobile.css">
		</head>
	<body>
		<main class="main mb-5">
				<div class="container-fluid px-0 shadow-lg">
					<?php include('includes/header.php');?>
				</div>
					<?php if($error){?>
				<div class="container-fluid shadow border-bottom alert alert-danger">
					<strong>ERREUR : </strong><?php echo htmlentities($error); ?>
				</div>
					<?php } 
								else if($msg){?>
				<div class="container-fluid shadow border-bottom alert alert-success"><?php echo htmlentities($msg); ?></div>
					<?php }?>
				<div class="container pt-5">
					<div class="card shadow-lg">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2>Mettre à jour la suite</h2>
								<a href="dashboard.php" class="link">
									<i class="fa-solid fa-arrow-rotate-left"></i>
								</a>
						</div>
						<div class="card-body">
							<?php 
								$sid=intval($_GET['sid']);
								$sql = "SELECT * from suites where suiteid=:sid";
								$query = $dbh -> prepare($sql);
								$query -> bindParam(':sid', $sid, PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{	
							?>
							<form name="suite" method="post" enctype="multipart/form-data">
								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="name" class="col-form">Nom de la suite : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="suitename" id="suitename" placeholder="Nom de la suite de votre hôtel" value="<?php echo htmlentities($result->suitename);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="title" class="col-form">Titre : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="suitetitle" id="suitetitle" placeholder="Type de suite Ex : Comptemporaine, Hight-tech etc..." value="<?php echo htmlentities($result->suitetitle);?>" required>
									</div>
								</div>

								<!-- <div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="location" class="col-form">Hôtel hypnos : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="suitelocation" id="suitelocation" placeholder="Suite remantique avec vue sur le jardin à la Française" value="<?php echo htmlentities($result->suitelocation);?>" required>
									</div>
								</div> -->
								
								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="price" class="col-form">Prix de la nuitée : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="suiteprice" id="suiteprice" placeholder="Prix en €uros" value="<?php echo htmlentities($result->suiteprice);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="services" class="col-form">Services inclus : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="suiteservices" id="suiteservices" placeholder="Liste des services Ex : Wi-Fi gratuit - SPA privatif etc..." value="<?php echo htmlentities($result->suiteservices);?>" required>
									</div>
								</div>		

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="description" class="col-form">Description longue : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<textarea class="form-control input mb-3" style="height: 200px" name="suitedescription" id="suitedescription" placeholder="Description détaillée de la suite et du Room service" required><?php echo htmlentities($result->suitedescription);?></textarea> 
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="update" class="col-form mb-3">Image mise en avant : </label>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<img src="suitesimages/<?php echo htmlentities($result->suiteimage);?>" class="img-fluid shadow-lg firstimg">
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7 d-flex justify-content-start">
										<label for="update" class="col-form-label">Dernière mise à jour le : <?php echo htmlentities($result->updatedate);?></label>
									</div>
								</div>

								<div class="row g-3 justify-content-center mb-4">
									<div class="col-xl-7 col-lg-7 d-flex justify-content-end">
										<a class="link" href="change-image-suite.php?imgid=<?php echo htmlentities($result->suiteid);?>"><button type="button" class="btn btn-hypnos">Changer l'image</button></a>
									</div>
								</div>
								<?php 
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
								?>


								<div class="d-flex justify-content-end">
									<button type="submit" name="submit" class="btn btn-sm btn-hypnos mb-3">Mettre à jour</button>
								</div>
								<?php }} ?>
							</form>
						</div>
					</div>
				</div>
			</main>
			<div class="container-fluid">
				<?php include('includes/footer.php');?>
			</div>
		</body>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="js/scripts.js"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</html>
	<?php } ?>