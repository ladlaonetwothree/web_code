<?php
require "../config/database.php";require "../includes/functions.php";require_admin();
$id=(int)($_GET['id']??0);$edit=$id>0;$job=['title'=>'','company_id'=>'','location'=>'Lahore, Pakistan','job_type'=>'Full-time','salary'=>'','experience'=>'1-3 years','description'=>'','requirements'=>''];
if($edit){$s=$pdo->prepare("SELECT * FROM jobs WHERE id=?");$s->execute([$id]);$found=$s->fetch();if(!$found){flash("Job not found.","error");header("Location: index.php");exit;}$job=$found;}
$companies=$pdo->query("SELECT id,name FROM companies ORDER BY name")->fetchAll();$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){foreach($job as $k=>$v){$job[$k]=trim($_POST[$k]??'');}
if($job['title']===''||$job['company_id']===''||$job['description']===''){$error="Please complete all required fields.";}else{
if($edit){$sql="UPDATE jobs SET title=?,company_id=?,location=?,job_type=?,salary=?,experience=?,description=?,requirements=? WHERE id=?";$values=[$job['title'],$job['company_id'],$job['location'],$job['job_type'],$job['salary'],$job['experience'],$job['description'],$job['requirements'],$id];}
else{$sql="INSERT INTO jobs(title,company_id,location,job_type,salary,experience,posted_label,description,requirements) VALUES(?,?,?,?,?,?,?,?,?)";$values=[$job['title'],$job['company_id'],$job['location'],$job['job_type'],$job['salary'],$job['experience'],"Just now",$job['description'],$job['requirements']];}
$s=$pdo->prepare($sql);$s->execute($values);flash($edit?"Job updated.":"Job published.");header("Location: index.php");exit;}}
$pageTitle=($edit?"Edit":"Add")." job | Careerly";$linkPrefix="../";$assetPrefix="../";require "../includes/header.php";
?>
<section class="page-hero"><div class="container"><div class="eyebrow">ADMINISTRATION</div><h1><?= $edit?"Edit job":"Publish a job" ?></h1></div></section>
<section class="section"><div class="container form-container"><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><form method="post" class="admin-form">
<label>Job title *<input name="title" required value="<?= e($job['title']) ?>"></label>
<label>Company *<select name="company_id" required><option value="">Choose company</option><?php foreach($companies as $c): ?><option value="<?= (int)$c['id'] ?>" <?= (string)$job['company_id']===(string)$c['id']?'selected':'' ?>><?= e($c['name']) ?></option><?php endforeach; ?></select></label>
<div class="two"><label>Location<input name="location" value="<?= e($job['location']) ?>"></label><label>Job type<select name="job_type"><?php foreach(["Full-time","Part-time","Remote","Contract","Internship"] as $t): ?><option <?= $job['job_type']===$t?'selected':'' ?>><?= e($t) ?></option><?php endforeach; ?></select></label></div>
<div class="two"><label>Salary<input name="salary" value="<?= e($job['salary']) ?>"></label><label>Experience<input name="experience" value="<?= e($job['experience']) ?>"></label></div>
<label>Description *<textarea name="description" rows="6" required><?= e($job['description']) ?></textarea></label>
<label>Requirements <small>Separate each item with | character</small><textarea name="requirements" rows="4"><?= e($job['requirements']) ?></textarea></label>
<div class="form-actions"><a class="btn btn-outline" href="index.php">Cancel</a><button class="btn"><?= $edit?"Save changes":"Publish job" ?></button></div>
</form></div></section><?php require "../includes/footer.php"; ?>
