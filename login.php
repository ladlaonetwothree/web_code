<?php
require "config/database.php";require "includes/functions.php";$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){$email=trim($_POST['email']??'');$pass=$_POST['password']??'';$s=$pdo->prepare("SELECT * FROM users WHERE email=?");$s->execute([$email]);$u=$s->fetch();
if($u&&password_verify($pass,$u['password'])){session_regenerate_id(true);$_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']];flash("Welcome back, ".$u['name']."!");header("Location: ".($u['role']==='admin'?"admin/index.php":"dashboard.php"));exit;}else{$error="Incorrect email or password.";}}
$pageTitle="Log in | Careerly";require "includes/header.php";
?>
<section class="auth-section"><div class="auth-card"><div class="auth-icon">✦</div><div class="eyebrow">WELCOME BACK</div><h1>Log in to Careerly</h1><p>Your next opportunity is waiting.</p><?php if($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?><form method="post" class="auth-form"><label>Email address<input type="email" name="email" required placeholder="you@example.com"></label><label>Password<input type="password" name="password" required placeholder="Your password"></label><button class="btn full">Log in →</button></form><p class="auth-switch">New to Careerly? <a href="register.php">Create an account</a></p><div class="demo">Demo admin: admin@careerly.test / admin123</div></div></section>
<?php require "includes/footer.php"; ?>
