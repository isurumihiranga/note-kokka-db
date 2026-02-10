<?php
// Database Configuration
// IMPORTANT: Update these values with your hosting database credentials
// Defaults are set for local XAMPP: user `root` with empty password.
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'note_kokka_db');

// Debug mode (set to false in production)
// Default: false to avoid HTML error output breaking JSON APIs
define('DB_DEBUG', false);

// Admin Credentials
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'isurumihi1@gmail.com');
define('ADMIN_PASSWORD', getenv('ADMIN_PASSWORD') ?: '22022imd');

// Holds last connection error (populated on failure)
$GLOBALS['DB_CONN_ERROR'] = null;

// Create database connection
function getDBConnection() {
    try {
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_errno) {
            $msg = "Connection failed ({$conn->connect_errno}): {$conn->connect_error}";
            error_log("Database connection error: " . $msg);
            $GLOBALS['DB_CONN_ERROR'] = $msg;
            return null;
        }

        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        $msg = $e->getMessage();
        error_log("Database connection exception: " . $msg);
        $GLOBALS['DB_CONN_ERROR'] = $msg;
        return null;
    }
}

// Enable error reporting for development (disable in production)
if (DB_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
?>
