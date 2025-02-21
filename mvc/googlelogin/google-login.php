<?php
require_once 'vendor/autoload.php';

session_start();

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['credential'])) {
    $client = new Google_Client(['client_id' => '55135624167-1f24q2tga4ul78hmsfd3peml7v5csh40.apps.googleusercontent.com']);
    $clientSecret = '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'; // your client secret
    $redirectUri = 'http://localhost:8000/login';
    
    $payload = $client->verifyIdToken($data['credential']);
    if ($payload) {
        $_SESSION['user'] = $payload;
        $client->addScope("profile");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid ID token']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No credential received']);
}
