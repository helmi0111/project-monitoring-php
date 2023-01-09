<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM monitoring WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $monitoring = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$monitoring) {
        exit('monitoring doesn\'t exist with that ID!');
    }
    
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            
            $stmt = $pdo->prepare('DELETE FROM monitoring WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted data!';
        } else {
            
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete data #<?=$monitoring['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete data #<?=$monitoring['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$monitoring['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$monitoring['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>