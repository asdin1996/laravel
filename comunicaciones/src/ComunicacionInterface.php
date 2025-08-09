<?php

/**
 * Interface para comunicación
 * * AK 23/07/2025
*/
interface ComunicacionInterface
{
    /**
     * método enviar comunicación
     *
     * @param int $dato
     * @return bool
     * * AK 23/07/2025
     */
    public function enviar(int $dato): bool;

    /**
     * método consultar comunicación
     *
     * @param string $dato
     * @return string
     * * AK 23/07/2025
     */
    public function consultar(string $dato): string;
}
