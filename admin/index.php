<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT * FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();

if($query->rowCount() > 0)//Admin trouvé et ok
{
		$adminLine = $query->fetch(PDO::FETCH_OBJ);
		print_r($adminLine);
		$_SESSION['alogin'] = $adminLine->firstname.' '.$adminLine->lastname;
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
		$_SESSION['role'] = 'admin';
		$_SESSION['user'] = $adminLine;
		//exit();
} else{
	$sql ="SELECT * FROM managers WHERE email=:uname and password=:password";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();

	if($query->rowCount() > 0)//Manager trouvé
	{
			$managerLine = $query->fetch(PDO::FETCH_OBJ);

			$_SESSION['alogin'] = $managerLine->firstname.' '.$managerLine->lastname;
			
			$_SESSION['role'] = 'manager';
			$_SESSION['user'] = $managerLine;

			$sql = 'SELECT * from resorts WHERE managerid = "'.$managerLine->id.'";';

			$query = $dbh -> prepare($sql);
			$query->execute();

			if($query->rowCount() == 1)
			{
				$managerResortLine = $query->fetch(PDO::FETCH_OBJ);
				$_SESSION['managerresort'] = $managerResortLine;

				echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
			}
			else
			{
					echo "Vous n'avez pas d'hotel associé à votre profil ou plusieurs hotels vous ont comme manager.";
			}
	}
	else
	{
		echo "<script>alert('Invalid Details');</script>";
	}	
}
}
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Hypnos | Administration</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mobile.css">
	</head>
  <body class="text-center">
    
		<main class="form-signin">
			<div class="row">
				<form method="post">
					<div class="col">
						<div class="card-signin text-center mt-5 shadow-lg rounded-0">
							<div class="card-header">
								<img class="my-2" src="img/Logo-h-100-gold.png" alt="" width="auto" height="100">
								<p class="tostada-signin h3">hypnos</p>
								<h1 class="h3 mb-3 fw-normal">Espace Administration</h1>
							</div>

							<div class="card-body pt-3">
                                <p style="color: red">Gérant : c.de-pontignac@hypnos-group.com</p>
								<div class="form-floating mx-5 my-3">
									<input type="text" name="username" class="form-control" id="floatingInput" placeholder="Identifiant" required="">
									<label for="floatingInput">admin</label>
								</div>

								<div class="form-floating mx-5 mb-3">
									<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required="">
									<label for="floatingPassword">Demo</label>
								</div>

								<div class="checkbox mb-3">
									<label>
										<input class="form-check-input" type="checkbox" value="remember-me"> Se souvenir de moi.
									</label>
								</div>
								<div class="mb-3">
								<button class="btn btn-lg btn-hypnos" type="submit" name="login">Connexion</button>
								</div>
							</div>

							<div class="card-footer py-3">
								<a href="../index.php" class="link">Retour à la page d'accueil</a>
							</div>
							
						</div>
					</div>
				</form>
			</div>
		</main>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>