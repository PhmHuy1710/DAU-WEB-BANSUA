<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function getCurrentUser()
{
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

function isAdmin()
{
    if (!isLoggedIn()) {
        return false;
    }

    return isset($_SESSION['user']['VaiTro']) && $_SESSION['user']['VaiTro'] === 'admin';
}

function logout()
{
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $cookieParams = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $cookieParams["path"],
            $cookieParams["domain"],
            $cookieParams["secure"],
            $cookieParams["httponly"]
        );
    }

    session_destroy();
}

function requireLogin($urlRedirect = '')
{
    if (!isLoggedIn()) {
        $linkRedirect = empty($urlRedirect) ? '' : '?redirect=' . urlencode($urlRedirect);
        header("Location: login.php{$linkRedirect}");
        exit;
    }
}

function redirectIfLoggedIn()
{
    if (isLoggedIn()) {
        header("Location: index.php");
        exit;
    }
}

function requireAdmin()
{
    if (!isAdmin()) {
        header("Location: index.php");
        exit;
    }
}
