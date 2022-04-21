<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{ 
  $iid=intval($_GET['iid']);
if(isset($_POST['submit2']))
  {
$response=$_POST['response'];
$sql = "UPDATE msg_users SET responseresort=:response WHERE  id=:iid";
$query = $dbh->prepare($sql);
$query -> bindParam(':response',$response, PDO::PARAM_STR);
$query-> bindParam(':iid',$iid, PDO::PARAM_STR);
$query -> execute();
$msg="Réponse effectuée !";
}
 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Hypnos | Tableau des réservations</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mobile.css">
	</head>
	<body>
    <?php 
      $sql = "SELECT * from msg_users where id=:iid";
      $query = $dbh -> prepare($sql);
      $query-> bindParam(':iid',$iid, PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    foreach($results as $result)
    { 
      if($result->responseresort=="")
    {
    ?>
  <main class="">
    <?php if($error){?>
		<div class="container-fluid shadow border-bottom alert alert-danger">
			<strong>ERREUR : </strong>
			<?php echo htmlentities($error); ?>
		</div>
		<?php } 
			else if($msg){?>
		<div class="container-fluid shadow border-bottom alert alert-success">
			<?php echo htmlentities($msg); ?>
		</div>
		<?php }?>
      <div class="card border-0 shadow-lg m-auto d-flex justify-content-center w-100">
        <form name="updateticket" id="updateticket" method="post">
          <div class="card-header">
            <h2>Réponse au client !</h2>
          </div> 
          <div class="card-body">
            <div class="row g-3 align-items-center">
              <div class="col col-3 label">
                <label for="" class="col-form-label">Message : </label>
              </div>
              <div class="col col-9 mb-3">
                <textarea class="form-control input" style="height: 200px" name="response" id="" required="required"></textarea>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <button class="btn btn-hypnos" type="submit" name="submit2"  value="Envoyer">Envoyer</button>
            </div>
          </div>
        </form>
      </div>
    </main>
      <?php } else { ?>
        <tr>
          <td class="fontkink1" ><b>Message :</b></td>
          <td class="fontkink" align="justify" ><?php echo htmlentities($result->responseresort);?></td>
        </tr>
        <tr>
          <td class="fontkink1" ><b>Date :</b></td>
          <td class="fontkink" align="justify" ><?php echo htmlentities($result->responsedate);?></td>
        </tr>
      <?php }}}?>
  </body>
</html>
<?php } ?>

     