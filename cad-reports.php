<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 64);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>


<title>EVOLIFE - Vorfallsbericht</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><a href="./cad-history.php" target="_blank" style="position: absolute; right: 10px;">Vergangene Anrufe</a> Vorfallbericht erstellen</div>
				<div class="card-body">
					<?php
						if(isset($_POST['submitCADReport'])) {
                            $incident = $con->escape_string($_POST['incident']);
                            $cad = $con->escape_string($_POST['cad']);
                            $located = $con->escape_string($_POST['located']);
                            $otherUnits = $con->escape_string($_POST['otherUnits']);
                            $arrested = $con->escape_string($_POST['arrested']);
                            $person = $con->escape_string($_POST['person']);
                            $arrestedFor = $con->escape_string($_POST['arrestedFor']);
                            $foundItems = $con->escape_string($_POST['foundItems']);
                            $whatHappened = $con->escape_string($_POST['whatHappened']);
                            createCadReport($UserArray['userid'],$incident,$cad,$located,$otherUnits,$arrested,$person,$arrestedFor,$foundItems,$whatHappened);
                    ?>
                    <div class="alert alert-success"><b>Bericht eingereicht</b> Der Bericht ist jetzt protokolliert und nun zurück zur Arbeit!</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
    						<div class="form-group col-sm-12 col-md-6">
        						<label for="channel">Name</label>
    	       					<input type="text" class="form-control" name="username" value="<?php echo $UserArray['first_name'] . ' ' . $UserArray['surname']; ?>" disabled>
                               <small id="emailHelp" class="form-text text-muted"><I>Dein Name (Automatisch)</I></small>
  				  	       	</div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Benutzername</label>
                                <input type="text" class="form-control" name="collar" value="<?php echo $UserArray['collar']; ?>" disabled>
                               <small id="emailHelp" class="form-text text-muted"><I>Dein Benutzername (Automatisch)</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Um welche Art von Vorfall handelt es sich in diesem Bericht?</label>
                                <input type="text" class="form-control" name="incident">
                                <small id="emailHelp" class="form-text text-muted"><I>An welcher Art von Vorfall haben Sie teilgenommen?</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Was war die Anrufreferenz?</label>
                                <input type="text" class="form-control" name="cad">
                                <small id="emailHelp" class="form-text text-muted"><I>493/23FEB2021</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wer war noch an dem Vorfall beteiligt?</label>
                                <textarea class="form-control" name="otherUnits"></textarea>
                                <small id="emailHelp" class="form-text text-muted"><I>Lieutenant Smith, Officer Jones usw.</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wo haben Sie die Person oder das Fahrzeug gefunden?</label>
                                <textarea class="form-control" name="located"></textarea>
                                <small id="emailHelp" class="form-text text-muted"><I>Strawberry Ave außerhalb von Tesco in Sandy Shores</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wurde eine Person verhaftet?</label>
                                <select class="form-control" name="arrested">
                                    <option value="Yes">JA</option>
                                    <option value="No">NEIN</option>
                                </select>
                                <small id="emailHelp" class="form-text text-muted"><I>Es ist einfach...</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Personeninformation</label>
                                <input type="text" class="form-control" name="person" placeholder="Name, MM/DD/YYYY">
                                <small id="emailHelp" class="form-text text-muted"><I>Martin Braun, 06/28/1990</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wofür wurde die Person verhaftet?</label>
                                <input type="text" class="form-control" name="arrestedFor">
                                <small id="emailHelp" class="form-text text-muted"><I>Raub, betrunkenes Fahren, Verkehrsverstöße usw.</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Was hast du an der Person gefunden?</label>
                                <input type="text" class="form-control" name="foundItems">
                                <small id="emailHelp" class="form-text text-muted"><I>Schlüssel, ID & Geld</I></small>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label for="channel">Sagen Sie kurz, was bei diesem Anruf passiert ist.</label>
                                <textarea class="form-control" name="whatHappened"></textarea>
                                <small id="emailHelp" class="form-text text-muted"><I>"Ja wirklich?" Sie brauchen Hilfe dabei ..</I></small>
                            </div>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='submitCADReport' class="btn btn-success btn-block" value="Vorfallbericht einreichen">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
