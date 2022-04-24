<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if($_POST['submit']=="Update")
{
$pagetype=$_GET['type'];
$pagedetails=$_POST['pgedetails'];
$sql = "UPDATE pages SET detail=:pagedetails WHERE type=:pagetype";
$query = $dbh->prepare($sql);
$query -> bindParam(':pagetype',$pagetype, PDO::PARAM_STR);
$query-> bindParam(':pagedetails',$pagedetails, PDO::PARAM_STR);
$query -> execute();
$msg="La page du site a été mise à jour avec succès ";
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Hypnos | Tableau de bord</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/mobile.css">
		<script type="text/JavaScript">
			function MM_findObj(n, d) { //v4.01
				var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
					d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
				if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
				for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
				if(!x && d.getElementById) x=d.getElementById(n); return x;
			}
			function MM_validateForm() { //v4.0
				var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
				for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
					if (val) { nm=val.name; if ((val=val.value)!="") {
						if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
							if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
						} else if (test!='R') { num = parseFloat(val);
							if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
							if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
								min=test.substring(8,p); max=test.substring(p+1);
								if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
					} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
				} if (errors) alert('The following error(s) occurred:\n'+errors);
				document.MM_returnValue = (errors == '');
			}
			function MM_jumpMenu(targ,selObj,restore){ //v3.0
				eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
				if (restore) selObj.selectedIndex=0;
			}
		</script>
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
					<div class="card shadow-lg">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h2>Mise à jour des pages du site</h2>
							<a href="dashboard.php" class="link">
								<i class="fa-solid fa-arrow-rotate-left"></i>
							</a>
						</div>
						<div class="card-body">
							<form name="package" method="post" enctype="multipart/form-data">
								<div class="row g-3 justify-content-center">
									<div class="col-xl-9 col-lg-9">
										<label for="focusedinput" class="col-form-label">Selectionner une page :</label>
									</div>									
									<div class="col-xl-9 col-lg-9 justify-content-center">
										<select class="form-select form-control input" name="menu1" onChange="MM_jumpMenu('parent',this,0)">
											<option value="" selected="selected">Faites votre choix</option>
											<option value="manage-pages.php?type=terms">Conditions générales d'utilisation</option>
											<option value="manage-pages.php?type=privacy">Mentions légales</option>
											<option value="manage-pages.php?type=aboutus">À propos</option> 
											<option value="manage-pages.php?type=contact">Contactez-nous</option>
										</select>
									</div>
								</div>
								<div class="row g-3 align-items-center justify-content-center">
									<label for="focusedinput" class="col col-xl-9 col-lg-9 col-form-label">Page sélectionnée :
										<?php
											switch($_GET['type'])
											{
												case "terms" :
																	echo "Conditions générales d'utilisation (CGU)";
																	break;
												case "privacy" :
																	echo "Politique de confidentialité";
																	break;
												case "aboutus" :
																	echo "À propos";
																	break;
												case "contact" :
																	echo "Contactez-nous";
																	break;
												default :
																echo "";
																break;
											}
											?>
									</label>
								</div>
								<div class="row g-3 align-items-center justify-content-center">
									<label for="focusedinput" class="col col-xl-9 col-lg-9 col-form-label">Détails de la page :</label>
										<div class="col-xl-9 col-lg-9">
											<textarea class="form-control input" style="height: 400px" name="pgedetails" id="pgedetails" placeholder="Package Details" required>
												<?php 
													$pagetype=$_GET['type'];
													$sql = "SELECT detail from pages where type=:pagetype";
													$query = $dbh -> prepare($sql);
													$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
												if($query->rowCount() > 0)
												{
												foreach($results as $result)
												{		
												echo htmlentities($result->detail);
												}}
												?>
											</textarea> 
										</div>
								</div>															
								<div class="row">
									<div class="d-flex justify-content-end">
										<button type="submit" name="submit" value="Update" id="submit" class="btn btn-hypnos mt-5">Enregistrer</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</main>
                <div class="footer">
			    <?php include('includes/footer.php');?>
		        </div>		
		    </body>
		<script>
					ClassicEditor
							.create( document.querySelector( '#editor' ) )
							.catch( error => {
									console.error( error );
							} );
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/0f3ecde558.js" crossorigin="anonymous"></script>
</html>
<?php } ?>