<?php
require "config/database.php";require "includes/functions.php";$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){$name=trim($_POST['name']??'');$email=trim($_POST['email']??'');$pass=$_POST['password']??'';
if($name===""||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pass)<6){$error="Enter a valid name/email and a password of at least 6 characters.";}
else{$s=$pdo->prepare("SELECT id FROM users WHERE email=?");$s->execute([$email]);if($s->fetch()){$error="This email is already registered.";}else{$s=$pdo->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");$s->execute([$name,$email,password_hash($pass,PASSWORD_DEFAULT)]);$_SESSION['user']=['id'=>$pdo->lastInsertId(),'name'=>$name,'email'=>$email,'role'=>'candidate'];flash("Account created successfully!");header("Location: dashboard.php");exit;}}}
$pageTitle="Create account | Careerly";require "includes/header.php";
?>
<section class="auth-section"><div class="auth-card"><div class="auth-icon">✦</div><div class="eyebrow">START YOUR JOURNEY</div><h1>Create your account</h1><p>Join Careerly and find your next opportunity.</p><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><form method="post" class="auth-form"><label>Full name<input name="name" required placeholder="Your full name" value="<?= e($_POST['name']??'') ?>"></label><label>Email address<input type="email" name="email" required placeholder="you@example.com" value="<?= e($_POST['email']??'') ?>"></label><label>Password<input type="password" name="password" minlength="6" required placeholder="At least 6 characters"></label><button class="btn full">Create account →</button></form><p class="auth-switch">Already registered? <a href="login.php">Log in</a></p></div></section>
<?php require "includes/footer.php"; ?>
