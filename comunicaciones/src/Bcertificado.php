<?php

require_once 'B.php';
require_once 'CertificadaInterface.php';

/**
 * Clase Bcertificado
 * AK 23/07/2025
*/

class Bcertificado extends B implements CertificadaInterface
{
    /**
     * {@inheritdoc}
     */
    public function certificar(string $dato): int
    {
        if (!is_string($dato)) {
            throw new InvalidArgumentException("Debe ser una cadena");
        }
        return 1;
    }
}
