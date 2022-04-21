<?php
session_start();
error_reporting(1);
include('includes/config.php');
?>
<!DOCTYPE HTML>
  <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

      <?php 
        $pageid = $_GET['pageid'];
        $sql = "SELECT * from pages_resort where pageid = '".$pageid."'";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
      if($query->rowCount() == 0)
        echo "<br/>La page ID n'existe pas : ".$pageid;
      else
      {
      foreach($results as $result)
      {	
          ?>

      <div class="container-fluid p-0">
        <div class="container mb-5">

          <div class="card shadow-lg border">

            <div class="container-fluid card-header border-bottom mx-auto">
              <h1><?php echo htmlentities($result->pagename);?></h1>
            </div>
      
            <div class="card-body">
              <img src="admin/pagesimages/<?php echo htmlentities($result->pageimage);?>" alt="Hôtel hypnos group" class="img-fluid mb-4">
              <div class="card-title">
                <h2><?php echo htmlentities($result->pagetitle);?></h2>
              </div>
                <p class="card-text"><?php echo htmlentities($result->pagedescription);?></p>
            </div>
            <div class="card-footer border-top ps-5 pt-5">
              <p class="text-muted mb-1"><?php echo htmlentities($result->pagename);?></p>
              <p class="text-muted mb-1"><?php echo htmlentities($result->pageaddress);?></p>
              <p class="text-muted mb-1"><?php echo htmlentities($result->pagezipcode);?></p>
              <p class="text-muted"><?php echo htmlentities($result->pagecity);?></p>
              <div class="d-flex justify-content-end">
                <a href="suites-list.php?idhotel=<?php echo $result->resortid;?>">Voir nos suites</a>
              </div>
            </div>

          </div>
        </div>
      </div>
      <?php } ?>
      
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
    <script src="js/scrollToTop.js"></script>	
    <script src="js/navbar-scrolled.js"></script>
  </body>
</html>
<?php } ?>