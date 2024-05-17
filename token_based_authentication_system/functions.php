<?php
require_once './PHP-MySQLi-Database-Class-master/PHP-MySQLi-Database-Class-master/MysqliDb.php';

// Define handleLogin function
function handleLogin($db) {
    // Initialize response array
    $response = array();

    // Check if required parameters are set
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        //fetch user from database
        $user = $db->where('email', $email)
                    ->getOne('users');

        // Verify user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, generate token and expiry date
            $token = bin2hex(random_bytes(32)); // Generate a random token
            $expiry = date('Y-m-d H:i:s', strtotime('+15 days')); // Set expiry to 15 days from now

            // Insert token into database
            $data = array(
                'email' => $email,
                'token' => $token,
                'expiry' => $expiry
            );
            $db->insert('tokens', $data);

            // Construct response with user's full name
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $response['token'] = $token;
            $response['expiry'] = $expiry;
            $response['first_name'] = $user['first_name'];
            $response['last_name'] = $user['last_name'];
        } else {
            // Invalid email or password
            $response['status'] = 'error';
            $response['message'] = 'Invalid email or password';
        }
    } else {
        // Required parameters not provided
        $response['status'] = 'error';
        $response['message'] = 'Email and password are required';
    }

    return $response;
}

// Function to handle signup request
function handleSignup($db) {
    // Initialize response array
    $response = array();

    // Retrieve data from request
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    // Check if email already exists
    $existingUser = $db->where('email', $email)->getOne('users');

    if (!$existingUser) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into database
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashed_password
        );

        if ($db->insert('users', $data)) {
            // Signup successful
            $response['status'] = 'success';
            $response['message'] = 'Signup successful';
        } else {
            // Signup failed
            $response['status'] = 'error';
            $response['message'] = 'Signup failed';
        }
    } else {
        // Email already exists
        $response['status'] = 'error';
        $response['message'] = 'Email already exists';
    }

    return $response;
}

// Function to handle logout request
function handleLogout($db) {
    // Initialize response array
    $response = array();

    // Get JSON data from request
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if token exists in the data
    if (isset($data['token'])) {
        $token = $data['token'];

        // Check if token exists in the database
        $tokenExists = $db->where('token', $token)->getOne('tokens');

        if ($tokenExists) {
            // Token found, delete it from the database
            $db->where('token', $token)->delete('tokens');

            // Construct response
            $response['status'] = 'success';
            $response['message'] = 'Logout successful';
        } else {
            // Token not found
            $response['status'] = 'error';
            $response['message'] = 'Invalid token';
        }
    } else {
        // Token not provided
        $response['status'] = 'error';
        $response['message'] = 'Please provide token';
    }

    return $response;
}