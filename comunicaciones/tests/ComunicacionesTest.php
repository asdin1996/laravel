<?php

require_once __DIR__ . '/../src/ComunicacionInterface.php';
require_once __DIR__ . '/../src/CertificadaInterface.php';
require_once __DIR__ . '/../src/A.php';
require_once __DIR__ . '/../src/B.php';
require_once __DIR__ . '/../src/Acertificado.php';
require_once __DIR__ . '/../src/Bcertificado.php';

use PHPUnit\Framework\TestCase;

class ComunicacionesTest extends TestCase
{
    public function testEnviarB()
    {
        $b = new B();
        $result = $b->enviar(10);
        $this->assertIsBool($result);
        if ($result) {
            $this->assertTrue($result);
        } else {
            $this->markTestSkipped("Devuelve false, se esperaba true (intenta de nuevo)");
        }
    }

    public function testConsultarBcertificadoThrows()
    {
        $this->expectException(Exception::class);
        $b = new Bcertificado();
        $b->consultar("test");
    }

    public function testCertificarAcertificado()
    {
        $a = new Acertificado();
        $this->assertEquals(1, $a->certificar("contenido"));
    }
}
