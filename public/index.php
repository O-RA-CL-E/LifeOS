<?php
require_once __DIR__ . '/../app/config/config.php';
$db = require __DIR__ . '/../app/config/database.php';

// Simple routing minimal
$page = $_GET['page'] ?? 'login';

switch($page) {
    case 'login':
        require __DIR__ . '/../app/views/auth/login.php';
        break;
    default:
        echo "Page not found";
        break;
}
