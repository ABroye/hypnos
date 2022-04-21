<?php
session_start();
error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
elseif($_SESSION['role'] != 'admin')
{
	echo 'Vous ne disposez pas des autorisations necessaires';
}
else{ 
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Gestion des directeurs</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mobile.css">
	</head>
	<body>
		<div class="container-fluid px-0 dashboard shadow-lg">
			<?php include('includes/header.php');?>
		</div>
	<main class="main wrapper-admin mb-5">
			<?php if($error){?>
		<div class="container-fluid shadow border-bottom alert alert-danger">
			<strong>ERREUR : </strong><?php echo htmlentities($error); ?>
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
					<h2>Gestion des directeurs d'établissement</h2>
					<a href="dashboard.php" class="link">
						<i class="fa-solid fa-arrow-rotate-left"></i>
					</a>
				</div>
				<div class="card-body">
					<table class="table table-striped border">
						<thead>
							<tr>
								<th>ID</th>
								<th>Prénom</th>
								<th>Nom</th>
								<th>Adresse</th>
								<th>Code postal</th>
								<th>Ville</th>
								<th>Courriel</th>
								<th>Edition</th>
							</tr>
						</thead>
						<tbody>
							<?php $sql = "SELECT * from managers";
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
								<td><?php echo htmlentities($result->address);?></td>
								<td><?php echo htmlentities($result->zipcode);?></td>
								<td><?php echo htmlentities($result->city);?></td>
								<td><?php echo htmlentities($result->email);?></td> 
								<td><?php echo "<a href='#'>modifier</a>"; echo(" | "); echo '<a href="supprimer-managers.php?courriel=' . $result->email  .'">supprimer</a>';?></td>
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
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
			<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>