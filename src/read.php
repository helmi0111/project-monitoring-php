<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM monitoring ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$monitorings = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_monitorings = $pdo->query('SELECT COUNT(*) FROM monitoring')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
    <div class="py-3">
        <a href='create.php' class="btn btn-primary">+ Add Data</a>
    </div>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>PROJECT NAME</td>
                <td>CLIENT</td>
                <td>PROJECT LEADER</td>
                <td>START DATE</td>
                <td>END DATE</td>
                <td>PROGRESS</td>
                <td>ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($monitorings as $monitoring): ?>
            <tr>
                <td><?=$monitoring['id']?></td>
                <td><?=$monitoring['project_name']?></td>
                <td><?=$monitoring['client']?></td>
                <td>
                    <div>
                        <div class="fw-bold">
                            <?=$monitoring['project_leader_name']?>
                        </div>
                        <div>
                            <?=$monitoring['project_leader_email']?>
                        </div>
                    </div>
                </td>
                <td><?=date('d M Y', strtotime($monitoring['start_date']))?></td>
                <td><?=date('d M Y', strtotime($monitoring['end_date']))?></td>
                <td>
                    <div>
                        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?=$monitoring['progress']?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: <?=$monitoring['progress']?>%"><?=$monitoring['progress']?>%</div>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="update.php?id=<?=$monitoring['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$monitoring['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_monitorings): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
    <p class="d-flex justify-content-end">Created by:</p>
    <p class="d-flex justify-content-end fw-bold">Muhammad Helmi</p>
</div>

<?=template_footer()?>