<?php
require_once __DIR__ . "/functions.php";
$pageTitle = $pageTitle ?? "Careerly | Find your next opportunity";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $assetPrefix ?? '' ?>assets/css/style.css">
</head>
<body>
<header class="header"><div class="container nav">
<a class="logo" href="<?= $linkPrefix ?? '' ?>index.php">✦ careerly<span>.</span></a>
<button class="menu-toggle" id="menuToggle">☰</button>
<nav id="navLinks">
<a href="<?= $linkPrefix ?? '' ?>index.php">Home</a>
<a href="<?= $linkPrefix ?? '' ?>jobs.php">Find Jobs</a>
<a href="<?= $linkPrefix ?? '' ?>companies.php">Companies</a>
<?php if (logged_in()): ?><a href="<?= $linkPrefix ?? '' ?>dashboard.php">Dashboard</a><?php endif; ?>
<?php if (logged_in() && $_SESSION['user']['role']==='admin'): ?><a href="<?= $linkPrefix ?? '' ?>admin/index.php">Admin</a><?php endif; ?>
</nav>
<div class="nav-actions">
<?php if (logged_in()): ?>
<span class="welcome">Hi, <?= e(explode(' ', $_SESSION['user']['name'])[0]) ?></span>
<a class="btn btn-outline small" href="<?= $linkPrefix ?? '' ?>logout.php">Logout</a>
<?php else: ?>
<a class="login" href="<?= $linkPrefix ?? '' ?>login.php">Log in</a>
<a class="btn small" href="<?= $linkPrefix ?? '' ?>register.php">Create account</a>
<?php endif; ?>
</div></div></header>
<?php show_flash(); ?>
<main>
