<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$sid=intval($_GET['sid']);
$useremail=$_SESSION['login'];
$datein=$_POST['datein'];
$dateout=$_POST['dateout'];
$usercomment=$_POST['usercomment'];
$status=0;
$sql="INSERT INTO reservations(resortid,suiteid,useremail,datein,dateout,usercomment,status) VALUES(:resortid,:sid,:useremail,:datein,:dateout,:usercomment,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':resortid',$resortid,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':datein',$datein,PDO::PARAM_STR);
$query->bindParam(':dateout',$dateout,PDO::PARAM_STR);
$query->bindParam(':usercomment',$usercomment,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Merci pour votre réservation !";
}
else 
{
$error="Quelque chose s'est mal passé, merci de renouveler votre demande...";
}
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Notre chaîne de 7 hôtels aux quatre coins de l'hexagone vous propose des séjours en Amoureux dans un petit coin de Paradis et mettent à votre disposition un personnel d'exception.">
    <meta name="keywords" content="hotel, hotel de charme, week-end en amoureux, coin de paradis, ambiance cozy">
    <title>Groupe hôtelier Hypnos | Hôtels de charme pour Amoureux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/hypnos.css" rel="stylesheet" type="text/css" />
    <link href="css/mobile.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- datepicker -->
    <script src="js/jquery-ui.js"></script>
		<script>
			$(function() {
			$( "#datepicker,#datepicker1" ).datepicker();
			});
		</script>

  </head>
<body>
  <?php include('includes/header.php');?>
  <main class="main">
    <?php 
      $sid=intval($_GET['sid']);
      $sql = "SELECT * from suites where suiteid=:sid";
      $query = $dbh->prepare($sql);
      $query -> bindParam(':sid', $sid, PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
    if($query->rowCount() > 0)
      {
    foreach($results as $result)
      {
    ?>
    <form name="book" method="post">

    <div class="container-fluid p-0">
      <div class="card-header shadow-lg border-top my-5 mx-auto">
        <h2>Détail de notre suite <?php echo htmlentities($result->suitename);?></h2>
      </div>
    </div>
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
    <div class="container">
      <div class="card rounded-0 mb-5">
        <div class="p-carousel mb-5">
          <div class="carousel slide" data-ride="carousel" id="carousel-1">
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active"><img class="card-img-top px-3 w-100 d-block" src="admin/suitesimages/<?php echo htmlentities($result->suiteimage);?>" alt="Slide Image"></div>
              <div class="carousel-item"><img class="card-img-top px-3 w-100 d-block" src="admin/suitesimages/<?php echo htmlentities($result->suiteimage);?>" alt="Slide Image"></div>
              <div class="carousel-item"><img class="card-img-top px-3 w-100 d-block" src="admin/suitesimages/<?php echo htmlentities($result->suiteimage);?>" alt="Slide Image"></div>
            </div>
            <div><a class="carousel-control-prev" href="#carousel-1"  role="button" data-slide="prev"><span  class="carousel-control-prev-icon"></span><span  class="sr-only">Previous</span></a><a  class="carousel-control-next" href="#carousel-1"   role="button" data-slide="next"><span   class="carousel-control-next-icon"></span><span   class="sr-only">Next</span></a></div>
              <ol class="carousel-indicators">
                <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-1" data-slide-to="1"></li>
                <li data-target="#carousel-1" data-slide-to="2"></li>
              </ol>
            </div>
          </div>
        <div class="card-body">
          <h2><?php echo htmlentities($result->suitename);?></h2>
          <p class="card-text text-muted visually-hidden">Suite - <?php echo htmlentities($result->suiteid);?></p>
          <p class="card-text"></b> <?php echo htmlentities($result->suitetitle);?></p>
          <p class="card-text">Hôtel :</b> <?php echo htmlentities($result->resortname);?></p>
          <p class="card-text"><?php echo htmlentities($result->suiteservices);?></p>
          <p class="card-text">Description :</b> <?php echo htmlentities($result->suitedescription);?></p>
        </div>

        <div class="card-footer border-bottom rounded-0">
          <div class="flex-row input-group">
            <input type="date" class="form-control mx-5" style="widht: 30%" placeholder="Choisir une date d'arrivée" name="datein" id="datepicker" aria-label="Date d'arrivée" aria-describedby="datepicker">
            <input type="date" class="form-control mx-5" style="widht: 30% placeholder="Choisir une date de départ" name="dateout" id="datepicker1" aria-label="Date de départ" aria-describedby="datepicker1">
          </div>
        </div>

        <div class="container">
          <h2>Faîtes-nous part de vos attentes</h2>
          <div class="flex-row g-3 align-items-center">
            <div class="col col-xl-3 col-lg-3 label">
              <label class="col-form-label">Commentaire : </label>
            </div>
            <div class="col col-xl-7 col-lg-7">
              <textarea class="form-control input" style="height: 100px" type="text" name="usercomment" required=""></textarea>
            </div>
            <div class="d-flex justify-content-end my-3">
                <h5>Prix de la nuit : <?php echo htmlentities($result->suiteprice);?>,00 €</h5>
            </div>
            <?php if($_SESSION['login'])
            {?>
                        <div class="d-flex justify-content-end pb-3">
              <button type="submit" name="submit2" class="btn btn-hypnos">Réserver</button>
            </div>
              <?php } else {?>
            <div class="d-flex justify-content-end pb-3">
              <a href="https://www.booking.com" target="_blank"><button type="button" class="btn btn-booking shadow me-4">Booking.com</button></a>
              <a href="#" type="submit2" data-bs-toggle="modal" data-bs-target="#Modal1" class="btn btn-hypnos shadow" >Réserver</a>
              <?php } ?>
            </div>
            <div class="d-flex justify-content-end pb-3 ms-4">
              <a href="suites-list.php" target="_self"><button type="button" class="btn btn-hypnos shadow">Retour aux suites</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>

  </main>
    <?php }} ?>
    <script src="js/scrollToTop.js"></script>	
    <script src="js/navbar-scrolled.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <?php include('includes/tabbar.php');?>
      <?php include('includes/footer.php');?>
      <?php include('includes/signup.php');?>			
      <?php include('includes/signin.php');?>			
      <?php include('includes/request.php');?>	
    <script src="js/navbar-scrolled.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
  </body>
</html>