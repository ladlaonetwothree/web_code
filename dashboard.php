<?php
require "config/database.php";require "includes/functions.php";require_login();
$s=$pdo->prepare("SELECT a.*,j.title,j.location,c.name company_name FROM applications a JOIN jobs j ON j.id=a.job_id JOIN companies c ON c.id=j.company_id WHERE a.user_id=? ORDER BY a.applied_at DESC");$s->execute([$_SESSION['user']['id']]);$apps=$s->fetchAll();
$pageTitle="My dashboard | Careerly";require "includes/header.php";
?>
<section class="page-hero"><div class="container"><div class="eyebrow">YOUR CAREER SPACE</div><h1>Welcome, <?= e($_SESSION['user']['name']) ?> 👋</h1><p>Track your applications and discover what's next.</p></div></section>
<section class="section"><div class="container"><div class="section-head"><div><h2>My applications</h2><p>Your submitted applications in one place.</p></div><a class="btn" href="jobs.php">Explore jobs →</a></div>
<?php if(!$apps): ?><div class="empty"><h3>No applications yet</h3><p>When you apply for a role, it will appear here.</p><a class="btn" href="jobs.php">Find a job</a></div><?php else: ?><div class="application-list"><?php foreach($apps as $a): ?><div class="application"><div><b><?= e($a['title']) ?></b><p><?= e($a['company_name']) ?> · <?= e($a['location']) ?></p></div><span class="status"><?= e(ucfirst($a['status'])) ?></span><small><?= date("M j, Y",strtotime($a['applied_at'])) ?></small></div><?php endforeach; ?></div><?php endif; ?></div></section>
<?php require "includes/footer.php"; ?>
