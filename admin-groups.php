<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 1024);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
    $groups = getUserGroups();
?>

<title>EVOLIFE - Benutzergruppen Verwalten</title>

<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Admin Protokoll
                </div>
                <table class="table table-responsive-xl" id="refreshDiv">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Referenz</th>
                            <th scope="col">Name</th>
                            <th scope="col">Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($groups as $group){
                        ?>
                        <tr>
                            <th scope="row"><?php echo $group['id']; ?></th>
                            <th scope="row"><?php echo $group['name']; ?></th>
                            <td><a href="admin-groups-edit.php?gid=<?php echo $group['id']; ?>">Gruppe Bearbeiten</a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
