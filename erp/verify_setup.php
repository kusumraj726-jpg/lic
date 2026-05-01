<?php

function checkUrl($url) {
    echo "Checking URL: $url\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 400) {
        echo "[SUCCESS] Server is responding with HTTP $httpCode\n";
    } else {
        echo "[ERROR] Server returned HTTP $httpCode\n";
    }
}

echo "--- RUNNING SERVER VERIFICATION ---\n";

// 1. Check URL
checkUrl("http://localhost:8000");

// 2. Check Session Directory
$sessionPath = __DIR__ . '/storage/framework/sessions';
if (is_dir($sessionPath) && is_writable($sessionPath)) {
    echo "[SUCCESS] Session directory is writable: $sessionPath\n";
} else {
    echo "[ERROR] Session directory is NOT writable or does not exist: $sessionPath\n";
}

// 3. Check for recent errors in logs
$logFile = __DIR__ . '/storage/logs/laravel.log';
if (file_exists($logFile)) {
    echo "Checking last few lines of log file...\n";
    $lines = file($logFile);
    $lastLines = array_slice($lines, -5);
    foreach ($lastLines as $line) {
        echo "  > " . trim($line) . "\n";
    }
} else {
    echo "[INFO] No log file found.\n";
}

echo "--- VERIFICATION COMPLETE ---\n";
