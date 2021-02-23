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


<title>EVOLIFE - Lizenzierte Fahrer bearbeiten <?php echo $vehicleInfo['vrm']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Lizenzierte Fahrer bearbeiten: <?php echo $vehicleInfo['vrm']; ?>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST['updateAllowed'])) {

                            $query    = $con->query( "SELECT * FROM civilians" );
                            $civs = '';

                            while( $array = mysqli_fetch_assoc($query) ) {

                                if( isset($_POST['civ-' . $array['civid']]) ) {

                                    $civs .= $array['civid'] . ",";

                                }
                            }

                            $query = $con->query("UPDATE owned_vehicles SET registered_drivers = '{$civs}' WHERE vehicleid = '{$_GET['vid']}'");
                    ?>
                        <div class="alert alert-success"><b>Fahrzeug aktualisiert</b> Das Fahrzeug wurde aktualisiert.</div>
                    <?php
                    echo '<meta http-equiv="refresh" content="0; url=civilian-vehicles.php" />';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?vid=<?php echo $vehicleInfo['vehicleid']; ?>" method="post">
                        <?php
                            $civilians = getCivs();
                            foreach($civilians as $civilian){
                        ?>
                        <input type="checkbox" name="civ-<?php echo $civilian['civid']; ?>" value="<?php echo $civilian['civid']; ?>" class="usergroupscheck" <?php if(isAllowedToDriver($vehicleInfo['vehicleid'],$civilian['civid']) == true){ ?> checked="" <?php } ?> /> <?php echo $civilian['name']; ?> <br />
                        <?php
                            }
                        ?><br>
                        <div class="form-group" style="width: 100%;">
                            <input type="submit" name='updateAllowed' class="btn btn-success btn-block" value="Zulässige Fahrer aktualisieren">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
