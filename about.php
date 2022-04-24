<?php
session_start();
error_reporting(1);
include('includes/config.php');
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="description" content="Notre chaîne de 7 hôtels aux quatre coins de l'hexagone vous propose des séjours en Amoureux dans un petit coin de Paradis et mettent à votre disposition un personnel d'exception.">
      <meta name="keywords" content="hotel, hotel de charme, week-end en amoureux, coin de paradis, ambiance cozy">
      <title>Liste des hôtels hypnos</title>
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
          <h1>Liste de nos hôtels hypnos et de leur gérant</h1>
        </div>
      </div>
      <div class="container">
        
      <div class="d-flex justify-content-center">
        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-boss-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Fondateur d'hypnos"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>c.de-pontignac@hypnos-group.com</a>" />
          <h2>Charles De Pontignac</h2>
          <h4 class="text-muted">Fondateur d'hypnos</h4>
          <h4 class="text-muted">Directeur hypnos Versailles</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=7">Voir l'établissement &raquo;</a></p>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-arcachon-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Directrice d'Arcachon"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>e.gunther@hypnos-group.com</a>" />
          <h2>Eva Gunther</h2>
          <h4 class="text-muted">Directrice Hypnos Arcachon</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=1">Voir l'établissement &raquo;</a></p>
        </div>

        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-brest-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Directrice de Brest"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>a.shepard@hypnos-group.com</a>" />
          <h2>Alice Shepard</h2>
          <h4 class="text-muted">Directrice Hypnos Brest</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=2">Voir l'établissement &raquo;</a></p>
        </div>

        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-megeve-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Directeur de Megève"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>l.lungfan@hypnos-group.com</a>" />
          <h2>Li Lungfan</h2>
          <h4 class="text-muted">Directeur Hypnos Megève</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=5">Voir l'établissement &raquo;</a></p>
        </div>
      </div>
    
      <div class="row">
        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-cannes-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Directrice de Cannes"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>a.martin@hypnos-group.com</a>" />
          <h2>Anges Martin</h2>
          <h4 class="text-muted">Directrice Hypnos Cannes</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=3">Voir l'établissement &raquo;</a></p>
        </div>

        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-deauville-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Directeur de Deauville"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>e.turpin@hypnos-group.com</a>" />
          <h2>Éric Turpin</h2>
          <h4 class="text-muted">Directeur Hypnos Deauville</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=4">Voir l'établissement &raquo;</a></p>
        </div>

        <div class="col-lg-4">
          <img
          src="images/ceo/ceo-pau-200px.webp"
          class="thumbnail rounded-circle shadow-lg mb-3"
          alt="Directrice de Pau"
          role="button" 
          data-bs-toggle="popover" 
          data-bs-placement="auto" 
          title="Contactez-moi !" 
          data-bs-html="true" 
          data-bs-content="<a href='mailto:#' class='link'>j.hieronimus@hypnos-group.com</a>" />
          <h2>Julie Hieronimus</h2>
          <h4 class="text-muted">Directrice Hypnos Pau</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa dolore consequatur labore dolorem, dicta rerum eum similique ratione nemo.</p>
          <p><a class="btn btn-hypnos mt-auto" href="resort.php?pageid=6">Voir l'établissement &raquo;</a></p>
        </div>
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
    <script src="js/app.js"></script>
    <script src="js/scrollToTop.js"></script>	
    <script src="js/navbar-scrolled.js"></script>
  </body>
</html>