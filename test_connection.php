<?php
// Database Connection Test Script
// Run this script to test your PostgreSQL connection

// Database configuration
$host = 'localhost';
$dbname = 'login_system';
$username = 'phpuser';
$password = 'Kummuda@9945'; // Change this to your PostgreSQL password

echo "<h2>Database Connection Test</h2>";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Database connection successful!</p>";
    
    // Test table existence
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();
    
    echo "<p style='color: green;'>✓ Users table exists with $count records</p>";
    
    // Show table structure
    echo "<h3>Table Structure:</h3>";
    $stmt = $pdo->query("SELECT column_name, data_type, is_nullable FROM information_schema.columns WHERE table_name = 'users' ORDER BY ordinal_position");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Column</th><th>Type</th><th>Nullable</th></tr>";
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>" . $column['column_name'] . "</td>";
        echo "<td>" . $column['data_type'] . "</td>";
        echo "<td>" . $column['is_nullable'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Show sample data
    echo "<h3>Sample Data:</h3>";
    $stmt = $pdo->query("SELECT id, email, user_type, created_at FROM users LIMIT 5");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($users)) {
        echo "<p>No users found. You can register an admin to get started.</p>";
    } else {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Email</th><th>Type</th><th>Created</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td>" . htmlspecialchars($user['user_type']) . "</td>";
            echo "<td>" . $user['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<h3>Troubleshooting Steps:</h3>";
    echo "<ul>";
    echo "<li>Check if PostgreSQL is running</li>";
    echo "<li>Verify database credentials in the script</li>";
    echo "<li>Ensure the 'login_system' database exists</li>";
    echo "<li>Run the database_setup.sql script</li>";
    echo "<li>Check if PHP PostgreSQL extension is enabled</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><a href='index.html'>← Back to Login System</a></p>";
?>
