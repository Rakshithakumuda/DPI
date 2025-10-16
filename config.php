<?php
// Database Configuration
// Update these values according to your PostgreSQL setup

return [
    'database' => [
        'host' => 'localhost',
        'dbname' => 'login_system',
        'username' => 'phpuser',
        'password' => '..', // Change this to your actual PostgreSQL password
        'port' => '5432'
    ],
    
    'security' => [
        'session_timeout' => 3600, // 1 hour in seconds
        'password_min_length' => 6,
        'max_login_attempts' => 5
    ],
    
    'app' => [
        'name' => 'Login System',
        'version' => '1.0.0',
        'debug' => true // Set to false in production
    ]
];
?>
