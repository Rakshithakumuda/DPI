<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to main page
header('Location: index.html');
exit();
?>
