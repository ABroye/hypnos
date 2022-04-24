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
							<h2>Gestion des suites</h2>
								<a href="dashboard.php" class="link">
									<i class="fa-solid fa-arrow-rotate-left"></i>
								</a>
						</div>
						<div class="card-body">
							<table class="table table-striped border">
								<thead>
									<tr>
										<th>N° de suite </th>
										<th>Nom de la suite </th>
										<th>Description courte </th>
										<th>Hôtel hypnos </th>
										<th>Prix de la nuitée </th>
										<th>Date de création </th>
										<th>Action</th>
									</tr>
								</thead>
							<tbody>
								<?php 
								
								$sql = "SELECT * from suites";
									
									if($_SESSION['role'] == 'manager')
										//$sql .= ' WHERE resortid = 1';
										$sql .= ' WHERE resortid = '.$_SESSION['managerresort']->resortid;
									
									$query = $dbh -> prepare($sql);
									//echo 'REQUETE: '.$sql;
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
										<td><?php echo htmlentities($result->suitename);?></td>
										<td><?php echo htmlentities($result->suitetitle);?></td>
										<td><?php echo htmlentities($result->suitelocation);?></td>
										<td><?php echo htmlentities($result->suiteprice);?></td>
										<td><?php echo htmlentities($result->createdate);?></td>
										<td>
											<a 
												href="update-suite.php?sid=<?php echo htmlentities($result->suiteid);?>">
												<button type="button" class="btn btn-sm btn-hypnos w-100">Voir le détail</button>
											</a>
										</td>
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
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</html>
<?php } ?>