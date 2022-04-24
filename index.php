<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="description" content="Notre chaîne de 7 hôtels aux quatre coins de l'hexagone vous propose des séjours en Amoureux dans un petit coin de Paradis et mettent à votre disposition un personnel d'exception.">
      <meta name="keywords" content="hotel, hotel de charme, week-end en amoureux, coin de paradis, ambiance cozy">
      <title>Groupe hôtelier Hypnos | Hôtels de charme pour Amoureux</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
      <link href="css/mobile.css" rel="stylesheet" type="text/css" />
      <link href="css/hypnos.css" rel="stylesheet" type="text/css" />
      <link href="css/scrollToTop.css" rel="stylesheet" type="text/css" />
    </head>
  <body>
    <?php include('includes/header.php');?>
    <main class="main">
      <div class="container-fluid p-0">
        <div class="card-header shadow-lg border-top my-5 mx-auto">
          <h1>Bienvenue sur le site du groupe Hypnos</h1>
        </div>
      </div>
      <div class="container mb-5">
        <?php $sql = "SELECT * from suites order by rand() limit 4";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
        if($query->rowCount() > 0)
          {
        foreach($results as $result)
          {	?>
        <div class="card shadow-lg rounded-0 mb-5">
          <div class="row">
            <div class="col-xl-6 col-lg-12 col-sm-12">
              <img src="admin/suitesimages/<?php echo htmlentities($result->suiteimage);?>" class="img-fluid w-100 h-100 p-3 shadow zoom" alt="Suite">
            </div>
            <div class="col-xl-6 col-sm-12">
              <div class="card-body h-100">
                <div class="card-title pb-2">
                  <h2 class="mb-2"><?php echo htmlentities($result->suitename);?></h2>	
                  <p class="card-text"><b>Hôtel : </b> <?php echo htmlentities($result->suitelocation);?></p>
                  <p class="card-text"><b></b> <?php echo htmlentities($result->suitetitle);?></p>
                  <p class="card-text col-xl-11" ><b>Services inclus : </b> <?php echo htmlentities($result->suiteservices);?></p>
                  <p class="card-text col-xl-11" ><b>Description : </b> <?php echo htmlentities($result->suitedescription);?></p>
                </div>
                <div class="d-flex justify-content-end pb-3">
                  <h5>Prix de la nuit : <?php echo htmlentities($result->suiteprice);?>,00 €</h5>
                </div>
                <div class="d-flex justify-content-end align-items-end pb-3">
                  <a href="https://www.booking.com" target="_blank" class="btn btn-booking shadow me-4">Booking.com</a>
                  <a href="detail-suite.php?sid=<?php echo htmlentities($result->suiteid);?>" class="btn btn-hypnos shadow">Voir la suite</a>
                </div>
              </div>
            </div>
          </div>
        </div>
          <?php }} ?>
        <div class="d-flex justify-content-end">
          <a href="suites-list.php" class="btn btn-hypnos shadow me-3 my-3">
            Voir plus de suites
          </a>
        </div>
      </div>
    </main>
    <div id="jsScroll" class="scroll" onclick="scrollToTop();">
      <i class="fa-solid fa-angle-up"></i>
    </div>
      <?php include('includes/tabbar.php');?>
      <?php include('includes/footer.php');?>
      <?php include('includes/signup.php');?>			
      <?php include('includes/signin.php');?>			
      <?php include('includes/request.php');?>	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/scrollToTop.js"></script>	
    <script src="js/navbar-scrolled.js"></script>
  </body>
</html>