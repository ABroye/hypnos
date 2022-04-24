<?php if($_SESSION['login']){?>
<div id="account" class="container-fluid py-2 bg-dark fixed-bottom">
	<ul class="nav justify-content-between align-items-center bg-dark p-0 m-0">
		<li class="nav-item ms-3">
			<a class="nav-link" href="profile.php">
				<i class="fa-solid fa-user icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="change-password.php">
				<i class="fa-solid fa-key icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="booking-history.php">
				<i class="fa-solid fa-calendar-days icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="tickets.php">
				<i class="fa-solid fa-envelope-open-text icon"></i>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="logout.php">
				<i class="fa-solid fa-right-from-bracket icon me-3"></i>
			</a>
		</li>
	</ul>
</div>
<?php } else { ?>
<?php } ?>