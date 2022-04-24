<?php
session_start();
error_reporting(0);
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
      <div class="container-fluid p-0">
        <div class="card-header shadow-lg border-top my-5 mx-auto">
          <h1>Bienvenue sur le site de la chaîne d'hôtels hypnos</h1>
        </div>
      </div>
      <div class="container mb-5">
        <div class="container-fluid shadow border-bottom alert alert-success">
          <h4>  <?php echo htmlentities($_SESSION['msg']);?></h4>
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
      <script src="js/scrollToTop.js"></script>	
      <script src="js/navbar-scrolled.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
  </body>
</html>