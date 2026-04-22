<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireLogin($redirectTo = '../view/login.php')
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . $redirectTo);
        exit();
    }
}

function currentUserId()
{
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}
?>
