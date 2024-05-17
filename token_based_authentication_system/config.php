<?php

require_once './PHP-MySQLi-Database-Class-master/PHP-MySQLi-Database-Class-master/MysqliDb.php';

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'loginsys');

// Initialize MySQLiDb instance
$db = new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($db->getLastErrno()) {
    die("Connection failed: " . $db->getLastError());
}
