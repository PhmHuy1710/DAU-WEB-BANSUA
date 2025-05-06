<?php
require_once('includes/session.php');

// Log the user out
logout();

// Redirect to the home page
header('Location: index.php');
exit;
?>
