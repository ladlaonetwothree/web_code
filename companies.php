<?php
require "config/database.php";require "includes/functions.php";
$companies=$pdo->query("SELECT c.*,COUNT(j.id) jobs_count FROM companies c LEFT JOIN jobs j ON j.company_id=c.id GROUP BY c.id ORDER BY c.name")->fetchAll();
$pageTitle="Companies | Careerly";require "includes/header.php";
?>
<section class="page-hero"><div class="container"><div class="eyebrow">MEET THE TEAMS</div><h1>Discover great companies</h1><p>Get to know the teams behind your next opportunity.</p></div></section>
<section class="section"><div class="container company-grid"><?php foreach($companies as $c): ?><article class="company-card"><div class="company-logo large" style="background:<?= e($c['logo_color']) ?>"><?= e(substr($c['name'],0,1)) ?></div><h3><?= e($c['name']) ?></h3><p><?= e($c['industry']) ?></p><div class="job-bottom"><small><?= (int)$c['jobs_count'] ?> open positions</small><a href="jobs.php?q=<?= urlencode($c['name']) ?>">View jobs →</a></div></article><?php endforeach; ?></div></section>
<?php require "includes/footer.php"; ?>
