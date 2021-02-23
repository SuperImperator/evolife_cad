<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);
$permCheck2 = haveGeneralPerm($UserArray['userid'], 2);

if($permCheck == false && $permCheck2 == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>


<title>EVOLIFE - Erstellen Sie einen Notruf</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Erstellen Sie einen Notrufbericht</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createCall'])) {
                            $location = $con->escape_string($_POST['location']);
                            $description = $con->escape_string($_POST['description']);
			  	  			createCall($UserArray['userid'],$_POST['type'],$location,$_POST['civilian'],$description);
                    ?>
                    <div class="alert alert-success"><b>Anruf gesendet</b> Der Anruf wurde an DISPATCH gesendet.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Anrufart</label>
                            <select class="form-control" name="type">
                                <option value="CRIME">KRIMINALITÄT</option>
                                <option value="TRAFFIC">VERKEHR</option>
                                <option value="MISCELLANEOUS">VERSCHIEDENES</option>
                                <option value="AMBULANCE">KRANKENWAGEN</option>
                                <option value="FIRE SERVICE">FEUERWEHR</option>
                            </select>
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">Ort</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Anrufer</label>
                            <select name="civilian" class="form-control">
                                <option value="0">Anonym</option>
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
                        <div class="form-group col-md-12">
                            <label for="channel">Beschreibung</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='createCall' class="btn btn-success btn-block" value="Anruf erstellen">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
