<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 32);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$vois = getVois();
?>


<title>EVOLIFE - BOLO (Fahrzeuge von Interesse)</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-9">
			<div class="card custom-card">
				<div class="card-header">
					BOLO (Fahrzeuge von Interesse)
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Referenz</th>
   							<th scope="col">Modell</th>
	     					<th scope="col">Kennzeichen</th>
   							<th scope="col">Beschreibung</th>
   							<th scope="col">Grund</th>
   							<th scope="col">Annmerkungen</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($vois as $voi){

	  						$vehicleInfo = getVehicleInfo($voi['vehicle_id']);
	  					?>
    					<tr>
    						<th scope="row"><?php echo $voi['id']; ?> <a href="./intel-vois-edit.php?voi=<?php echo $voi['id']; ?>"><i class="fa fa-pencil-alt"></i></a></th>
    						<th><?php echo $vehicleInfo['vehicle']; ?></th>
    						<th><?php echo $vehicleInfo['vrm']; ?></th>
    						<td><?php echo $voi['image']; ?></td>
	      					<td><?php echo $voi['reason']; ?></td>
	      					<td><?php echo $voi['notes']; ?></td>
    					</tr>
    					<?php
    					}
    					?>
  					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card custom-card">
				<div class="card-header">
					BOLO (Fahrzeuge von Interesse) hinzufügen
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createVoi'])) {
			  	  			createVoi($_POST['vehicle'],$_POST['image'],$_POST['reason'],$_POST['notes']);
                    ?>
                    <div class="alert alert-success"><b>BOLO erstellt.</b> Dieser BOLO wurde erstellt und ist einsatzbereit.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
                            <label for="channel">Fahrzeug</label>
                            <select name="vehicle" class="form-control">
                                <?php
                                $vehicles = getVehicles();

                                foreach($vehicles as $vehicle){
                                ?>
                                <option value="<?php echo $vehicle['vehicleid']; ?>"><?php echo $vehicle['vehicle']; ?> - <?php echo $vehicle['vrm']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Beschreibung</label>
                            <input type="text" class="form-control" name="image">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Grund</label>
                            <input type="text" class="form-control" name="reason">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Annmerkungen</label>
                            <input type="text" class="form-control" name="notes">
                        </div>
  						<div class="form-group col-md-12">
							<input type="submit" name='createVoi' class="btn btn-success btn-block" value="Erstellen Sie BOLO">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script>
function refreshDiv() {

    $('#refreshDiv').load(document.URL +  ' #refreshDiv');

}

function availableUnits(){
	$('#availableUnits').load(document.URL +  ' #availableUnits');
}

function panicSection(){
	$('#panicSection').load(document.URL +  ' #panicSection');
}

window.setInterval(refreshDiv, 1000);
window.setInterval(availableUnits, 1000);
window.setInterval(panicSection, 1000);
</script>
