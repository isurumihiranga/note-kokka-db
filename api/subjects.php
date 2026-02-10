<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Prevent PHP from sending HTML error pages which would break JSON parsing on the frontend.
ini_set('display_errors', 0);
error_reporting(0);

// Start output buffering to suppress any accidental HTML output from includes
ob_start();
require_once __DIR__ . '/../config.php';
// Discard any buffered output (warnings, notices, accidental HTML)
ob_end_clean();

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$conn = getDBConnection();

if (!$conn) {
    $msg = 'Database connection failed';
    // Include debug details when DB_DEBUG is enabled
    if (defined('DB_DEBUG') && DB_DEBUG && !empty($GLOBALS['DB_CONN_ERROR'])) {
        $msg .= ': ' . $GLOBALS['DB_CONN_ERROR'];
    }
    echo json_encode(['success' => false, 'message' => $msg]);
    exit();
}

// Admin authentication helper
function validateAdmin() {
    $headers = getallheaders();
    $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';
    
    if (empty($authHeader)) {
        return false;
    }
    
    // Expected format: "Basic base64(email:password)"
    if (strpos($authHeader, 'Basic ') === 0) {
        $credentials = base64_decode(substr($authHeader, 6));
        list($email, $password) = explode(':', $credentials, 2);
        
        return ($email === ADMIN_EMAIL && $password === ADMIN_PASSWORD);
    }
    
    return false;
}

// GET - Fetch all active subjects
if ($method === 'GET') {
    $sql = "SELECT id, name, icon, drive_link as driveLink, display_order 
            FROM subjects 
            WHERE is_active = 1 
            ORDER BY display_order DESC, id DESC";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $subjects = [];
        while ($row = $result->fetch_assoc()) {
            $subjects[] = [
                'id' => (int)$row['id'],
                'name' => $row['name'],
                'icon' => $row['icon'],
                'driveLink' => $row['driveLink']
            ];
        }
        echo json_encode(['success' => true, 'data' => $subjects]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error fetching subjects']);
    }
}

// POST - Add new subject (admin only)
elseif ($method === 'POST') {
    if (!validateAdmin()) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit();
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['name']) || !isset($input['icon']) || !isset($input['driveLink'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }
    
    $name = $conn->real_escape_string($input['name']);
    $icon = $conn->real_escape_string($input['icon']);
    $driveLink = $conn->real_escape_string($input['driveLink']);
    
    // Get next display order
    $orderResult = $conn->query("SELECT MAX(display_order) as max_order FROM subjects");
    $orderRow = $orderResult->fetch_assoc();
    $displayOrder = ($orderRow['max_order'] ?? 0) + 1;
    
    $sql = "INSERT INTO subjects (name, icon, drive_link, display_order) 
            VALUES ('$name', '$icon', '$driveLink', $displayOrder)";
    
    if ($conn->query($sql)) {
        $newId = $conn->insert_id;
        
        // Log the action
        $conn->query("INSERT INTO admin_logs (action, subject_id, details) 
                     VALUES ('ADD', $newId, 'Added subject: $name')");
        
        echo json_encode([
            'success' => true, 
            'message' => 'Subject added successfully',
            'data' => [
                'id' => $newId,
                'name' => $input['name'],
                'icon' => $input['icon'],
                'driveLink' => $input['driveLink']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding subject']);
    }
}

// PUT - Update subject (admin only)
elseif ($method === 'PUT') {
    if (!validateAdmin()) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit();
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['id'])) {
        echo json_encode(['success' => false, 'message' => 'Subject ID required']);
        exit();
    }
    
    $id = (int)$input['id'];
    $updates = [];
    
    if (isset($input['name'])) {
        $name = $conn->real_escape_string($input['name']);
        $updates[] = "name = '$name'";
    }
    if (isset($input['icon'])) {
        $icon = $conn->real_escape_string($input['icon']);
        $updates[] = "icon = '$icon'";
    }
    if (isset($input['driveLink'])) {
        $driveLink = $conn->real_escape_string($input['driveLink']);
        $updates[] = "drive_link = '$driveLink'";
    }
    
    if (empty($updates)) {
        echo json_encode(['success' => false, 'message' => 'No fields to update']);
        exit();
    }
    
    $sql = "UPDATE subjects SET " . implode(', ', $updates) . " WHERE id = $id";
    
    if ($conn->query($sql)) {
        // Log the action
        $conn->query("INSERT INTO admin_logs (action, subject_id, details) 
                     VALUES ('UPDATE', $id, 'Updated subject')");
        
        echo json_encode(['success' => true, 'message' => 'Subject updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating subject']);
    }
}

// DELETE - Delete subject (admin only)
elseif ($method === 'DELETE') {
    if (!validateAdmin()) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit();
    }
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['id'])) {
        echo json_encode(['success' => false, 'message' => 'Subject ID required']);
        exit();
    }
    
    $id = (int)$input['id'];
    
    // Soft delete - set is_active to 0
    $sql = "UPDATE subjects SET is_active = 0 WHERE id = $id";
    
    if ($conn->query($sql)) {
        // Log the action
        $conn->query("INSERT INTO admin_logs (action, subject_id, details) 
                     VALUES ('DELETE', $id, 'Deleted subject')");
        
        echo json_encode(['success' => true, 'message' => 'Subject deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting subject']);
    }
}

else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

$conn->close();
?>
