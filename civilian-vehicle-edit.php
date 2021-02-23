<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['vid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	 $vehicleInfo = getVehicleInfo($_GET['vid']);
?>


<title>EVOLIFE - Fahrzeug bearbeiten: <?php echo $vehicleInfo['vrm']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Fahrzeug bearbeiten: <?php echo $vehicleInfo['vrm']; ?>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST['updateVehicle'])) {
                            updateVehicle($vehicleInfo['vehicleid'], $_POST['name'], $_POST['vrm'], $_POST['status'], $_POST['owner'], $_POST['insurer'], $_POST['markers']);
                    ?>
                        <div class="alert alert-success"><b>Fahrzeug aktualisiert</b> Das Fahrzeug wurde aktualisiert.</div>
                    <?php
                    echo '<meta http-equiv="refresh" content="0; url=civilian-vehicles.php" />';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?vid=<?php echo $vehicleInfo['vehicleid']; ?>" method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="channel">Fahrzeugtyp</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $vehicleInfo['vehicle']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Kennzeichen</label>
                                <input type="text" class="form-control" name="vrm" value="<?php echo $vehicleInfo['vrm']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Abdeckung</label>
                                <select name="status" class="form-control">
                                    <option value="<?php echo $vehicleInfo['status']; ?>"><?php echo $vehicleInfo['status']; ?></option>
                                    <option value="Insured">Versichert</option>
                                    <option value="Stolen">Gestohlen</option>
                                    <option value="Uninsured">Unversichert</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Inhaber</label>
                                <select name="owner" class="form-control">
                                    <option value="<?php echo getVehicleOwner($vehicleInfo['owner'])['civid']; ?>"><?php echo getVehicleOwner($vehicleInfo['owner'])['name']; ?></option>
                                    <?php
                                    $civs = getCivs();

                                    foreach($civs as $civ){
                                    ?>
                                    <option value="<?php echo $civ['civid']; ?>"><?php echo $civ['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Versicherer</label>
                                <input type="text" class="form-control" name="insurer" value="<?php echo $vehicleInfo['insurer']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Stichworte</label>
                                <select class="form-control" name="markers" value="<?php echo $vehicleInfo['markers']; ?>" required>
								<option value="Expired">Abgelaufen</option>
								<option value="Not Expired">Nicht abgelaufen</option>
								</select>
                            </div>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input type="submit" name='updateVehicle' class="btn btn-success btn-block" value="Fahrzeug aktualisieren">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
