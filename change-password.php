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
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$email=$_SESSION['login'];
$sql ="SELECT password FROM users WHERE emailid=:email and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update users set password=:newpassword where emailid=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Mot de passe changé avec succès !";
}
else {
$error="Votre ancien mot de passe n'est pas valide !";	
}
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
						<div class="card shadow-lg mt-5">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h2>Changer votre mot de passe</h2>
									<a href="index.php" class="link d-none d-xl-block d-lg-block d-sm-block">
										Retour au site <i class="fa-solid fa-right-from-bracket ms-3"></i>
									</a>
							</div>
							<div class="card-body">
								<form name="changepwd" method="post" onSubmit="return valid();">
								<div class="row g-3 justify-content-center">
									<div class="col-xl-7 col-lg-7">
											<label for="password" class="col-form-label">Mot de passe :</label>
										</div>
										<div class="col-xl-7 col-lg-7 justify-content-center">
											<input id="placeholder" type="password" class="form-control input" name="password" id="password" placeholder="Entrez le mot de passe actuel" value="<?php echo htmlentities($result->password);?>" required="">
										</div>
									</div>
				
									<div class="row g-3 justify-content-center">
										<div class="col-xl-7 col-lg-7">
											<label for="password" class="col-form-label">Nouveau :</label>
										</div>
										<div class="col-xl-7 col-lg-7 justify-content-center">
											<input id="placeholder" type="password" class="form-control input" name="newpassword" id="newpassword" placeholder="Entrez le nouveau mot de passe" value="<?php echo htmlentities($result->newpassword);?>" required="">
										</div>
									</div>

									<div class="row g-3 justify-content-center">
										<div class="col-xl-7 col-lg-7">
											<label for="password" class="col-form-label">Confirmation :</label>
										</div>
										<div class="col-xl-7 col-lg-7 justify-content-center">
											<input id="placeholder" type="password" class="form-control input" name="confirmpassword" id="confirmpassword" placeholder="Confirmez votre nouveau mot de passe" value="<?php echo htmlentities($result->confirmpassword);?>" required="">
										</div>
									</div>

									<div class="d-flex justify-content-end">
											<button type="submit" name="submit6" class="btn btn-sm btn-hypnos pb-1">Mettre à jour</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script src="js/scrollToTop.js"></script>	
      <script src="js/navbar-scrolled.js"></script>
				<?php include('includes/tabbar.php');?>
				<div class="">
				<?php include('includes/footer.php');?>
				</div>
				<?php include('includes/signup.php');?>			
				<?php include('includes/signin.php');?>			
				<?php include('includes/request.php');?>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
			<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</body>
</html>
<?php } ?>