<?php

function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }

        $parts = explode('=', $line, 2);

        if (count($parts) !== 2) {
            continue;
        }

        list($name, $value) = $parts;
        $name = trim($name);
        $value = trim($value);

        if ($name === '') {
            continue;
        }

        if (!array_key_exists($name, $_ENV) && !array_key_exists($name, $_SERVER)) {
            putenv("{$name}={$value}");
        }

        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}

loadEnv(__DIR__ . '/../../.env');

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$db_name = getenv('DB_DATABASE') ?: 'blog';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
} else {
    // echo "DB connection successful";
}
