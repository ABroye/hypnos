<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 
	// code for cancel
if(isset($_REQUEST['bookid']))
	{
$bid=intval($_GET['bookid']);
$status=2;
$cancelby='a';
$sql = "UPDATE reservations SET status=:status,cancelledby=:cancelby WHERE  bookingid=:bid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':bid',$bid, PDO::PARAM_STR);
$query -> execute();

$msg="Réservation annulée avec succès !";
}


if(isset($_REQUEST['bookcid']))
	{
$bcid=intval($_GET['bookcid']);
$status=1;
$cancelby='a';
$sql = "UPDATE reservations SET status=:status WHERE bookingid=:bcid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':bcid',$bcid, PDO::PARAM_STR);
$query -> execute();
$msg="Réservation confirmée avec succès !";
}
?>
<!DOCTYPE HTML>
<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Tableau des réservations</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/mobile.css">
		</head>
		<body>
			<div class="container-fluid px-0 dashboard shadow-lg">
				<?php include('includes/header.php');?>
			</div>
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
						<div class="card-header d-flex justify-content-between align-items-center">
						  <h2>
								Gestion des réservations
							</h2>
								<a href="dashboard.php" class="link">
									<i class="fa-solid fa-arrow-rotate-left"></i>
								</a>
						</div>
							<div class="card-body">
								<table class="table table-striped border">
									<thead>
										<tr>
											<th>Résa. N°</th>
											<th>Prénom</th>
											<th>Nom</th>
											<th>N° de téléphone</th>
											<th>Courriel</th>
											<th>Hôtel</th>
											<th>Suite</th>
											<th>Date</th>
											<th>Commentaire</th>
											<th>Statut</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											// $sql = "SELECT reservations.bookingid as bookid,users.firstname as fname,users.lastname as lname,users.phonenumber as pnumber,users.emailid as email,suites.suitename as suitename,reservations.bookingid as pid,reservations.datein as datein,reservations.dateout as dateout,reservations.usercomment as usercomment,reservations.status as status,reservations.cancelledby as cancelby,reservations.updatedate as updatedate from users join  reservations on  reservations.useremail=users.emailid join suites on suites.suiteid=reservations.suiteid ";
											$idManager = $_SESSION['user']->id;
											// echo($idManager);
											$sql = "SELECT * from reservations where suiteid in (SELECT suiteid from suites where resortid in (SELECT resortid from resorts where managerid in(SELECT id from managers where id ='".$idManager."')))";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											// var_dump($results);
											$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{
											$sqlUser = "SELECT * from users where emailid in (SELECT useremail from reservations where suiteid in (SELECT suiteid from suites where resortid in (SELECT resortid from resorts where managerid in (SELECT id from managers where id ='".$idManager."'))))";
											$q = $dbh->prepare($sqlUser);
											$q->execute();
											$userinfo = $q->fetch(PDO::FETCH_OBJ);
											$prenom = $userinfo->firstname;
											$nom = $userinfo->lastname;
											$tel = $userinfo->phonenumber;
											$mail = $userinfo->emailid;
										?>	
										<tr>
											<td>RESA - <?php echo htmlentities($result->bookingid);?></td>
											<td><?php echo htmlentities($prenom);?></td>
											<td><?php echo htmlentities($nom);?></td>
											<td><?php echo htmlentities($tel);?></td>
											<td><?php echo htmlentities($mail);?></td>
											<td><?php 
											$sql ="SELECT resortname from resorts where resortid in(SELECT resortid from suites where suiteid in (SELECT suiteid from reservations where bookingid = '".$result->bookingid."' ) )";
											$qr = $dbh->prepare($sql);
											$qr->execute();
											$nomHotel = $qr->fetch();
											echo htmlentities($nomHotel['resortname']);?></td> 
											<td><?php
											$sql ="SELECT suitename from suites where suiteid in (SELECT suiteid from reservations where bookingid = '".$result->bookingid."' )";
											$qr = $dbh->prepare($sql);
											$qr->execute();
											$suitename = $qr->fetch();
											echo htmlentities($suitename['suitename']);?></td>
											<td>Du<br><?php echo htmlentities($result->datein);?><br>Au<br><?php echo htmlentities($result->dateout);?></td>
											<td><?php echo htmlentities($result->usercomment);?></td>
											<td><?php if($result->status==0)
												{
												echo "En attente";
												}
												if($result->status==1)
												{
												echo "Confirmé !";
												}
												if($result->status==2 and  $result->cancelby=='a')
												{
												echo "Annulé par vous le : " .$result->updatedate;
												} 
												if($result->status==2 and $result->cancelby=='u')
												{
												echo "Annulé par le client le : " .$result->updatedate;

												}
												?></td>
												<?php if($result->status==2)
												{
												?>
											<td>Annulé</td>
												<?php } 
															else 
															{
															?>
											<td>
												<a 
													href="manage-bookings.php?bookid=<?php echo htmlentities($result->bookid);?>" 
													onclick="return 
													confirm('Voulez-vous vraiment annuler la réservation ?')" >
													<button class="btn btn-sm btn-danger mb-3 w-100">Annuler</button>
												</a>
												<a 
													href="manage-bookings.php?bookcid=<?php echo htmlentities($result->bookid);?>" 
													onclick="return 
													confirm('La réservation a été confirmée')" >
													<button class="btn btn-sm btn-success w-100">Confirmer</button>
												</a>
											</td>
												<?php }?>
										</tr>
											<?php $cnt=$cnt+1;}
											}
											?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
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