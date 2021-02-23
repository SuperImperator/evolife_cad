<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 32);

if($permCheck == false OR !isset($_GET['rid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}

$reportInfo = getReportInfo($_GET['rid']);
?>


<title>EVOLIFE - Zeige Bericht</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><a class="text-dark" href="./intel-cad-reports.php"><i class="fa fa-undo"></i></a> Ereignisbericht anzeigen: <?php echo $reportInfo['cad']; ?></div>
				<div class="card-body">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
    						<div class="form-group col-sm-12 col-md-6">
        						<label for="channel">Name</label>
    	       					<input type="text" class="form-control" name="username" value="<?php echo getUserInfo($reportInfo['user'])['first_name'] . " " . getUserInfo($reportInfo['user'])['surname']; ?>" disabled>
  				  	       	</div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Benutzername</label>
                                <input type="text" class="form-control" name="collar" value="<?php echo getUserInfo($reportInfo['user'])['collar']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Um welche Art von Vorfall handelt es sich in diesem Bericht?</label>
                                <input type="text" class="form-control" name="incident" value="<?php echo $reportInfo['incident']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Was war die Anrufreferenz?</label>
                                <input type="text" class="form-control" name="cad" value="<?php echo $reportInfo['cad']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wer war noch an dem Vorfall beteiligt?</label>
                                <textarea class="form-control" name="otherUnits" disabled><?php echo $reportInfo['otherUnits']; ?></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wo haben Sie die Person oder das Fahrzeug gefunden?</label>
                                <textarea class="form-control" name="located" disabled><?php echo $reportInfo['located']; ?></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wurde eine Person verhaftet?</label>
                                <input type="text" class="form-control" name="arrestedFor" value="<?php echo $reportInfo['arrested']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Personeninformation</label>
                                <input type="text" class="form-control" name="person" value="<?php echo $reportInfo['person']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Wofür wurde die Person verhaftet?</label>
                                <input type="text" class="form-control" name="arrestedFor" value="<?php echo $reportInfo['arrestedFor']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="channel">Was hast du an der Person gefunden?</label>
                                <input type="text" class="form-control" name="foundItems" value="<?php echo $reportInfo['foundItems']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label for="channel">Sagen Sie kurz, was bei diesem Anruf passiert ist.</label>
                                <textarea class="form-control" name="whatHappened" disabled><?php echo $reportInfo['whatHappened']; ?></textarea>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
