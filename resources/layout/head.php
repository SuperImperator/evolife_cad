<?php

?>
<?php

session_start();
$session_id = session_id();

// require_once( "./_assets/php/connection.php" );
require("./_assets/php/helper.php");

date_default_timezone_set('America/New_York');

$sessionQuery = $con->query("SELECT id,user_id FROM mdt_sessions WHERE session_id = '{$session_id}'");
$sessionArray = mysqli_fetch_assoc($sessionQuery);

if($sessionQuery->num_rows == 0){
    header("location: login.php");
    exit;
}

$UserArray = getUserInfo($sessionArray['user_id']);

?>
<html>
<head>
	<link rel="stylesheet" href="./_assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./_assets/css/custom.css">
	<link rel="stylesheet" href="./_assets/css/status.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
	<script src="_assets/js/bootstrap.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
	<nav class="navbar main-nav navbar-expand-lg fixed-top">
		<div class="container">
			<button class="navbar-toggler m1-1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
				<span class="navbar-toggler-icon"><i style="margin-top: 5px; color: white;" class="fa fa-list"></i></span>
			</button>
			<button class="navbar-toggler m1-1" type="button">
				<span class="navbar-toggler-icon"><a href="./"><i style="margin-top: 5px; color: white;" class="fa fa-home"></i></a></span>
				<span class="navbar-toggler-icon"><a href="./signOn.php"><i style="margin-top: 5px; color: white;" class="fa fa-user"></i></a></span>
				<span class="navbar-toggler-icon"><a href="./signOut.php"><i style="margin-top: 5px; color: white;" class="fa fa-sign-out-alt"></i></a></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="m1-1 navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="./">DASHBOARD</a>
					</li>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 2);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							DISPATCH
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./control-operator.php">Anruf Übersicht</a>
							<?php
								$permCheck = haveGeneralPerm($UserArray['userid'], 4);
								if($permCheck == true){
							?>
							<a class="dropdown-item" href="./control-dispatcher.php">Anrufe zuweisen</a>
							<?php
								}
							?>
							<?php
								$permCheck = haveGeneralPerm($UserArray['userid'], 8);
								if($permCheck == true){
							?>
							<a class="dropdown-item" href="./control-tacad.php">Anrufe Ablehnen</a>
							<?php
								}
							?>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 16);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							CIVILIAN
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./civilian-civs.php">Zivilisten erstellen</a>
							<a class="dropdown-item" href="./civilian-vehicles.php">Fahrzeug erstellen</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 32);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							BOLO
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./intel-pois.php">Personen von Interesse</a>
							<a class="dropdown-item" href="./intel-vois.php">Fahrzeuge von Interesse</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 64);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							REPORTS
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./cad-reports.php">Senden Sie einen Vorfallbericht</a>
							<a class="dropdown-item" href="./phone999.php">911 Anrufbericht senden</a>
							<a class="dropdown-item" href="./intel-cad-reports.php">Ereignisberichtsprotokoll</a>
							<a class="dropdown-item" href="./cad-history.php">Berichtsprotokoll aufrufen</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 128);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							CAD
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./signOn.php">Go On Duty</a>
							<a class="dropdown-item" href="./pnc-check-search.php">Person Suchen</a>
							<a class="dropdown-item" href="./vrm-check-search.php">Kennzeichen Suchen</a>
						</div>
					</li>
					<?php
						}
					?>
					<?php
						$permCheck = haveGeneralPerm($UserArray['userid'], 256);

						if($permCheck == true){
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							ADMIN
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./manage-users.php">Konten verwalten</a>
							<a class="dropdown-item" href="./newUser.php">Neues Konto erstellen</a>
							<hr>
							<?php
							if(haveGeneralPerm($UserArray['userid'], 1024) == true){
							?>
							<a class="dropdown-item panic" href="./admin-logs.php">Protokolle anzeigen</a>
							<a class="dropdown-item panic" href="./admin-groups.php">Gruppen anzeigen</a>
							<?php
							}
							?>
						</div>
					</li>
					<?php
						}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo strtoupper($UserArray['collar']); ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="./profile.php">Profil</a>
							<a class="dropdown-item" href="./user-settings.php">Einstellungen</a>
							<a class="dropdown-item" href="./signOut.php">Abmelden</a>
						</div>
					</li>
      			</ul>
			</div>
		</div>
	</nav>
