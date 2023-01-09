<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';
    $client = isset($_POST['client']) ? $_POST['client'] : '';
    $project_leader_name = isset($_POST['project_leader_name']) ? $_POST['project_leader_name'] : '';
    $project_leader_email = isset($_POST['project_leader_email']) ? $_POST['project_leader_email'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
    $progress = isset($_POST['progress']) ? $_POST['progress'] : '';

    
    $stmt = $pdo->prepare('INSERT INTO monitoring VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $project_name, $client, $project_leader_name, $project_leader_email, $start_date, $end_date, $progress]);
    
    $msg = 'Added Successfully!';
}
?>

<?=template_header('Create')?>

<div class="container my-3 p-3 bg-body rounded shadow-sm">
	<h2>Add Data</h2>
    <form enctype="multipart/form-data" action="create.php" method="post">
    <div class="mb-3 row">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value='Auto' name='id' id="id">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project_name" class="col-sm-2 col-form-label">PROJECT NAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='project_name' id="project_name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="client" class="col-sm-2 col-form-label">CLIENT</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='client' id="client">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project_leader_name" class="col-sm-2 col-form-label">PROJECT LEADER NAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='project_leader_name' id="project_leader_name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="project_leader_email" class="col-sm-2 col-form-label">PROJECT LEADER EMAIL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='project_leader_email' id="project_leader_email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="start_date" class="col-sm-2 col-form-label">START DATE</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='start_date' id="start_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="end_date" class="col-sm-2 col-form-label">END DATE</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='end_date' id="end_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="progress" class="col-sm-2 col-form-label">PROGRESS (%)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='progress' id="progress">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="save_button" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="save_button">SAVE</button></div>
        </div>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>