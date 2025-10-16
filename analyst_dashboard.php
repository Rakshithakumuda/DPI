<?php
session_start();

// Check if user is logged in as analyst
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'analyst') {
    header('Location: analyst_login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analyst Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="logout.php" class="logout-btn">LOGOUT</a>
    
    <div class="dashboard">
        <div class="dashboard-header">
            <h1>ANALYST DASHBOARD</h1>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</p>
            <p>User ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
        </div>
        
        <div class="dashboard-content">
            <div class="dashboard-section">
                <h3>ANALYST INFORMATION</h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <p><strong>User Type:</strong> Analyst</p>
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
            </div>
            
            <div class="dashboard-section">
                <h3>SYSTEM ACCESS</h3>
                <p>You have been granted access to the system by an administrator.</p>
                <p>You can now use the system features available to analysts.</p>
            </div>
        </div>
    </div>
</body>
</html>
