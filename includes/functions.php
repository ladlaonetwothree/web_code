<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function logged_in() {
    return isset($_SESSION['user']['id']);
}
function require_login() {
    if (!logged_in()) {
        header("Location: login.php");
        exit;
    }
}
function require_admin() {
    require_login();
    if (($_SESSION['user']['role'] ?? '') !== 'admin') {
        http_response_code(403);
        exit("Access denied.");
    }
}
function flash($message, $type = "success") {
    $_SESSION['flash'] = [$message, $type];
}
function show_flash() {
    if (empty($_SESSION['flash'])) return;
    [$message, $type] = $_SESSION['flash'];
    unset($_SESSION['flash']);
    echo '<div class="container"><div class="alert '.e($type).'">'.e($message).'</div></div>';
}
