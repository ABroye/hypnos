<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$pnumber=$_POST['pnumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql="INSERT INTO  users(firstname,lastname,phonenumber,emailid,Password) VALUES(:fname,:lname,:pnumber,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Votre enregistrement a réussi, vous pouvez vous connecter dès à présent !";
header('location:detail-suite.php?sid='.$_GET["sid"]);
}
else 
{
$_SESSION['msg']="Quelque chose s'est mal passé, merci de renouveler votre demande...";
header('location:detail-suite.php?sid='.$_GET["sid"]);
}
}
?>

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content border border-modal">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="ModalLabel">Créer un compte hypnos</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>					
			</div>
			<div class="modal-body rounded-0">
				<form name="signup" method="post">
					<input class="form-control mb-3" type="text" value="" placeholder="Votre prénom" name="fname" autocomplete="on" required="">
					<input class="form-control mb-3" type="text" value="" placeholder="Votre nom" name="lname" autocomplete="on" required="">
					<input class="form-control mb-3" type="text" value="" placeholder="Votre téléphone" name="pnumber" maxlength="10" autocomplete="on" required="">
					<input class="form-control mb-3" type="text" value="" placeholder="Votre courriel" name="email" id="email" onBlur="checkAvailability()" autocomplete="on"  required="">	
			 		<span id="user-availability-status" style="font-size:12px;"></span> 
					<input class="form-control mb-4" type="password" value="" placeholder="Votre mot de passe" name="password" required="">
					<div class="d-flex justify-content-end mb-3">
						<button type="button" class="btn btn-gold" data-bs-dismiss="modal">Fermer</button>
						<button type="submit" class="btn btn-hypnos ms-3" name="submit" id="submit">Valider</button>
					</div>
				</form>
			</div>
			<div class="modal-footer bg-dark">
				<p class="text-white">En vous connectant, vous acceptez nos <a class="link" href="page.type=terms">Conditions générales d'utilisation</a> et <a class="link" href="page.php?type=privacy">Notre politique de confidentialité</a></p>
			</div>
		</div>
	</div>
</div>