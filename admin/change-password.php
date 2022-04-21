<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
	{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username="admin";
$sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where UserName=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Votre mot de passe a bien été modifié !";
}
else {
$error="Votre mot de passe actuel n'est pas valide...";	
}
}
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Hypnos | Modification mot de passe</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mobile.css">
	</head>
	<body>
			<?php include('includes/header.php');?>

				<main class="main mb-5">
				<?php if($error){?>
				<div class="container-fluid shadow border-bottom alert alert-danger">
					<strong>ERREUR : </strong>
					<?php echo htmlentities($error); ?>
				</div>
				<?php } 
					else if($msg){?>
				<div class="container-fluid shadow border-bottom alert alert-success">
					<?php echo htmlentities($msg); ?>
				</div>
					<?php }?>
				<div class="container pt-5">
					<div class="card shadow-lg">
						<div class="card-header d-flex justify-content-between align-items-center mb-5">
							<h2>Modification mot de passe</h2>
								<a href="dashboard.php" class="link">
									<i class="fa-solid fa-arrow-rotate-left"></i>
								</a>
						</div>
					<form  name="chngpwd" method="post" class="form-horizontal" onSubmit="return valid();">
						<div class="card-body">
							<div class="row g-3 align-items-center justify-content-center">
								<div class="col col-xl-6 col-lg-3 col-sm-12 col-xs-12 label">
									<label for="name" class="col-form-label">Mot de passe actuel :</label>
								</div>
								<div class="col col-xl-5 col-lg-12 col-sm-12 col-xs-12 mb-3">
									<input type="password" name="password" class="form-control input" id="exampleInputPassword1" placeholder="Votre mot de passe actuel" required="">
								</div>
							</div>

							<div class="row g-3 align-items-center justify-content-center">
								<div class="col col-xl-6 col-lg-3 col-sm-12 col-xs-12 label">
									<label class="col-form-label">Nouveau mot de passe :</label>
								</div>
								<div class="col col-xl-5 col-lg-12 col-sm-12 col-xs-12 mb-3">
									<input type="password" class="form-control input" name="newpassword" id="newpassword" placeholder="Votre nouveau mot de passe" required="">
								</div>
							</div>

							<div class="row g-3 align-items-center justify-content-center mb-5">
								<div class="col col-xl-6 col-lg-3 col-sm-12 col-xs-12 label">
									<label class="col-form-label">Confirmer le mot de passe</label>
								</div>
								<div class="col col-xl-5 col-lg-12 col-sm-12 col-xs-12 mb-3">
									<input type="password" class="form-control input" name="confirmpassword" id="confirmpassword" placeholder="Veuillez confirmer votre nouveau mot de passe" required="">
								</div>
							</div>

							<div class="col col-xl-12 d-flex justify-content-end">
								<button type="submit" name="submit" class="btn btn-hypnos">Confirmer</button>
							</div>

						</div>
					</form>
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