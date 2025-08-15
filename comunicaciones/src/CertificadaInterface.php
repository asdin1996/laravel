<?php

/**
 * Interface para comunicaciones certificadas.
 */
interface CertificadaInterface
{
    /**
     * Certifica una comunicación.
     *
     * @param string $dato
     * @return int
     */
    public function certificar(string $dato): int;
}
