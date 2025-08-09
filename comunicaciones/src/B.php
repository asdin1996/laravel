<?php

require_once 'ComunicacionInterface.php';

/**
 * Clase B: comunicación con envío aleatorio
 *AK 23/07/2025
*/
class B implements ComunicacionInterface
{
    /**
     * {@inheritdoc}
     */
    public function enviar(int $dato): bool
    {
        return (bool)random_int(0, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function consultar(string $dato): string
    {
        throw new Exception("Este método no está permitido");
    }
}
