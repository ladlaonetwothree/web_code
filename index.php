<?php
require "config/database.php"; require "includes/functions.php";
$jobs=$pdo->query("SELECT j.*,c.name company_name,c.logo_color FROM jobs j JOIN companies c ON c.id=j.company_id ORDER BY j.id DESC LIMIT 6")->fetchAll();
$companies=$pdo->query("SELECT * FROM companies ORDER BY name LIMIT 6")->fetchAll();
$pageTitle="Careerly | Find your next opportunity"; require "includes/header.php";
?>
<section class="hero"><div class="container hero-grid"><div>
<div class="eyebrow">✦ &nbsp; YOUR NEXT CHAPTER STARTS HERE</div>
<h1>Find a job that<br><span>moves you forward.</span></h1>
<p class="lead">Discover roles from ambitious teams. Your skills deserve the right opportunity.</p>
<form class="search" action="jobs.php" method="get">
<input name="q" placeholder="Job title, skill or company">
<input name="location" placeholder="City or remote">
<button class="btn">Search jobs →</button></form>
<div class="popular">Popular: <a href="jobs.php?q=Developer">Developer</a><a href="jobs.php?q=Designer">Designer</a><a href="jobs.php?q=Marketing">Marketing</a></div>
</div><div class="hero-art"><div class="art-circle"></div><div class="art-card"><div class="art-top"><b>✦</b><span>HIRING NOW</span></div><div class="illustration"><div class="person"></div><div class="plant"></div></div><h3>Your next big move.</h3><p>Great teams are waiting.</p></div><div class="float-card">↗ <div><b>2,450+</b><small>New opportunities</small></div></div><div class="float-card second">☺ <div><b>10k+ people</b><small>found their fit</small></div></div></div>
</div></section>
<section class="trust"><div class="container trust-row"><span>TEAMS YOU CAN EXPLORE</span><?php foreach($companies as $c): ?><b><?= e($c['name']) ?></b><?php endforeach; ?></div></section>
<section class="section"><div class="container"><div class="section-head"><div><div class="eyebrow">OPPORTUNITIES FOR YOU</div><h2>Explore latest jobs</h2><p>Hand-picked roles from teams that are growing.</p></div><a class="text-link" href="jobs.php">View all jobs →</a></div>
<div class="job-grid"><?php foreach($jobs as $j): ?><article class="job-card"><div class="job-top"><div class="company-logo" style="background:<?= e($j['logo_color']) ?>"><?= e(substr($j['company_name'],0,1)) ?></div><span class="tag"><?= e($j['job_type']) ?></span></div><h3><a href="job-details.php?id=<?= (int)$j['id'] ?>"><?= e($j['title']) ?></a></h3><p class="muted"><?= e($j['company_name']) ?></p><div class="job-meta"><span>⌖ <?= e($j['location']) ?></span><span><?= e($j['salary']) ?></span></div><div class="job-bottom"><small><?= e($j['posted_label']) ?></small><a href="job-details.php?id=<?= (int)$j['id'] ?>">Details →</a></div></article><?php endforeach; ?></div></div></section>
<section class="cta"><div class="container cta-inner"><div><div class="eyebrow light">FOR JOB SEEKERS</div><h2>Your next opportunity<br>is one click away.</h2><p>Create a free profile and make your next move count.</p><a class="btn btn-white" href="register.php">Get started →</a></div><div class="cta-star">✳</div></div></section>
<?php require "includes/footer.php"; ?>
