<?php
session_start();
ini_set('session.cookie_httponly', 1);

require_once __DIR__ . '/../app/config/config.php';
$db = require __DIR__ . '/../app/config/database.php';

$page = $_GET['page'] ?? 'login';

switch($page) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?page=dashboard');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
            }
        }
        require __DIR__ . '/../app/views/auth/login.php';
        break;

    case 'dashboard':
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $stmt = $db->prepare(
        "SELECT id, title, is_done
        FROM tasks
        WHERE user_id = ?
        ORDER BY created_at DESC"
    );
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll();

    require __DIR__ . '/../app/views/dashboard.php';
    break;

    case 'add-task':
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title']);

        if (!empty($title)) {
            $stmt = $db->prepare(
                "INSERT INTO tasks (user_id, title) VALUES (?, ?)"
            );
            $stmt->execute([
                $_SESSION['user_id'],
                $title
            ]);
        }

        header('Location: index.php?page=dashboard');
        exit;
    }
    break;


    case 'logout':
        session_destroy();
        header('Location: index.php?page=login');
        exit;

    default:
        echo "Page non trouvée";
        break;
}

