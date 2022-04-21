<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit6']))
	{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$pnumber=$_POST['pnumber'];
$email=$_SESSION['login'];
$sql="UPDATE users set firstname=:fname,lastname=:lname,phonenumber=:pnumber where emailid=:email";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->execute();
$msg="Vos coordonnées ont bien été mises à jour !";
}
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Groupe hôtelier Hypnos | Hôtels de charme pour Amoureux</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
			<link href="css/hypnos.css" rel="stylesheet" type="text/css" />
			<link href="css/mobile.css" rel="stylesheet" type="text/css" />
			<link href="css/scrollToTop.css" rel="stylesheet" type="text/css" />
		</head>
	<body>
		<div class="account">
		<?php include('includes/header.php');?>
		</div>
		<main class="main mb-5">
			<div class="container pt-5">
			<?php if($error){?>
				<div class="container-fluid shadow border-bottom alert alert-danger pt-5">
					<strong>ERREUR : </strong><?php echo htmlentities($error); ?>
				</div>
					<?php } 
								else if($msg){?>
				<div class="container-fluid shadow border-bottom alert alert-success"><?php echo htmlentities($msg); ?></div>
					<?php }?>
				<div class="card shadow-lg mt-5">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h2>Mes coordonnées</h2>
							<a href="index.php" class="link d-none d-xl-block d-lg-block d-sm-block">
								Retour au site <i class="fa-solid fa-right-from-bracket me-3"></i>
							</a>
					</div>
					<div class="card-body">
						<?php 
							$email=$_SESSION['login'];
							$sql = "SELECT * from users where emailid=:email";
							$query = $dbh -> prepare($sql);
							$query -> bindParam(':email',$email, PDO::PARAM_STR);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
							// var_dump($results);
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{	?>
						<form name="changepwd" method="post" enctype="multipart/form-data">
						<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="fname" class="col-form">Prénom :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="fname" id="fname" placeholder="Entrez votre prénom" value="<?php echo htmlentities($result->firstname);?>" required="">
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="lname" class="col-form">Nom :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="lname" id="lname" placeholder="Entrez votre nom" value="<?php echo htmlentities($result->lastname);?>" required="">
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="pnumber" class="col-form">Numéro de téléphone :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="text" class="form-control input mb-3" name="pnumber" id="pnumber" placeholder="Entrez votre téléphone" value="<?php echo htmlentities($result->phonenumber);?>" required="">
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7">
									<label for="email" class="col-form">Courriel :</label>
								</div>
								<div class="col-xl-7 col-lg-7 justify-content-center">
									<input type="email" class="form-control input mb-3" name="email" id="email" placeholder="Entrez votre adresse électronique" value="<?php echo htmlentities($result->emailid);?>" readonly required="">
								</div>
							</div>

							<div class="row g-3 justify-content-center">
								<div class="col-xl-7 col-lg-7 d-flex justify-content-start">
									<label for="create" class="col-form-label">
										Date de création le : <?php echo htmlentities($result->createdate);?>
									</label>
								</div>

								<div class="col-xl-7 col-lg-7 d-flex justify-content-start">
									<label for="update" class="col-form-label">
										Dernière mise à jour le : <?php echo htmlentities($result->updatedate);?>
									</label>
								</div>

								<div class="d-flex justify-content-end">
									<button type="submit" name="submit6" class="btn btn-sm btn-hypnos pb-1">Mettre à jour</button>
								</div>
							</div>
							<?php }} ?>
						</form>
					</div>
				</div>
			</div>
		</main>
		<script src="js/scrollToTop.js"></script>	
    <script src="js/navbar-scrolled.js"></script>
			<?php include('includes/footer.php');?>
			<?php include('includes/tabbar.php');?>
			<?php include('includes/signup.php');?>			
			<?php include('includes/signin.php');?>			
			<?php include('includes/request.php');?>	
		<script src="js/navbar-scrolled.js"></script>		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>