<?php

require_once __DIR__ . '/../app/config/config.php';

try {
    $db = require __DIR__ . '/../app/config/database.php';
    echo "Connexion à la base OK";
} catch (Exception $e) {
    echo "Erreur DB";
}
