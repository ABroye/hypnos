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
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status=1;

$sql = "UPDATE msg SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Accusé de lecture envoyé !";
}
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Demandes visiteurs</title>
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
				<strong>ERREUR : </strong><?php echo htmlentities($error); ?>
			</div>
				<?php } 
							else if($msg){?>
			<div class="container-fluid shadow border-bottom alert alert-success"><?php echo htmlentities($msg); ?></div>
				<?php }?>
			<div class="container pt-5">
				<div class="card shadow-lg">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h2>Gestion des demandes visiteurs</h2>
							<a href="dashboard.php" class="link">
								<i class="fa-solid fa-arrow-rotate-left"></i>
							</a>
					</div>
					<div class="card-body">
						<table class="table table-striped border">
							<thead>
								<tr>
									<th>N°</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>N° de téléphone</th>
									<th>Courriel</th>
									<th>Objet </th>
									<th>Message </th>
									<th>Date </th>
									<th>Action </th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql = "SELECT * from msg";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0)
								{
								foreach($results as $result)
								{
								?>		
									<tr>
									<td>DVi - <?php echo htmlentities($result->id);?></td>
									<td><?php echo htmlentities($result->lastname);?></td>
									<td><?php echo htmlentities($result->firstname);?></td>
									<td><?php echo htmlentities($result->phonenumber);?></td>
									<td><?php echo $result->emailid;?></td>
									<td><?php echo htmlentities($result->subject);?></a></td>
									<td><?php echo htmlentities($result->message);?></td>
									<td><?php echo htmlentities($result->postingdate);?></td>
										<?php if($result->Status==1)
									{
									?>
									<td><button type="button "class="btn btn-sm btn-gold w-100">Message lu !</button></td>
										<?php } else 
									{
									?>
									<td>
										<a 
											href="manage-msg.php?eid=<?php echo htmlentities($result->id);?>" 
											onclick="return 
											confirm('Voulez-vous vraiment envoyer l\'accusé de lecture ?')" >
											<button type="button "class="btn btn-sm btn-hypnos w-100">Accuser la lecture</button>
										</a>
									</td>
										<?php } ?>
								</tr>
									<?php } }?>
							</tbody>
						</table>
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