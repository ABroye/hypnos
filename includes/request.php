<?php
error_reporting(0);
if(isset($_POST['submit9']))
{
$request=$_POST['request'];
$message=$_POST['message'];
$uemail=$_SESSION['login'];
$sql="INSERT INTO  msg_users(useremail,request,message) VALUES(:uemail,:request,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':request',$request,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':uemail',$uemail,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Votre demande a bien été prise en compte ! ";
echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
else 
{
$_SESSION['msg']="Quelque chose s'est mal passé. Veuillez réessayer";
echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
}
?>	

<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content border border-modal">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="ModalLabel2">Contactez le service client</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body rounded-0">
				<form name="request" method="post">
					<select class="form-select form-control input" name="request" onChange="MM_jumpMenu('parent',this,0)">
						<option class="form-control input" value="" selected="selected">Faites votre choix</option>
						<option value="Réclamation">Je souhaite poser une réclamation</option>
						<option value="Services supplémentaire">Je souhaite commander un service supplémentaire</option>
						<option value="Souhait sur une suite">Je souhaite en savoir plus sur une suite</option> 
						<option value="Problème d'application">J’ai un souci avec cette application</option>
					</select>
					<textarea class="form-control input mt-3" style="height: 100px"  placeholder="Message"  name="message" required=""></textarea>
				</form>
				<div class="d-flex justify-content-end">
					<button type="submit" name="submit9" class="btn btn-hypnos mt-5">Envoyer</button>
				</div>
			</div>
		</div>
	</div>
</div>