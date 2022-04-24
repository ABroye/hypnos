<?php
session_start();
if(isset($_POST['signin']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password FROM users WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
	$sql = "SELECT firstname from users where emailid ='".$email."'";
	$req = $dbh->prepare($sql);
	$req->execute();
	$prenom = $req->fetch();
	$_SESSION['prenom']=$prenom[0];
	$_SESSION['login'] = $email;
	
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	//echo "<script type='text/javascript'>document.getElementByName('book').submit();</script>";
	
} else{
	echo "<script>alert('Mauvais identifiants');</script>";
}
}
?>
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content border border-modal">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="ModalLabel1">Connexion à mon compte</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body rounded-0">
				<form method="post">
					<input class="form-control mb-4" type="text" name="email" id="email1" placeholder="user@gmail.com"  required="">	
					<input class="form-control mb-4" type="password" name="password" id="password" placeholder="Demo" value="" required="">	
							<a class="link mb-4" href="forgot-password.php">
								Mot de passe oublié !
							</a>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-hypnos ms-3" name="signin">Connexion</button>
					</div>
				</form>
			</div>
			<div class="modal-footer bg-dark">
				<p class="text-white">
					En vous connectant, vous acceptez nos
					<a class="link" href="page.ptype=terms">
						Conditions générales d'utilisation
					</a>
						et
					<a class="link" href="page.ptype=privacy">
						Notre politique de confidentialité
					</a>
				</p>
			</div>
		</div>
	</div>
</div>
