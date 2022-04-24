<?php
session_start();
error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$rid=intval($_GET['rid']);	
if(isset($_POST['submit']))
{
$rname=$_POST['resortname'];
$raddress=$_POST['resortaddress'];	
$rzipcode=$_POST['resortzipcode'];
$rcity=$_POST['resortcity'];	
$rdescription=$_POST['resortdescription'];
$rimage=$_FILES["resortimage"]["name"];
$rmanagerid=$_POST['managerid'];	
$sql="UPDATE resorts set resortname=:rname,resortaddress=:raddress,resortzipcode=:rzipcode,resortcity=:rcity,resortdescription=:rdescription,managerid=:rmanagerid where resortid=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rname',$rname,PDO::PARAM_STR);
$query->bindParam(':raddress',$raddress,PDO::PARAM_STR);
$query->bindParam(':rzipcode',$rzipcode,PDO::PARAM_STR);
$query->bindParam(':rcity',$rcity,PDO::PARAM_STR);
$query->bindParam(':rdescription',$rdescription,PDO::PARAM_STR);
$query->bindParam(':rmanagerid',$rmanagerid,PDO::PARAM_STR);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
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
			<title>Hypnos | Mise à jour d'un hôtel</title>
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
				<div class="container-fluid shadow border-bottom alert alert-success"><?php echo htmlentities($msg); ?></div>
					<?php }?>
				<div class="container pt-5">
					<div class="card shadow-lg">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2>Mettre à jour l'hôtel</h2>
								<a href="manage-resorts.php" class="link">
									<i class="fa-solid fa-arrow-rotate-left"></i>
								</a>
						</div>
						<div class="card-body">
							<?php 
								$rid=intval($_GET['rid']);
								$sql = "SELECT * from resorts where resortid=:rid";
								$query = $dbh -> prepare($sql);
								$query -> bindParam(':rid', $rid, PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{	
							?>
							<form name="resort" method="post" enctype="multipart/form-data">
								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="name" class="col-form">Nom de l'hôtel : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="resortname" id="resortname" placeholder="Nom de l'hôtel" value="<?php echo htmlentities($result->resortname);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="address" class="col-form">Adresse : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="resortaddress" id="resortaddress" placeholder="Adresse postale" value="<?php echo htmlentities($result->resortaddress);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="zipcode" class="col-form">Code postal : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="resortzipcode" id="resortzipcode" placeholder="Code postal" value="<?php echo htmlentities($result->resortzipcode);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="city" class="col-form">Ville : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="resortcity" id="resortcity" placeholder="Ville" value="<?php echo htmlentities($result->resortcity);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="description" class="col-form">Description longue : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<textarea class="form-control input mb-3" style="height: 200px" name="resortdescription" id="resortdescription" placeholder="Description détaillée de la suite et du Room service" required><?php echo htmlentities($result->resortdescription);?></textarea> 
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<img src="resortsimages/<?php echo htmlentities($result->resortimage);?>" class="img-fluid shadow-lg firstimg">
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7 d-flex justify-content-start">
										<label for="update" class="col-form-label">Dernière mise à jour le : <?php echo htmlentities($result->updatedate);?></label>
									</div>
								</div>

								<div class="row g-3 justify-content-center mb-4">
									<div class="col-xl-7 col-lg-7 d-flex justify-content-end">
									<a class="link" href="change-image-resort.php?imgid=<?php echo htmlentities($result->resortid);?>"><button type="button" class="btn btn-hypnos">Changer l'image</button></a>
									</div>
								</div>

								<div class="row g-3 justify-content-center"><!-- 4eme input -->
								<div class="col-xl-7 col-lg-7">
									<label for="city" class="col-form">Affecter un directeur à cette établissement :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
							
									<?php			

										$sql = "SELECT * from managers";
										$query = $dbh -> prepare($sql);
										$query->execute();
										$managersResults=$query->fetchAll(PDO::FETCH_OBJ);
										
										if($query->rowCount() == 0)
											echo 'Pas de managers dans la base';
										else
										{
											echo '<select class="form-select form-control input" name="managerid" onChange="MM_jumpMenu(\'parent\',this,0)">';
											foreach($managersResults as $manager)
											{
												$selected = '';
												if( $result->managerid == $manager->id )
													$selected = ' selected="selected"';

												echo '<option  value="'.$manager->id.'" '.$selected.'>'.$manager->firstname.' '.$manager->lastname.'</option>';
												
											}
											echo '</select>';
										}
									?>
								</div>

								<div class="d-flex justify-content-end">
									<button type="submit" name="submit" class="btn btn-hypnos mb-3">Mettre à jour</button>
								</div>
								<?php }} ?>
							</form>
						</div>
					</div>
				</div>
			</main>
			<div class="footer">
				<?php include('includes/footer.php');?>
			</div>
		</body>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="js/scripts.js"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</html>
	<?php } ?>