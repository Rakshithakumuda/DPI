<?php
session_start();

// Check if user is logged in as admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: admin_login.html');
    exit();
}

// Database configuration
$host = 'localhost';
$dbname = 'login_system';
$username = 'phpuser';
$password = 'Kummuda@9945'; // Change this to your PostgreSQL password

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all analysts
$stmt = $pdo->prepare("SELECT id, email, created_at FROM users WHERE user_type = 'analyst' ORDER BY created_at DESC");
$stmt->execute();
$analysts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="logout.php" class="logout-btn">LOGOUT</a>
    
    <div class="dashboard">
        <div class="dashboard-header">
            <h1>ADMIN DASHBOARD</h1>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</p>
        </div>
        
        <div class="dashboard-content">
            <div class="dashboard-section">
                <h3>REGISTER NEW ANALYST</h3>
                <form id="analystRegisterForm">
                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">NEW PASSWORD</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">REENTER PASSWORD</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    
                    <button type="submit" class="submit-btn">REGISTER ANALYST</button>
                </form>
            </div>
            
            <div class="dashboard-section">
                <h3>REGISTERED ANALYSTS</h3>
                <div id="analystsList">
                    <?php if (empty($analysts)): ?>
                        <p>No analysts registered yet.</p>
                    <?php else: ?>
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th style="border: 1px solid #000; padding: 8px;">Email</th>
                                    <th style="border: 1px solid #000; padding: 8px;">ID</th>
                                    <th style="border: 1px solid #000; padding: 8px;">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($analysts as $analyst): ?>
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 8px;"><?php echo htmlspecialchars($analyst['email']); ?></td>
                                        <td style="border: 1px solid #000; padding: 8px;"><?php echo htmlspecialchars($analyst['id']); ?></td>
                                        <td style="border: 1px solid #000; padding: 8px;"><?php echo date('Y-m-d H:i', strtotime($analyst['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('analystRegisterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }
            
            const formData = new FormData(this);
            formData.append('action', 'analyst_register');
            
            fetch('auth.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Analyst registered successfully!');
                    location.reload(); // Refresh the page to show updated list
                } else {
                    alert(data.message || 'Registration failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred during registration');
            });
        });
    </script>
</body>
</html>
