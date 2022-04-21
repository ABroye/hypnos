<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit1']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];	
$pnumber=$_POST['pnumber'];
$subject=$_POST['subject'];	
$message=$_POST['message'];
$sql="INSERT INTO  msg(firstname,lastname,emailid,phonenumber,subject,message) VALUES(:fname,:lname,:email,:pnumber,:subject,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Votre message a bien été transmis au service concerné !";
}
else 
{
$error="Quelque chose s'est mal passé. Veuillez réessayer";
}
}
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
        <div class="card-header shadow-lg border-top mb-5 mx-auto">
          <h1>Une question, notre équipe est à votre écoute...</h1>
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

      <div class="container mb-5">
        <div class="row g-3 justify-content-center">
          <div class="col-xl-7 col-lg-7">
            <p class="text-muted">Tous les champs sont obligatoires</p>
          </div>
        </div>

        <form name="enquiry" method="post">
          <div class="row g-3 justify-content-center">
            <div class="col-xl-7 col-lg-7">
              <label for="fname" class="col-form">Prénom :</label>
            </div>
            <div class="col-xl-7 col-lg-7 justify-content-center">
              <input type="text" class="form-control input mb-3" name="fname" id="fname" placeholder="Entrez votre prénom" value="<?php echo htmlentities($result->firstname);?>" required="">
            </div>
          </div>
  
          <div class="row g-3 justify-content-center">
            <div class="col-xl-7 col-lg-7">
              <label for="fname" class="col-form">Nom :</label>
            </div>
            <div class="col-xl-7 col-lg-7 justify-content-center">
              <input type="text" class="form-control input mb-3" name="lname" id="lname" placeholder="Entrez votre nom" value="<?php echo htmlentities($result->lastname);?>" required="">
            </div>
          </div>

          <div class="row g-3 justify-content-center">
            <div class="col-xl-7 col-lg-7">
              <label for="pnumber" class="col-form">Numéro de téléphone :</label>
            </div>
            <div class="col-xl-7 col-lg-7 justify-content-center">
              <input type="text" class="form-control input mb-3" name="pnumber" id="pnumber" placeholder="Entrez votre téléphone" value="<?php echo htmlentities($result->phonenumber);?>" required="">
            </div>
          </div>

          <div class="row g-3 justify-content-center">
            <div class="col-xl-7 col-lg-7">
              <label for="email" class="col-form">Courriel :</label>
            </div>
            <div class="col-xl-7 col-lg-7 justify-content-center">
              <input type="email" class="form-control input mb-3" name="email" id="email" placeholder="Entrez votre adresse électronique" value="<?php echo htmlentities($result->emailid);?>" required="">
            </div>
          </div>

          <div class="row g-3 justify-content-center">
            <div class="col-xl-7 col-lg-7">
              <label for="subject" class="col-form">Objet :</label>
            </div>
            <div class="col-xl-7 col-lg-7 justify-content-center">
              <input type="text" class="form-control input mb-3" name="subject" id="subject" placeholder="Indiquez l'objet de votre message" value="<?php echo htmlentities($result->subject);?>" required="">
            </div>
          </div>

          <div class="row g-3 justify-content-center">
            <div class="col-xl-7 col-lg-7">
              <label for="subject" class="col-form">Message :</label>
            </div>
            <div class="col-xl-7 col-lg-7 justify-content-center">
              <textarea class="form-control input mb-3" style="height: 200px" name="message" id="message"placeholder="Merci de nous indiquer votre message ici" required></textarea>
            </div>
          </div>

          <div class="d-flex justify-content-end mb-3">
            <button type="submit" name="submit1" class="btn btn-hypnos">Envoyer</button>
          </div>
        </form>
      </div>
    </main>
    <div id="jsScroll" class="scroll" onclick="scrollToTop();">
      <i class="fa-solid fa-angle-up"></i>
    </div>
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