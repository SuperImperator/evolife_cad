<?php

?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['voi'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$voiInfo = getVoiInfo($_GET['voi']);
  $vehicleInfo = getVehicleInfo($voiInfo['vehicle_id']);
?>


<title>EVOLIFE - BOLO (Fahrzeug von Interesse) bearbeiten: <?php echo $vehicleInfo['vehicle']; ?> - <?php echo $vehicleInfo['vrm']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card custom-card">
				<div class="card-header">
					BOLO (Fahrzeug von Interesse) bearbeiten: <?php echo $vehicleInfo['vehicle']; ?> - <?php echo $vehicleInfo['vrm']; ?>
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['updateVoi'])) {
			  	  	updateVoi($_GET['voi'],$_POST['image'],$_POST['reason'],$_POST['notes']);
          ?>
                    <div class="alert alert-success"><b>BOLO Aktualiseriert</b> Der BOLO wurde aktualisiert.</div>
          <?php
						}
					?>
          <?php
            if(isset($_POST['clearVoi'])) {
              clearVoi($_GET['voi']);
          ?>
                    <div class="alert alert-danger"><b>BOLO gelöscht</b> Der BOLO wurde gelöscht.</div>
          <?php
            echo '<meta http-equiv="refresh" content="0; url=intel-vois.php" />';
            }
          ?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?voi=<?php echo $voiInfo['id']; ?>" method="post">
  						<div class="row">
                          <div class="form-group col-md-12">
                              <label for="channel">Beschreibung</label>
                              <input type="text" class="form-control" name="image" value="<?php echo $voiInfo['image']; ?>" required>
                          </div>
	                        <div class="form-group col-md-12">
    	                        <label for="channel">Grund</label>
                              <textarea class="form-control" name="reason" required><?php echo $voiInfo['reason']; ?></textarea>
            	            </div>
                	        <div class="form-group col-md-12">
    	                        <label for="channel">Annmerkungen</label>
        	                    <textarea class="form-control" name="notes" required><?php echo $voiInfo['notes']; ?></textarea>
            	            </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='updateVoi' class="btn btn-success btn-block" value="BOLO-Datensatz aktualisieren">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='clearVoi' class="btn btn-danger btn-block" value="Löschen Sie BOLO">
                        </div>
                      </div>
					</form>
