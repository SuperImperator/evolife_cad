<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 256);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}

	//if(!isset($_GET['uid'])){
	//	echo '<meta http-equiv="refresh" content="0; url=error.php" />';
	//}

?>

<title>EVOLIFE - Neuer Benutzer</title>

	<div class="container" style="margin-top: 25px;">
		<?php
			if(isset($_POST['createUser'])) {
				$groups = getUserGroups();
				$ugroups = '';
				foreach($groups as $group){

					if( isset($_POST['ugroup-' . $group['id']]) ) {

						$ugroups .= $group['id'] . ",";
					}
				}
				$steamid = $con->escape_string($_POST['steamid']);
				createUser($UserArray['userid'],$_POST['firstname'],$_POST['surname'],$_POST['email'],$_POST['steamid'],$_POST['collar'],$_POST['password'],$ugroups);
			?>
			<div class="alert alert-success" role="alert"><b>Benutzer aktualisiert</b> Dieser Benutzer wurde aktualisiert.</div>
			<?php
			}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="card custom-card">
						<div class="card-header">
							Erstellen Sie einen neuen Benutzer
						</div>
						<div class="card-body">
							<div class="row">
                            	<div class="form-group col-md-6">
                                	<label for="channel">Vorname</label>
                                	<input type="text" class="form-control" name="firstname" required>
                            	</div>
                            	<div class="form-group col-md-6">
                                	<label for="channel">Nachname</label>
                                	<input type="text" class="form-control" name="surname" required>
                            	</div>
                            	<div class="form-group col-md-12">
                                	<label for="channel">Steamid</label>
                                	<input type="text" class="form-control" name="steamid">
                            	</div>
                            	<div class="form-group col-md-12">
                                	<label for="channel">Email</label>
                                	<input type="email" class="form-control" name="email" required>
                            	</div>
                            	<div class="form-group col-md-12">
                                	<label for="channel">Benutzername</label>
                                	<input type="text" class="form-control" name="collar" required>
                            	</div>
                            	<div class="form-group col-md-12">
                                	<label for="channel">Passwort</label>
                                	<input type="password" class="form-control" name="password" required>
                            	</div>
                            </div>
						</div>
					</div>
					<br>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="card custom-card">
						<div class="card-header">
							Benutzergruppen
						</div>
						<div class="card-body">
							<div class="row">
								<div class="form-group col-md-12">
									<?php
										$groups = getUserGroups();
										foreach($groups as $group){
									?>
									<input type="checkbox" name="ugroup-<?php echo $group['id']; ?>" value="<?php echo $group['id']; ?>" class="usergroupscheck" /> <?php echo $group['name']; ?> <br />
									<?php
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="col-md-12"><br>
					<div class="card custom-card">
						<div class="card-body">
							<div class="form-group" style="width: 100%;">
            	           	    <input type="submit" name='createUser' class="btn btn-success btn-block" value="Benutzer erstellen">
                	        </div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
