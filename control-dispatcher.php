<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 4);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$calls = getActiveCalls('DESC');
	$availableUnits = getAvailableUnits();
?>

<title>EVOLIFE - Anruf Übersicht</title>

<div class="container-fluid" style="margin-top: 25px;">
	<div id="panicSection">
		<?php
		$num = $con->query("SELECT * FROM units WHERE status = 0")->num_rows;

			if($num > 0){

				$unit = mysqli_fetch_assoc($con->query("SELECT * FROM units WHERE status = 0"));
		?>
		<?php
			if(isset($_POST['panicButton' . $unit['unitid']])) {
			  	createPanicButton($unit['unitid']);
			}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="alert alert-danger state0" style="text-align: center;">
					<b>Panic Button Aktivierung durch <?php echo $unit['unit']; ?> (<?php echo $unit['collar']; ?>)</b>
					<br>
					<input type="submit" name='panicButton<?php echo $unit['unitid']; ?>' class="btn state0 btn-block" value="Alamiere alle Einheiten">
				</div>
			</div>
		</div>
		</form>
		<?php
			}
		?>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-7">
			<div class="card custom-card">
				<div class="card-header">
					Aktive Jobs
				</div>
				<table class="table table-responsive-xl" id="refreshDiv">
					<thead class="thead-light">
   						<tr>
   							<th scope="col">Ref.</th>
   							<th scope="col">Prioritätskanal</th>
	     					<th scope="col">Priorität</th>
   							<th scope="col">Beschreibung</th>
   							<th scope="col">Zugewiesen</th>
   							<th scope="col">Ort</th>
   							<th scope="col">Status</th>
 						</tr>
					</thead>
	  				<tbody>
	  					<?php
	  					foreach($calls as $call){
	  						if($call['status'] == 2 || $call['status'] == 3){
	  					?>
    					<tr>
    						<th scope="row"><?php echo $call['callid']; ?></th>
    						<th scope="row"><?php echo $call['channel']; ?></th>
    						<th <?php if(strtoupper($call['police_grade']) == 'GRADE 1' || strtoupper($call['rmu_grade']) == 'CAT 1' || strtoupper($call['rmu_grade']) == 'CAT 2'){ ?>class="text-danger" <?php }else{ ?> class="text-warning" <?php } ?> scope="row"><?php echo $call['police_grade'] . " / " . $call['rmu_grade']; ?></th>
    						<td><?php echo $call['type']; ?></td>
	      					<td><?php foreach($call['units'] as $unit){ echo $unit['unit'] . ", "; } ?></td>
    						<td><?php echo $call['location']; ?></td>
    						<?php if($call['status'] == 3){ ?>
    							<th class="text-success">Versandt</td>
    						<?php }else{ ?>
    							<th class="text-danger">Nicht versandt</td>
    						<?php } ?>
    					</tr>
    					<?php
    						}
    					}
    					?>
  					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card custom-card">
				<div class="card-header">
					<a href="#" onclick="toggleDiv('editCAD')"><i class="fa fa-plus"></i></a>
					Befestigen Sie die Einheit am Bericht
				</div>
				<div class="card-body" id="editCAD" style="display: none;">
					<?php
					if(isset($_POST['updateCall'])) {
			  	  		attachUnitToCall($_POST['cad'], $_POST['unit']);
			  	  		updateCallStatus($_POST['cad'], 3);
					}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Wählen Sie Bericht</label>
    						<div id="cads">
    							<select class="form-control" name="cad">
    								<?php
    								foreach($calls as $call){
    									if($call['status'] == 2 || $call['status'] == 3){
    								?>
    								<option value="<?php echo $call['callid']; ?>"><?php echo $call['callid'] . "/" . $call['dateline'] . " - " . $call['type']; ?></option>
    								<?php
    									}
    								}
    								?>
    							</select>
    						</div>
  						</div>
  						<div class="form-group col-md-12">
    						<label for="channel">Einheit</label>
    						<div id="units">
    							<select class="form-control" name="unit">
    								<?php
    								foreach($availableUnits as $unit){
    								?>
    								<option value="<?php echo $unit['unitid']; ?>"><?php echo $unit['unit']; ?> (<?php echo $unit['collar']; ?>)</option>
    								<?php
    								}
    								?>
    							</select>
    						</div>
  						</div>
  						<div class="form-group col-md-12">
  							<input type="submit" name='updateCall' class="btn btn-success btn-block" value="Einheit Anfügen">
  						</div>
  					</form>
				</div>
			</div>
			<br>
			<div class="card custom-card">
				<div class="card-header">
					Verfügbare Einheiten
				</div>
				<table class="table table-responsive-xl" id="availableUnits">
					<tbody>
						<?php
						foreach($availableUnits as $unit){
						?>
						<tr class="state<?php echo $unit['status']; ?>">
							<td><b><?php echo $unit['unit'] . " - " . $unit['collar'] . " - State " . $unit['status'] . " - Log " . $unit['callid']; ?></b></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php
	foreach($availableUnits as $unit){

	?>
	<div class="modal fade" id="panicButton<?php echo $unit['unitid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content" style="margin-top: 100px;">
      			<div class="modal-header">
        			<h5 class="modal-title" id="panicButton">Panik-Taste</h5>
      			</div>
      			<div class="modal-body">
      				<div class="container">
        				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="form-group" style="width: 100%;">
									<input type="submit" name='dispatchPanic<?php echo $unit['unitid']; ?>' class="btn btn-success btn-block" value="Alamiere alle Einheiten">
           						</div>
           					</div>
						</form>
						<?php
							if(isset($_POST['dispatchPanic'.$unit['unitid']])) {
			  	  				createPanicButton($unit['unitid']);
							}
						?>
					</div>
      			</div>
    		</div>
  		</div>
	</div>
	<?php
	}
	?>

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

function stuff(){
$('#units').load(document.URL +  ' #units');
$('#cads').load(document.URL +  ' #cads');
}

function toggleDiv(div){
	$(`#${div}`).slideToggle();
}

window.setInterval(refreshDiv, 3000);
window.setInterval(availableUnits, 3000);
window.setInterval(panicSection, 3000);
window.setInterval(stuff, 5000);

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
