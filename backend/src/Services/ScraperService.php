<?php

namespace App\Services;

/**
 * Serviço responsável por buscar preços em lojas externas.
 * Implementação real deve ser adicionada por loja (scraping ou API).
 */
class ScraperService
{
    public function fetchPricesFor(string $productName): array
    {
        // TODO: implementar integração com as lojas parceiras
        return [];
    }
}
