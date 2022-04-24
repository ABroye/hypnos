<?php
  session_start();
  error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['bookingid']))
	{
  $bid=intval($_GET['bookingid']);
  $email=$_SESSION['login'];
  $sql ="SELECT datein FROM reservations WHERE useremail=:email and bookingid=:bid";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':email', $email, PDO::PARAM_STR);
  $query-> bindParam(':bid', $bid, PDO::PARAM_STR);
  $query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
  $datein=$result->datein;
  $a=explode("/",$datein);
  $val=array_reverse($a);
  $mydate =implode("/",$val);
  $cdate=date('d/m/Y');
  $date1=date_create("$cdate");
  $date2=date_create("$fdate");
  $diff=date_diff($date1,$date2);
echo $df=$diff->format("%a");
if($df>1)
{
  $status=2;
  $cancelby='u';
  $sql = "UPDATE reservations SET status=:status,cancelledby=:cancelby WHERE useremail=:email and bookingid=:bid";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':status',$status, PDO::PARAM_STR);
  $query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
  $query-> bindParam(':email',$email, PDO::PARAM_STR);
  $query-> bindParam(':bid',$bid, PDO::PARAM_STR);
  $query -> execute();
  $msg="Réservation annulée avec succès !";
}
else
{
$error="Vous ne pouvez pas annuler la réservation 3 jours avant merci de contacter l'hôtel";
}
}
}
}
?>
<!DOCTYPE HTML>
	<html lang="fr">
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="description" content="Notre chaîne de 7 hôtels aux quatre coins de l'hexagone vous propose des séjours en Amoureux dans un petit coin de Paradis et mettent à votre disposition un personnel d'exception.">
            <meta name="keywords" content="">
			<title>Groupe hôtelier Hypnos | Hôtels de charme pour Amoureux</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
			<link href="css/hypnos.css" rel="stylesheet" type="text/css" />
			<link href="css/mobile.css" rel="stylesheet" type="text/css" />
			<link href="css/scrollToTop.css" rel="stylesheet" type="text/css" />
		</head>
	<body>
		<?php include('includes/header.php');?>
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
          <div class="card shadow-lg mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h2>Historique de mes réservations</h2>
                <a href="index.php" class="link d-none d-xl-block d-lg-block d-sm-block">
                  Retour au site <i class="fa-solid fa-right-from-bracket me-3"></i>
                </a>
            </div>
            <div class="card-body">
              <form name="chngpwd" method="post" onSubmit="return valid();">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Résa. N°</th>
                      <th>Hôtel</th>
                      <th>Suite</th>	
                      <th>Du</th>
                      <th>Au</th>
                      <th>Commentaire</th>
                      <th>Statut</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $uemail=$_SESSION['login'];;
                      $sql = "SELECT reservations.bookingid as bid,reservations.suiteid as suiteid,suites.suitename as suitename,reservations.datein as datein,reservations.dateout as dateout,reservations.usercomment as usercomment,reservations.status as status,reservations.createdate as createdate,reservations.cancelledby as cancelby,reservations.updatedate as updatedate from reservations join suites on suites.suiteid=reservations.suiteid where useremail=:uemail";
                      $query = $dbh->prepare($sql);
                      $query -> bindParam(':uemail', $uemail, PDO::PARAM_STR);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                      foreach($results as $result)
                      {
                      ?>
                    <tr>
                      <td>RESA - <?php echo htmlentities($cnt);?></td>
                      <td><?php echo htmlentities($result->resortname);?></td>
                      <td><a class="link" href="detail-suite.php?sid=<?php echo htmlentities($result->suiteid);?>"><?php echo htmlentities($result->suitename);?></a></td>
                      <td><?php echo htmlentities($result->datein);?></td>
                      <td><?php echo htmlentities($result->dateout);?></td>
                      <td><?php echo htmlentities($result->usercomment);?></td>
                      <td><?php if($result->status==0)
                        {
                        echo "En attente";
                        }
                        if($result->status==1)
                        {
                        echo "Confirmée !";
                        }
                        if($result->status==2 and  $result->cancelby=='u')
                        {
                        echo "Annulée par vos soins le : " .$result->updatedate;
                        } 
                        if($result->status==2 and $result->cancelby=='a')
                        {
                        echo "Annulée par l'hôtel le : " .$result->updatedate;

                        }
                        ?>
                      </td>
                      <td><?php echo htmlentities($result->createdate);?></td>
                        <?php if($result->status==2)
                      {
                      ?>
                      <td>Annulée</td>
                        <?php } else {?>
                      <td><a class="link" href="booking-history.php?bkid=<?php echo htmlentities($result->bid);?>" onclick="return confirm('Êtes-vous certain de vouloir annuler cette réservation ?')" >Annuler</a></td>
                        <?php }?>
                    </tr>
                      <?php $cnt=$cnt+1; }} ?>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
			</main>
      <script src="js/scrollToTop.js"></script>	
      <script src="js/navbar-scrolled.js"></script>
				<?php include('includes/tabbar.php');?>
      <div class="">
        <?php include('includes/footer.php');?>
      </div>
				<?php include('includes/signup.php');?>			
				<?php include('includes/signin.php');?>			
				<?php include('includes/request.php');?>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
			<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
	</body>
</html>
<?php } ?>