-- PostgreSQL Database Setup for Login System
-- Run this script in pgAdmin or psql command line

-- Create database (run this as superuser if database doesn't exist)
-- CREATE DATABASE login_system;

-- Connect to the database
-- \c login_system;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(255) PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type VARCHAR(50) NOT NULL CHECK (user_type IN ('admin', 'analyst')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create index on email for faster lookups
CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);

-- Create index on user_type for filtering
CREATE INDEX IF NOT EXISTS idx_users_type ON users(user_type);

-- Create index on created_at for sorting
CREATE INDEX IF NOT EXISTS idx_users_created_at ON users(created_at);

-- Insert a sample admin user (optional - remove this in production)
-- Password is 'admin123' (hashed)
INSERT INTO users (id, email, password, user_type) 
VALUES (
    'admin_' || extract(epoch from now())::text,
    'admin@example.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin'
) ON CONFLICT (email) DO NOTHING;

-- Verify the table structure
\d users;

-- Show sample data
SELECT * FROM users;
