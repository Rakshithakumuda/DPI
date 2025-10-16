<?php
// Simple command-line database test
echo "Testing PostgreSQL Connection...\n";

$host = 'localhost';
$dbname = 'login_system';
$username = 'postgres';
$password = 'Kummuda@9945';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Database connection successful!\n";
    
    // Test table existence
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();
    
    echo "✓ Users table exists with $count records\n";
    
    // Show sample data
    $stmt = $pdo->query("SELECT id, email, user_type, created_at FROM users LIMIT 3");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($users)) {
        echo "No users found. You can register an admin to get started.\n";
    } else {
        echo "Sample users:\n";
        foreach ($users as $user) {
            echo "- " . $user['email'] . " (" . $user['user_type'] . ")\n";
        }
    }
    
} catch (PDOException $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
    echo "\nTroubleshooting:\n";
    echo "1. Check if PostgreSQL is running\n";
    echo "2. Verify database 'login_system' exists\n";
    echo "3. Run database_setup.sql script\n";
    echo "4. Check credentials\n";
}
?>
