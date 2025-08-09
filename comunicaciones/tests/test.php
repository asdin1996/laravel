<?php

require_once __DIR__ . '/../src/ComunicacionInterface.php';
require_once __DIR__ . '/../src/CertificadaInterface.php';
require_once __DIR__ . '/../src/A.php';
require_once __DIR__ . '/../src/B.php';
require_once __DIR__ . '/../src/Acertificado.php';
require_once __DIR__ . '/../src/Bcertificado.php';

echo "<h2>Pruebas manuales</h2>";

echo "<h3>Acertificado</h3>";
$ac = new Acertificado();
echo "Enviar: " . ($ac->enviar(123) ? "✅ OK" : "❌ FALLO") . "<br>";
echo "Consultar: " . $ac->consultar("mensaje") . "<br>";
echo "Certificar: " . $ac->certificar("certificar") . "<br><br>";

echo "<h3>Bcertificado</h3>";
$bc = new Bcertificado();
try {
    $bc->consultar("mensaje");
} catch (Exception $e) {
    echo "Consultar lanzó excepción como se esperaba ✅: " . $e->getMessage() . "<br>";
}

echo "<h3>B</h3>";
$b = new B();
echo "Enviar: " . ($b->enviar(10) ? "✅ OK" : "❌ FALLO") . "<br>";
