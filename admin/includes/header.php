  <header>
    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark bg-gold px-3 shadow-lg">
      <div class="container-fluid">
        <img src="img/Logo-h-100-w.png" width="auto" height="28" alt="Logo hypnos" class="logo">
          <a class="navbar-brand tostada text-white" href="#">hypnos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Accueil</a>
            </li>

            <?php if($_SESSION['role'] == 'admin'){ ?>
            <li class="nav-item">
              <a class="nav-link" href="manage-pages.php">Gestion des informations légales</a>
            </li>
            <?php } ?>

          </ul>
          <div class="admin me-4 d-none d-xl-block d-lg-block d-md-block">
            <p class="text-white admin d-none d-xl-block d-lg-block d-md-block">Bonjour, <span><?php echo htmlspecialchars($_SESSION["alogin"]); ?></span></p>
          </div>
          <div id="profile" class="dropdown dropstart">
            <a href="#" class="link-light text-decoration-none dropdown-toggle" id="dropdownAdmin" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="img/user.png" alt="User" width="48" height="48" class="rounded-circle border shadow me-3">
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownAdmin">
              <li><a class="dropdown-item" href="change-password.php">Mot de passe <i class="fa-solid fa-key"></i></a></li>
              <li><a class="dropdown-item" href="logout.php">Déconnexion <i class="fa-solid fa-right-from-bracket ms-1"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>