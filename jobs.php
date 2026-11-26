<?php
require "config/database.php"; require "includes/functions.php";
$q=trim($_GET['q']??''); $loc=trim($_GET['location']??''); $type=trim($_GET['type']??'');
$sql="SELECT j.*,c.name company_name,c.logo_color FROM jobs j JOIN companies c ON c.id=j.company_id WHERE 1=1";$p=[];
if($q!==""){$sql.=" AND (j.title LIKE ? OR j.description LIKE ? OR c.name LIKE ?)";array_push($p,"%$q%","%$q%","%$q%");}
if($loc!==""){$sql.=" AND j.location LIKE ?";$p[]="%$loc%";}
if($type!==""){$sql.=" AND j.job_type=?";$p[]=$type;}
$sql.=" ORDER BY j.id DESC";$s=$pdo->prepare($sql);$s->execute($p);$jobs=$s->fetchAll();
$pageTitle="Find jobs | Careerly";require "includes/header.php";
?>
<section class="page-hero"><div class="container"><div class="eyebrow">FIND YOUR PLACE</div><h1>Explore opportunities</h1><p>Find the role that fits your ambition.</p></div></section>
<section class="section"><div class="container"><form class="filters" method="get"><input name="q" value="<?= e($q) ?>" placeholder="Job title or company"><input name="location" value="<?= e($loc) ?>" placeholder="Location"><select name="type"><option value="">All job types</option><?php foreach(["Full-time","Part-time","Remote","Contract","Internship"] as $t): ?><option <?= $type===$t?'selected':'' ?>><?= e($t) ?></option><?php endforeach; ?></select><button class="btn">Search</button></form>
<div class="section-head compact"><h2><?= count($jobs) ?> jobs found</h2><span class="muted">Latest opportunities</span></div>
<?php if(!$jobs): ?><div class="empty"><h3>No jobs found</h3><p>Try changing your search filters.</p><a class="btn btn-outline" href="jobs.php">Clear filters</a></div><?php else: ?><div class="job-grid"><?php foreach($jobs as $j): ?><article class="job-card"><div class="job-top"><div class="company-logo" style="background:<?= e($j['logo_color']) ?>"><?= e(substr($j['company_name'],0,1)) ?></div><span class="tag"><?= e($j['job_type']) ?></span></div><h3><a href="job-details.php?id=<?= (int)$j['id'] ?>"><?= e($j['title']) ?></a></h3><p class="muted"><?= e($j['company_name']) ?></p><div class="job-meta"><span>⌖ <?= e($j['location']) ?></span><span><?= e($j['salary']) ?></span></div><div class="job-bottom"><small><?= e($j['posted_label']) ?></small><a href="job-details.php?id=<?= (int)$j['id'] ?>">View job →</a></div></article><?php endforeach; ?></div><?php endif; ?>
</div></section><?php require "includes/footer.php"; ?>
