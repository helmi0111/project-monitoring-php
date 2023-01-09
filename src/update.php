<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
      
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';
        $client = isset($_POST['client']) ? $_POST['client'] : '';
        $project_leader_name = isset($_POST['project_leader_name']) ? $_POST['project_leader_name'] : '';
        $project_leader_email = isset($_POST['project_leader_email']) ? $_POST['project_leader_email'] : '';
        $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
        $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
        $progress = isset($_POST['progress']) ? $_POST['progress'] : '';
            
       
        $stmt = $pdo->prepare('UPDATE monitoring SET id = ?, project_name = ?, client = ?, project_leader_name = ?, project_leader_email = ?, start_date = ?, end_date = ?, progress = ? WHERE id = ?');
        $stmt->execute([$id, $project_name, $client, $project_leader_name, $project_leader_email, $start_date, $end_date, $progress, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
   
    $stmt = $pdo->prepare('SELECT * FROM monitoring WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $monitoring = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$monitoring) {
        exit('monitoring doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="container my-3 p-3 bg-body rounded shadow-sm">
	<h2>Update data #<?=$monitoring['id']?></h2>
    <form action="update.php?id=<?=$monitoring['id']?>" method="post">
    <div class="mb-3 row">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value='<?=$monitoring['id']?>' name='id' id="id">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project_name" class="col-sm-2 col-form-label">PROJECT NAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='project_name' value="<?=$monitoring['project_name']?>" id="project_name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="client" class="col-sm-2 col-form-label">CLIENT</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='client' value="<?=$monitoring['client']?>" id="client">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project_leader_name" class="col-sm-2 col-form-label">PROJECT LEADER NAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='project_leader_name' value="<?=$monitoring['project_leader_name']?>" id="project_leader_name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project_leader_email" class="col-sm-2 col-form-label">PROJECT LEADER EMAIL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='project_leader_email' value="<?=$monitoring['project_leader_email']?>" id="project_leader_email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="start_date" class="col-sm-2 col-form-label">START DATE</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='start_date' value="<?=$monitoring['start_date']?>" id="start_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="end_date" class="col-sm-2 col-form-label">END DATE</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='end_date' value="<?=$monitoring['end_date']?>" id="end_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="progress" class="col-sm-2 col-form-label">PROGRESS (%)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='progress' value="<?=$monitoring['progress']?>" id="progress">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="save_button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" value="Update" name="update_button">UPDATE</button></div>
        </div>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>