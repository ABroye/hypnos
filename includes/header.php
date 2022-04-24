<?php if($_SESSION['login'])
{?>
	<div id="header-top" class="container-fluid p-0 fixed-top">
		<ul class="nav justify-content-between align-items-center bg-dark">
			<li id="account-1" class="nav-item ms-3">
				<a class="nav-link top" href="profile.php">
					Mon Profil
				</a>
			</li>
			<li id="account-1" class="nav-item">
				<a class="nav-link top" href="change-password.php">
					Changer mon mot de passe
				</a>
			</li>
			<li id="account-1" class="nav-item">
				<a class="nav-link top" href="booking-history.php">
					Mes réservations
				</a>
			</li>
			<li id="account-1" class="nav-item">
				<a class="nav-link top" href="tickets.php">
					Mes échanges avec hypnos
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link top active" href="#">
					Bonjour, <?php echo htmlentities($_SESSION['prenom']);?>
				</a>
			</li>				
			<li id="account-1" class="nav-item">
				<a class="nav-link top" href="logout.php" >
					<i class="fa-solid fa-right-from-bracket icon me-3"></i>
				</a>
			</li>
		</ul>
	</div>
	<?php } else {?>
	<div class="container-fluid p-0 fixed-top">
		<ul class="nav d-flex justify-content-end align-items-center bg-dark">
			<li class="nav-item">
				<a class="nav-link top phone" href="tel:+33123456789" >
					<i class="fa-solid fa-mobile-screen-button"></i>
					: +33 (0)1 23 45 67 89
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link top" href="#" data-bs-toggle="modal" data-bs-target="#Modal">
					Devenir client
				</a>
			</li> 
			<li class="nav-item me-3">
				<a class="nav-link top" href="#" data-bs-toggle="modal" data-bs-target="#Modal1">
					Espace clients
				</a>
			</li>
		</ul>
	</div>
	<?php }?>
	<!-- Barre de navigation pour grands écrans fixée en haut -->
<nav id="header" class="navbar navbar-expand-lg navbar-dark fixed-top px-3 py-0 shadow-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <span class="tostada">
				<img
					class="logo"
          src="img/Logo-h-100.png"
          alt="logo hypnos"/>
					hypnos
			</span>
    </a>
    <button
      class="navbar-toggler custom-toggler"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
		<div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">
						Accueil
					</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Les services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">Nos établissements</a>
        </li>
				<li class="nav-item">
          <a class="nav-link" href="suites-list.php">Voir toutes les suites</a>
        </li>
					<?php if($_SESSION['login']){?>
				<li class="nav-item">
					<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#Modal2">Service clients
					</a>
				</li>
					<?php } else { ?>
				<li class="nav-item">
					<a class="nav-link" href="contact.php"> Demande de renseignements</a>
				</li>
				<?php } ?>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="admin/index.php">
					 	Administration
						<i class="fa-solid fa-user-lock ms-2"></i>
				 	</a>
        </li>
      </ul>
    </div>
	</div>
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
			<div class="offcanvas-header">
				<h5 id="offcanvasRightLabel">Navigation</h5>
				<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="link active tostada" aria-current="page" href="index.php">
							Accueil
						</a>
					</li>
					<li><hr class="dropdown-divider"></li>
					<li class="nav-item">
						<a class="link" href="services.php">Les services</a>
					</li>
					<li><hr class="dropdown-divider"></li>
					<li class="nav-item">
						<a class="link" href="about.php">Nos établissements</a>
					</li>
					<li><hr class="dropdown-divider"></li>
					<li class="nav-item">
						<a class="link" href="suites-list.php">Voir toutes les suites</a>
					</li>
					<li><hr class="dropdown-divider"></li>
						<?php if($_SESSION['login']){?>
					<li class="nav-item">
						<a class="link" href="#" data-bs-toggle="modal" data-bs-target="#Modal2">Service clients
						</a>
					</li>
					<li><hr class="dropdown-divider"></li>
						<?php } else { ?>
					<li class="nav-item">
						<a class="link" href="contact.php"> Demande de renseignements</a>
					</li>
					<li><hr class="dropdown-divider"></li>
					<?php } ?>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="link" href="admin/index.php">
							Administration
							<i class="fa-solid fa-user-lock ms-2"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
</nav>
<!-- Slider -->
<div id="carousel" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators d-none">
		<button
			type="button"
			data-bs-target="#carousel"
			data-bs-slide-to="0"
			class="active"
			aria-current="true"
			aria-label="Slide 1"
		></button>
		<button
			type="button"
			data-bs-target="#carousel"
			data-bs-slide-to="1"
			aria-label="Slide 2"
		></button>
		<button
			type="button"
			data-bs-target="#carousel"
			data-bs-slide-to="2"
			aria-label="Slide 3"
		></button>
	</div>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img
				src="images/slider/slide-1.webp"
				class="d-block w-100"
				alt="Slide 1"
			/>
			<div class="carousel-caption d-none d-md-block">
				<h3>Hôtel & Spa</h3>
				<p>Ambiance romantique et féérique pour amoureux.</p>
			</div>
		</div>
		<div class="carousel-item">
			<img
				src="images/slider/slide-2.webp"
				class="d-block w-100"
				alt="Slide 2"
			/>
			<div class="carousel-caption d-none d-md-block">
				<h3>Restaurant Gastronomique</h3>
				<p>
					<img
						class="michelin"
						src="img/star.svg"
						alt="Étoile michelin"
					/>
					Attribution de 4 étoiles au guide Michelin.
				</p>
			</div>
		</div>
		<div class="carousel-item">
			<img
				src="images/slider/slide-3.webp"
				class="d-block w-100"
				alt="Slide 3"
			/>
			<div class="carousel-caption d-none d-md-block">
				<h3>Suites spacieuses et lumineuses</h3>
				<p>Accèdez à un Spa privatif dans chacune de nos suites.</p>
			</div>
		</div>
	</div>
	<button
		class="carousel-control-prev"
		type="button"
		data-bs-target="#carousel"
		data-bs-slide="prev"
	>
		<span
			class="carousel-control-prev-icon d-none d-xl-block d-lg-block"
			aria-hidden="true"
		></span>
		<span class="visually-hidden">Précédent</span>
	</button>
	<button
		class="carousel-control-next"
		type="button"
		data-bs-target="#carousel"
		data-bs-slide="next"
	>
		<span
			class="carousel-control-next-icon d-none d-xl-block d-lg-block"
			aria-hidden="true"
		></span>
		<span class="visually-hidden">Suivant</span>
	</button>
</div><!-- Slider end -->
