<?php
$secret = '11e441c9fa3166886501c5cfdfd98bc24245ced9';
$header = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';
$payload = file_get_contents('php://input');

if (!hash_equals('sha1=' . hash_hmac('sha1', $payload, $secret), $header)) {
    http_response_code(403);
    exit('Invalid signature');
}

exec('/var/www/vhosts/laravel-asdin.com/httpdocs/laravel/deploy.sh > /tmp/deploy.log 2>&1 &');
echo 'Deploy triggered';
