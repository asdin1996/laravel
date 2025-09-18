<?php
/**
 * GitHub Webhook listener to trigger deployment
 *
 * This script listens for GitHub webhook events and executes a deployment script.
 */

// ---------------------------
// Secret token for webhook verification
// ---------------------------
$secret = 'f39b71c003d0ab8e33106d02c43f1aaa6e772c5b';

// ---------------------------
// Get the signature from GitHub header
// ---------------------------
$header = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';

// ---------------------------
// Get the raw payload
// ---------------------------
$payload = file_get_contents('php://input');

// ---------------------------
// Debug output (optional, remove in production)
// ---------------------------
echo "<pre>";
echo "Payload:\n";
print_r($payload);
echo "Received header:\n";
print_r($header);
echo "</pre>";

// ---------------------------
// Calculate HMAC signature
// ---------------------------
$calculated_signature = 'sha1=' . hash_hmac('sha1', $payload, $secret);

echo "<pre>";
echo "Calculated signature:\n";
print_r($calculated_signature);
echo "</pre>";

// ---------------------------
// Verify signature matches GitHub header
// ---------------------------
if (!hash_equals($calculated_signature, $header)) {
    http_response_code(403);
    exit('Invalid signature');
}

// ---------------------------
// Trigger deployment script in background
// ---------------------------
exec('/var/www/vhosts/laravel-asdin.com/httpdocs/deploy.sh > /tmp/deploy.log 2>&1 &');

echo 'Deploy triggered';
