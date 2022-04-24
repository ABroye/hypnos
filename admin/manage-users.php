<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Hypnos | Tableau de bord</title>
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
				<div class="container pt-5">
					<div class="card shadow-lg">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2>Liste des clients</h2>
							<a href="dashboard.php" class="link">
								<i class="fa-solid fa-arrow-rotate-left"></i>
							</a>
						</div>
						<div class="card-body">
							<table class="table table-striped border">
								<thead>
									<tr>
										<th>N° de client</th>
										<th>Prénom</th>
										<th>Nom</th>
										<th>N° de téléphone</th>
										<th>Courriel</th>
										<th>Date d'enregistrement</th>
										<th>Date de mise à jour</th>
									</tr>
								</thead>
								<tbody>
									<?php $sql = "SELECT * from users";
										$query = $dbh -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{
									?>		
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->firstname);?></td>
											<td><?php echo htmlentities($result->lastname);?></td>
											<td><?php echo htmlentities($result->phonenumber);?></td>
											<td><?php echo htmlentities($result->emailid);?></td>
											<td><?php echo htmlentities($result->createdate);?></td>
											<td><?php echo htmlentities($result->updatedate);?></td>
										</tr>
									<?php $cnt=$cnt+1;} }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</main>
			<div class="footer">
				<?php include('includes/footer.php');?>
			</div>
		</body>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</body>
</html>
<?php } ?>