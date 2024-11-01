<?php
    session_start(); // Start the session

    // Unset all session variables
    $_SESSION = [];

    // If you want to delete the session cookie as well, you can do so
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session
    session_destroy();

    // Redirect to the login page or any other page
    header("Location: index.php");
    exit();
?>