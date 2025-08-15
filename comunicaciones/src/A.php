<?php

require_once 'ComunicacionInterface.php';

/**
 * Clase A
 * AK 23/07/2025
*/
class A implements ComunicacionInterface
{
    /**
     * {@inheritdoc}
     */
    public function enviar(int $dato): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function consultar(string $dato): string
    {
        if (empty($dato)) {
            throw new InvalidArgumentException("El argumento no puede estar vacío");
        }
        return $dato;
    }
}
