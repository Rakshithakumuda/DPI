# Login System Setup Guide

## Overview
This is a complete login system with two user types: Admin and Analyst. Admins can register analysts, and both can log in using email and password.

## Features
- **Two User Types**: Admin and Analyst
- **Admin Registration**: First admin can register themselves
- **Analyst Registration**: Only admins can register analysts
- **Secure Authentication**: Password hashing and session management
- **PostgreSQL Database**: Stores user data with generated IDs
- **Responsive Design**: Clean, modern UI matching your wireframes

## Setup Instructions

### 1. Database Setup (PostgreSQL)
1. Open pgAdmin or connect to PostgreSQL
2. Create a new database called `login_system`
3. Run the `database_setup.sql` script in the database
4. Update the database credentials in `auth.php` and `config.php`

### 2. Web Server Setup
1. Place all files in your web server directory (htdocs, www, etc.)
2. Ensure PHP is installed and running
3. Make sure PostgreSQL extension is enabled in PHP

### 3. Configuration
1. Update database credentials in `auth.php`:
   ```php
   $host = 'localhost';
   $dbname = 'login_system';
   $username = 'postgres';
   $password = 'your_actual_password';
   ```

### 4. File Structure
```
login_system/
├── index.html              # Main page with login options
├── admin_login.html        # Admin login form
├── analyst_login.html      # Analyst login form
├── admin_register.html     # Admin registration form
├── admin_dashboard.php     # Admin dashboard
├── analyst_dashboard.php   # Analyst dashboard
├── auth.php               # Authentication backend
├── logout.php             # Logout functionality
├── styles.css             # CSS styling
├── config.php             # Configuration file
└── database_setup.sql     # Database setup script
```

## Usage Flow

### Admin Flow:
1. **First Time**: Register admin at `/admin_register.html`
2. **Login**: Use `/admin_login.html` to log in
3. **Dashboard**: Access admin dashboard to register analysts
4. **Register Analysts**: Use the form in admin dashboard

### Analyst Flow:
1. **Registration**: Must be registered by an admin
2. **Login**: Use `/analyst_login.html` to log in
3. **Dashboard**: Access analyst dashboard

## Database Schema

### Users Table:
- `id`: Unique identifier (auto-generated)
- `email`: User email (unique)
- `password`: Hashed password
- `user_type`: 'admin' or 'analyst'
- `created_at`: Registration timestamp
- `updated_at`: Last update timestamp

## Security Features
- Password hashing using PHP's `password_hash()`
- Session management
- SQL injection prevention with prepared statements
- Input validation
- Access control (analysts can only be registered by admins)

## Testing
1. Start with registering an admin
2. Login as admin
3. Register an analyst from admin dashboard
4. Login as analyst
5. Test logout functionality

## Troubleshooting
- **Database Connection Error**: Check PostgreSQL credentials and ensure service is running
- **Session Issues**: Ensure PHP sessions are enabled
- **Permission Errors**: Check file permissions on web server
- **CSS Not Loading**: Verify file paths and web server configuration

## Sample Credentials
After running `database_setup.sql`, you can use:
- Email: `admin@example.com`
- Password: `admin123`

**Note**: Change these credentials in production!
