<?php
session_start();
error_reporting(1);

include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
		header('location:index.php');

//$pid = intval($_GET['pid']);
//echo 'page'.$pid;

if(isset($_POST['submit']))
{
	$pid = intval($_POST['pid']);
	$pname=$_POST['pagename'];
	$ptitle=$_POST['pagetitle'];	
	$paddress=$_POST['pageaddress'];
	$pzipcode=$_POST['pagezipcode'];	
	$pcity=$_POST['pagecity'];
	$pdescription=$_POST['pagedescription'];	
	$pimage=$_FILES["pageimage"]["name"];
	$sql="UPDATE pages_resort set pagename=:pname,pagetitle=:ptitle,pageaddress=:paddress,pagezipcode=:pzipcode,pagecity=:pcity,pagedescription=:pdescription where pageid=:pid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':pname',$pname,PDO::PARAM_STR);
	$query->bindParam(':ptitle',$ptitle,PDO::PARAM_STR);
	$query->bindParam(':paddress',$paddress,PDO::PARAM_STR);
	$query->bindParam(':pzipcode',$pzipcode,PDO::PARAM_STR);
	$query->bindParam(':pcity',$pcity,PDO::PARAM_STR);
	$query->bindParam(':pdescription',$pdescription,PDO::PARAM_STR);
	$query->bindParam(':pid',$pid,PDO::PARAM_STR);
	$query->execute();
	$msg="Détails de la page mis à jour !";
}
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Mise à jour la page</title>
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
							<h2>Mettre à jour ma page hôtel</h2>
								<a href="dashboard.php" class="link">
									<i class="fa-solid fa-arrow-rotate-left"></i>
								</a>
						</div>
						<div class="card-body">
							<?php 
							    if($_SESSION['role'] == 'manager'){ 
									
								
									$req = "SELECT resortid from resorts where managerid = '".$_SESSION['user']->id."'";
									$exec = $dbh->prepare($req);
									$exec->execute();
									$rid = $exec->fetch();
									$hotelid = $rid['resortid'];


									// $pid=intval($_GET['pid']);
									$sql = "SELECT * from pages_resort where resortid=:hotelid";
									$query = $dbh -> prepare($sql);
									$query -> bindParam(':hotelid', $hotelid, PDO::PARAM_STR);
								}else{//admin ouvre toutes les pages
									$sql = "SELECT * from pages_resort";
									$query = $dbh -> prepare($sql);
								}

								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								// var_dump($results);
								$cnt=1;
							
							if($query->rowCount() == 0)
								echo "Aucune page n'existe pour l'hotel ID :".$hotelid." du manager :".$_SESSION['user']->id;
							else
							{
							foreach($results as $result)
							{	
								echo '<br>Modification page ID ';//.$result->pageid;
							?>
							<form name="suite" method="post" enctype="multipart/form-data">
								<input class="visually-hidden" type="text" name="pid" id="pid" value="<?php echo $result->pageid;?>" >
								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="name" class="col-form">Nom de la page : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="pagename" id="pagename" placeholder="Nom de la page de votre hôtel" value="<?php echo htmlentities($result->pagename);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="title" class="col-form">Titre : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="pagetitle" id="pagetitle" placeholder="Titre de votre page" value="<?php echo htmlentities($result->pagetitle);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="address" class="col-form">Adresse : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="pageaddress" id="pageaddress" placeholder="Adresse postale de votre hôtel" value="<?php echo htmlentities($result->pageaddress);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="zipcode" class="col-form">Code postal : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="pagezipcode" id="pagezipcode" placeholder="Code postal de votre hôtel" value="<?php echo htmlentities($result->pagezipcode);?>" required>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="city" class="col-form">Ville : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<input type="text" class="form-control input mb-3" name="pagecity" id="pagecity" placeholder="Code postal de la commune de votre hôtel" value="<?php echo htmlentities($result->pagecity);?>" required>
									</div>
								</div>		
									
								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="description" class="col-form">Description longue : </label>
									</div>
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<textarea class="form-control input mb-3" style="height: 200px" name="pagedescription" id="pagedescription" placeholder="Description détaillée de votre hôtel" required><?php echo htmlentities($result->pagedescription);?></textarea> 
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
										<label for="image" class="col-form mb-3">Image de l'hôtel : </label>
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7 justify-content-center">
										<img src="pagesimages/<?php echo htmlentities($result->pageimage);?>" class="img-fluid shadow-lg firstimg">
									</div>
								</div>

								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7 d-flex justify-content-start">
										<label for="update" class="col-form-label">Dernière mise à jour le : <?php echo htmlentities($result->updatedate);?></label>
									</div>
								</div>

								<div class="row g-3 justify-content-center mb-4">
									<div class="col-xl-7 col-lg-7 d-flex justify-content-end">
										<a class="link" href="change-image-page.php?imgid=<?php echo htmlentities($result->pageid);?>"><button type="button" class="btn btn-hypnos">Changer l'image</button></a>
									</div>
								</div>

								<div class="d-flex justify-content-end">
									<button type="submit" name="submit" class="btn btn-sm btn-hypnos mb-3">Mettre à jour</button>
								</div>
								<?php }} ?>
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
		<script src="js/scripts.js"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</html>