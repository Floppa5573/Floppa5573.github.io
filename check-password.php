<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    $response = ['success' => false];
    
    if (!empty($email) && !empty($password)) {
        $file = 'passwords.txt';
        
        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lines as $line) {
                list($storedEmail, $storedPassword) = explode(':', $line, 2);
                if ($email === $storedEmail && $password === $storedPassword) {
                    $response['success'] = true;
                    break;
                }
            }
        }
    }
    
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>