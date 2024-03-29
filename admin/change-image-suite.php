<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$imgid=intval($_GET['imgid']);
if(isset($_POST['submit']))
{
$simage=$_FILES["suiteimage"]["name"];
move_uploaded_file($_FILES["suiteimage"]["tmp_name"],"suitesimages/".$_FILES["suiteimage"]["name"]);
$sql="UPDATE suites set suiteimage=:simage where suiteid=:imgid";
$query = $dbh->prepare($sql);
$query->bindParam(':imgid',$imgid,PDO::PARAM_STR);
$query->bindParam(':simage',$simage,PDO::PARAM_STR);
$query->execute();
$msg="Image mise à jour avec succès !";
}
?>
<!DOCTYPE HTML>
<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Image de mise en avant</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/mobile.css">
		</head>
	<body>
		<main class="main mb-5">
				<div class="container-fluid px-0 dashboard shadow-lg">
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
							<h2>Mise à jour de l'image de mise en avant </h2>
							<a href="dashboard.php" class="link">
										Retour au tableau de bord<i class="fa-solid fa-right-from-bracket"></i>
								</a>
						</div>
						<div class="card-body">
							<?php 
								$imgid=intval($_GET['imgid']);
								$sql = "SELECT suiteimage from suites where suiteid=:imgid";
								$query = $dbh -> prepare($sql);
								$query -> bindParam(':imgid', $imgid, PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{
							?>	
							<form name="suite" method="post" enctype="multipart/form-data">
								<div class="card-body">
								<div class="row g-3 align-items-center">
									<div class="col label-xl">
										<label for="image" class="col-form-label text-start">Image de mise en avant : </label>
									</div>
 									<div class="col-auto">
										<img class="img-fluid mb-4" src="suitesimages/<?php echo htmlentities($result->suiteimage);?>">
									</div>
								</div>
																	
								<div class="row g-3 align-items-center">
									<div class="col-auto label label-xl">
										<label for="image" class="col-form-label">Télécharger une nouvelle image :</label>
									</div>
									<div class="">
										<input type="file" name="suiteimage" class="form-control" id="suiteimage" aria-describedby="inputFile" aria-label="Télécharger">
									</div>
									<div class="d-flex justify-content-end">
										<button class="btn btn-hypnos mt-3" type="submit" name="submit">Enregistrer</button>
									</div>
								</div>	

									<?php }} ?>
							</div>
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
	<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</html>
<?php } ?>