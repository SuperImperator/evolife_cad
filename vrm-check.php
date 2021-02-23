<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 2);

if($permCheck == false OR !isset($_GET['vid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	 $vehicleInfo = getVehicleInfo($_GET['vid']);
?>


<title>EVOLIFE - Kennzeichensuche: <?php echo $vehicleInfo['vrm']; ?></title>


<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Kennzeichensuche: <?php echo $vehicleInfo['vrm']; ?>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="channel">Fahrzeugmodell</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $vehicleInfo['vehicle']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Vorstrafenregister</label>
                                <input type="text" class="form-control" name="insurer" value="<?php echo $vehicleInfo['markers']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="channel">Kennzeichen</label>
                                <input type="text" class="form-control" name="vrm" value="<?php echo $vehicleInfo['vrm']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="channel">Besitzer</label>
                                <input type="text" class="form-control" name="vrm" value="<?php if($vehicleInfo['owner'] == 0) { echo "Nicht verkauft"; }else{ echo getVehicleOwner($vehicleInfo['owner'])['name'];  } ?>" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="channel">Status</label>
                                <input type="text" class="form-control" name="insurer" value="<?php echo $vehicleInfo['status']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="channel">Lizensierter Fahrer</label>
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <?php
                                        $drivers = getAllowedDriversForVehicle($vehicleInfo['vehicleid']);

                                        foreach($drivers as $driver){
                                        ?>
                                        <a href="./vrm-check.php?vid=<?php echo $driver['civid']; ?>"><?php echo $driver['name']; ?></a><br>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
