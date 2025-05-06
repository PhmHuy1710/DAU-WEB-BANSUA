<?php
/**
 * Session management file
 * This file handles session initialization and management
 */

// Start the session if it hasn't been started already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in
 * 
 * @return bool True if user is logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user']);
}

/**
 * Get current logged in user
 * 
 * @return array|null User data or null if not logged in
 */
function getCurrentUser() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

/**
 * Check if user is admin
 * 
 * @return bool True if user is admin, false otherwise
 */
function isAdmin() {
    if (!isLoggedIn()) {
        return false;
    }
    
    return isset($_SESSION['user']['VaiTro']) && $_SESSION['user']['VaiTro'] === 'admin';
}

/**
 * Logout current user
 */
function logout() {
    // Unset all session variables
    $_SESSION = array();
    
    // If it's desired to kill the session, also delete the session cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finally, destroy the session
    session_destroy();
}

/**
 * Redirect to login page if user is not logged in
 * 
 * @param string $redirect_url URL to redirect to after login
 */
function requireLogin($redirect_url = '') {
    if (!isLoggedIn()) {
        $redirect = empty($redirect_url) ? '' : '?redirect=' . urlencode($redirect_url);
        header("Location: login.php{$redirect}");
        exit;
    }
}

/**
 * Redirect to home page if user is already logged in
 */
function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header("Location: index.php");
        exit;
    }
}

/**
 * Require admin privileges
 */
function requireAdmin() {
    if (!isAdmin()) {
        header("Location: index.php");
        exit;
    }
}
