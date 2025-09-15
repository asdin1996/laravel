<?php
$secret = 'f39b71c003d0ab8e33106d02c43f1aaa6e772c5b';
$header = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';
$payload = file_get_contents('php://input');

echo "<pre>";
echo "Payload:\n";
print_r($payload);
echo "Header recibido:\n";
print_r($header);
echo "</pre>";

// Generar el HMAC esperado
$calculated_signature = 'sha1=' . hash_hmac('sha1', $payload, $secret);

echo "<pre>";
echo "Signature calculada:\n";
print_r($calculated_signature);
echo "</pre>";

// Verificar que coincida
if (!hash_equals($calculated_signature, $header)) {
    http_response_code(403);
    exit('Invalid signature');
}

// Ejecutar deploy
exec('/var/www/vhosts/laravel-asdin.com/httpdocs/deploy.sh > /tmp/deploy.log 2>&1 &');
echo 'Deploy triggered';
