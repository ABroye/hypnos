<?php
session_start();
error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
?>
<!DOCTYPE HTML>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
          <div class="card shadow-lg rounded-0 mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h2>Historique de mes échanges</h2>
                <a href="index.php" class="link d-none d-xl-block d-lg-block d-sm-block">
                  Retour au site <i class="fa-solid fa-right-from-bracket me-3"></i>
                </a>
            </div>
            <?php 
              $uemail=$_SESSION['login'];;
              $sql = "SELECT * FROM msg_users where useremail=:uemail";
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
            <div class="card border-0">
            <div class="card-header">
                N° de réclamation : <?php echo htmlentities($result->id);?>
              </div>
              <div class="card-body">
                <form name="chngpwd" method="post" onSubmit="return valid();">
                  <div class="accordion" id="accordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading">
                        <button class="accordion-button <?php if($ctn>1) echo "collapsed"; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $ctn; ?>" aria-expanded="<?php echo ($ctn==1)? 'true': 'false'; ?>" aria-controls="collapse<?php echo $ctn; ?>">
                          Objet : <?php echo htmlentities($result->request);?>
                        </button>
                      </h2>
                      <div id="collapse<?php echo $ctn; ?>" class="accordion-collapse collapse <?php  echo 'show'; ?>" aria-labelledby="heading<?php echo $ctn; ?>" data-bs-parent="#accordion">
                        <div class="accordion-body">
                          <dl class="row">
                            <dt class="col-sm-3">Expédié le :</dt>
                            <dd class="col-sm-9"><?php echo htmlentities($result->postingdate);?></dd>
                            <dt class="col-sm-3">Mon message :</dt>
                            <dd class="col-sm-9"><?php echo htmlentities($result->message);?></dd>
                          </dl>
                          <hr>
                          <dl>
                            <dt class="col-sm-3">Reçu le :</dt>
                            <dd class="col-sm-9"><?php echo htmlentities($result->responsedate);?></dd>
                            <dt class="col-sm-3">Message de l'hôtel:</dt>
                            <dd class="col-sm-9"><?php echo htmlentities($result->responseresort);?></dd>
                          </dl>
                        </div>
                      </div>
                      <?php
                        $ctn++;
                    }
                    ?>
                    </div>
                  </div>
                </form>  
              </div>
            <?php }?>
              
            </div>
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