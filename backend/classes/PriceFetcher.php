<?php

// A parte "buscapé" do site: consulta a API de cada loja parceira
// e devolve os preços do mais barato pro mais caro.
class PriceFetcher
{
    private static array $stores = [
        'Kabum' => 'https://api.kabum.com.br/produtos?busca=',
        'Pichau' => 'https://api.pichau.com.br/produtos?busca=',
        'Terabyte' => 'https://api.terabyteshop.com.br/produtos?busca=',
    ];

    public static function fetch(string $productName): array
    {
        $prices = [];

        foreach (self::$stores as $store => $endpoint) {
            $data = self::request($endpoint . urlencode($productName));

            if ($data && isset($data['preco'])) {
                $prices[] = [
                    'store' => $store,
                    'value' => (float) $data['preco'],
                    'url' => $data['url'] ?? '',
                ];
            }
        }

        usort($prices, fn ($a, $b) => $a['value'] <=> $b['value']);

        return $prices;
    }

    private static function request(string $url): ?array
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response ? json_decode($response, true) : null;
    }
}