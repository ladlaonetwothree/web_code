<?php
require "../config/database.php";require "../includes/functions.php";require_admin();
if(isset($_GET['delete'])){$s=$pdo->prepare("DELETE FROM jobs WHERE id=?");$s->execute([(int)$_GET['delete']]);flash("Job deleted.");header("Location: index.php");exit;}
$jobs=$pdo->query("SELECT j.*,c.name company_name FROM jobs j JOIN companies c ON c.id=j.company_id ORDER BY j.id DESC")->fetchAll();
$pageTitle="Admin panel | Careerly";$linkPrefix="../";$assetPrefix="../";require "../includes/header.php";
?>
<section class="page-hero"><div class="container"><div class="eyebrow">ADMINISTRATION</div><h1>Manage job listings</h1><p>Create, update and remove job posts.</p></div></section>
<section class="section"><div class="container"><div class="section-head"><h2>All jobs (<?= count($jobs) ?>)</h2><a class="btn" href="job-form.php">+ Add a job</a></div><div class="table-wrap"><table><thead><tr><th>Job</th><th>Company</th><th>Location</th><th>Type</th><th>Actions</th></tr></thead><tbody><?php foreach($jobs as $j): ?><tr><td><?= e($j['title']) ?></td><td><?= e($j['company_name']) ?></td><td><?= e($j['location']) ?></td><td><?= e($j['job_type']) ?></td><td><a href="job-form.php?id=<?= (int)$j['id'] ?>">Edit</a> · <a class="danger" onclick="return confirm('Delete this job?')" href="index.php?delete=<?= (int)$j['id'] ?>">Delete</a></td></tr><?php endforeach; ?></tbody></table></div></div></section>
<?php require "../includes/footer.php"; ?>
