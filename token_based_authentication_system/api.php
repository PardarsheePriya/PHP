<?php

// Include necessary files C
require_once 'config.php';
require_once 'functions.php';
require_once './PHP-MySQLi-Database-Class-master/PHP-MySQLi-Database-Class-master/MysqliDb.php';

//Handle CORS error (on browser)
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// Initialize response array
$response = array();

// Initialize mysqlidb
$db = new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Handling different request methods
switch ($method) {
    case 'POST':
        // Check if the endpoint is for login or signup
        if (isset($_GET['action']) && $_GET['action'] == 'login') {
            // Handle login request
            $response = handleLogin($db);
        } elseif (isset($_GET['action']) && $_GET['action'] == 'signup') {
            // Handle signup request
            $response = handleSignup($db);
        } elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
            // Handle logout request
            $response = handleLogout($db);
        } else {
            // Invalid endpoint
            $response['status'] = 'error';
            $response['message'] = 'Invalid endpoint';
        }
        break;
    default:
        // Invalid request method
        $response['status'] = 'error';
        $response['message'] = 'Invalid request method';
}

// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close mysqlidb connection
$db->disconnect();
