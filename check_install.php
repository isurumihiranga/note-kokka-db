<?php
/**
 * NOTE KOKKA - Installation Checker
 * 
 * This file checks if your installation is correct.
 * Access: http://yourwebsite.com/check_install.php
 * 
 * DELETE THIS FILE after successful installation!
 */

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTE KOKKA - Installation Checker</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .check-item {
            background: #f8f9fa;
            border-left: 4px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .check-item.success {
            border-left-color: #28a745;
            background: #d4edda;
        }
        .check-item.error {
            border-left-color: #dc3545;
            background: #f8d7da;
        }
        .check-item.warning {
            border-left-color: #ffc107;
            background: #fff3cd;
        }
        .check-title {
            font-weight: bold;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        .check-title::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
        }
        .success .check-title::before {
            content: '✓';
            background: #28a745;
            color: white;
            text-align: center;
            line-height: 20px;
        }
        .error .check-title::before {
            content: '✗';
            background: #dc3545;
            color: white;
            text-align: center;
            line-height: 20px;
        }
        .warning .check-title::before {
            content: '!';
            background: #ffc107;
            color: white;
            text-align: center;
            line-height: 20px;
        }
        .check-message {
            color: #555;
            font-size: 14px;
            line-height: 1.6;
        }
        .summary {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
        }
        .summary h2 {
            color: #0066cc;
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            margin-top: 15px;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Installation Checker</h1>
        <p class="subtitle">NOTE KOKKA - Database Edition</p>

        <?php
        $errors = 0;
        $warnings = 0;
        $success = 0;

        // Check 1: PHP Version
        echo '<div class="check-item ';
        $phpVersion = phpversion();
        if (version_compare($phpVersion, '7.4.0', '>=')) {
            echo 'success';
            $success++;
        } else {
            echo 'error';
            $errors++;
        }
        echo '">';
        echo '<div class="check-title">PHP Version</div>';
        echo '<div class="check-message">Current version: ' . $phpVersion . ' | Required: 7.4+</div>';
        echo '</div>';

        // Check 2: config.php exists
        echo '<div class="check-item ';
        if (file_exists('config.php')) {
            echo 'success';
            $success++;
            echo '">';
            echo '<div class="check-title">Configuration File</div>';
            echo '<div class="check-message">config.php found and readable</div>';
        } else {
            echo 'error';
            $errors++;
            echo '">';
            echo '<div class="check-title">Configuration File</div>';
            echo '<div class="check-message">ERROR: config.php not found!</div>';
        }
        echo '</div>';

        // Check 3: Database Connection
        if (file_exists('config.php')) {
            require_once 'config.php';
            echo '<div class="check-item ';
            $conn = @getDBConnection();
            if ($conn && !$conn->connect_error) {
                echo 'success';
                $success++;
                echo '">';
                echo '<div class="check-title">Database Connection</div>';
                echo '<div class="check-message">Successfully connected to database: ' . DB_NAME . '</div>';
                
                // Check tables
                $tables = ['subjects', 'admin_logs', 'analytics'];
                $missingTables = [];
                foreach ($tables as $table) {
                    $result = $conn->query("SHOW TABLES LIKE '$table'");
                    if ($result->num_rows == 0) {
                        $missingTables[] = $table;
                    }
                }
                echo '</div>';
                
                if (empty($missingTables)) {
                    echo '<div class="check-item success">';
                    echo '<div class="check-title">Database Tables</div>';
                    echo '<div class="check-message">All required tables found: subjects, admin_logs, analytics</div>';
                    $success++;
                } else {
                    echo '<div class="check-item error">';
                    echo '<div class="check-title">Database Tables</div>';
                    echo '<div class="check-message">Missing tables: ' . implode(', ', $missingTables) . '<br>Please import database.sql in phpMyAdmin</div>';
                    $errors++;
                }
                echo '</div>';
                
                $conn->close();
            } else {
                echo 'error';
                $errors++;
                echo '">';
                echo '<div class="check-title">Database Connection</div>';
                echo '<div class="check-message">ERROR: Cannot connect to database<br>';
                echo 'Check credentials in config.php<br>';
                if (defined('DB_USER') && DB_USER === 'your_db_user') {
                    echo '<strong>You need to update config.php with your actual database credentials!</strong>';
                }
                echo '</div>';
                echo '</div>';
            }
        }

        // Check 4: Required files
        echo '<div class="check-item ';
        $requiredFiles = ['index.html', 'styles.css', '.htaccess', 'api/subjects.php'];
        $missingFiles = [];
        foreach ($requiredFiles as $file) {
            if (!file_exists($file)) {
                $missingFiles[] = $file;
            }
        }
        if (empty($missingFiles)) {
            echo 'success';
            $success++;
            echo '">';
            echo '<div class="check-title">Required Files</div>';
            echo '<div class="check-message">All required files found</div>';
        } else {
            echo 'error';
            $errors++;
            echo '">';
            echo '<div class="check-title">Required Files</div>';
            echo '<div class="check-message">Missing files: ' . implode(', ', $missingFiles) . '</div>';
        }
        echo '</div>';

        // Check 5: API Endpoint
        echo '<div class="check-item ';
        if (file_exists('api/subjects.php')) {
            echo 'success';
            $success++;
            echo '">';
            echo '<div class="check-title">API Endpoint</div>';
            echo '<div class="check-message">API file exists at /api/subjects.php</div>';
        } else {
            echo 'warning';
            $warnings++;
            echo '">';
            echo '<div class="check-title">API Endpoint</div>';
            echo '<div class="check-message">API file not found. Create folder "api" and place subjects.php inside</div>';
        }
        echo '</div>';

        // Check 6: File Permissions
        echo '<div class="check-item ';
        $configPerms = file_exists('config.php') ? substr(sprintf('%o', fileperms('config.php')), -3) : '000';
        if ($configPerms == '600' || $configPerms == '644') {
            echo 'success';
            $success++;
            echo '">';
            echo '<div class="check-title">File Permissions</div>';
            echo '<div class="check-message">config.php permissions: ' . $configPerms . ' (Secure)</div>';
        } else {
            echo 'warning';
            $warnings++;
            echo '">';
            echo '<div class="check-title">File Permissions</div>';
            echo '<div class="check-message">config.php permissions: ' . $configPerms . '<br>Recommended: 600 or 644</div>';
        }
        echo '</div>';

        // Summary
        echo '<div class="summary">';
        if ($errors == 0 && $warnings == 0) {
            echo '<h2>✅ Perfect! Installation Complete</h2>';
            echo '<p>Your NOTE KOKKA installation is ready to use!</p>';
            echo '<a href="index.html" class="btn">Go to Website</a>';
            echo '<div class="warning-box" style="margin-top: 20px;">';
            echo '<strong>⚠️ Important:</strong> Delete this file (check_install.php) for security!';
            echo '</div>';
        } else if ($errors == 0) {
            echo '<h2>⚠️ Installation OK with Warnings</h2>';
            echo '<p>Your installation works but has ' . $warnings . ' warning(s). Review them above.</p>';
            echo '<a href="index.html" class="btn">Go to Website</a>';
        } else {
            echo '<h2>❌ Installation Incomplete</h2>';
            echo '<p>Found ' . $errors . ' error(s) and ' . $warnings . ' warning(s). Please fix them.</p>';
            echo '<p style="margin-top: 15px;">Check the <code>SETUP_GUIDE.md</code> file for detailed instructions.</p>';
        }
        echo '</div>';
        ?>

        <div class="warning-box" style="margin-top: 30px;">
            <strong>🔒 Security Reminder:</strong><br>
            1. Delete this file after checking installation<br>
            2. Change admin credentials in config.php and index.html<br>
            3. Enable SSL certificate (HTTPS) in your hosting
        </div>
    </div>
</body>
</html>
