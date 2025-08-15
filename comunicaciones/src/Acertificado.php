<?php

require_once 'A.php';
require_once 'CertificadaInterface.php';

/**
 * Clase Acertificado
 * AK 23/07/2025
*/

class Acertificado extends A implements CertificadaInterface
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
