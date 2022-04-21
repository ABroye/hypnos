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
if(isset($_REQUEST['uid']))
	{
$uid=intval($_GET['uid']);
$status=1;

$sql = "UPDATE msg SET status=:status WHERE  id=:uid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':uid',$uid, PDO::PARAM_STR);
$query -> execute();

$msg="Message lu avec succès !";
}
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Demandes clients</title>
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
			<div class="container-fluid shadow border-bottom error alert alert-danger">
				<strong>ERREUR : </strong><?php echo htmlentities($error); ?>
			</div>
				<?php } 
							else if($msg){?>
			<div class="container-fluid shadow border-bottom success alert alert-success"><?php echo htmlentities($msg); ?></div>
				<?php }?>
			<div class="container pt-5">
				<div class="card shadow-lg">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h2>Gestion des demandes clients</h2>
							<a href="dashboard.php" class="link">
								<i class="fa-solid fa-arrow-rotate-left"></i>
							</a>
					</div>
					<div class="card-body">
						<table class="table table-striped border">
							<thead>
								<tr>
									<th>N°</th>
									<th>Prénom</th>
									<th>Nom</th>
									<th>N° de téléphone</th>
									<th>Courriel</th>
									<th>Objet</th>
									<th>Message</th>
									<th>Date </th>
									<th>Action </th>
								</tr>
							</thead>
						<tbody>
							<?php $sql = "SELECT msg_users.id as id,users.firstname as fname,users.lastname as lname,users.phonenumber as pnumber,users.emailid as email,msg_users.request as request,msg_users.message as message,msg_users.postingdate as postingdate from msg_users join users on users.emailid=msg_users.useremail";
								// Comme on récupère les valeurs *2 à cause de la requête on va venir créer une variable de parcours pour parcourir que la moitié 
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$tailleTab = count($results);
								$tailleParcours = 0;
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{
								if($tailleParcours < $tailleTab/2){
									$tailleParcours++;
								
							?>		
								<tr>
									<td>RCl - <?php echo htmlentities($result->id);?></td>
									<td><?php echo htmlentities($result->fname);?></td>
									<td><?php echo htmlentities($result->lname);?></td>
									<td><?php echo htmlentities($result->pnumber);?></td>
									<td><?php echo htmlentities($result->email);?></td>
									<td><?php echo htmlentities($result->request);?></a></td>
									<td><?php echo htmlentities($result->message);?></td>
									<td><?php echo htmlentities($result->postingdate);?></td>
									<td>
										<a 
											href="javascript:void(0);" 
											onClick="popUpWindow('update-users-msg.php?iid=<?php echo ($result->id);?>');">
											<button type="button "class="btn btn-sm btn-hypnos w-100">Répondre</button>
										</a>
									</td>
								</tr>
									<?php } }}?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
			<div class="fixed-bottom">
				<?php include('includes/footer.php');?>
			</div>
	</body>
		<script language="javascript" type="text/javascript">
			var popUpWin=0;
			function popUpWindow(URLStr, left, top, width, height)
			{
			if(popUpWin)
			{
			if(!popUpWin.closed) popUpWin.close();
			}
			popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
			}
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</html>
	<?php } ?>