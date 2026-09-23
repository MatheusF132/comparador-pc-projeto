<?php

class PriceFetcher
{
    public static function fetch(string $productName): array
{
    $prices = [];

    $kabum = self::fetchKabum($productName);
    if ($kabum) {
        $prices[] = $kabum;
    }

    return $prices;
}
    private static function httpGet(string $url): ?string
{
    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => '',
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
        CURLOPT_TIMEOUT => 15,
    ]);

    $cacert = __DIR__ . '/../cacert.pem';
    if (file_exists($cacert)) {
        curl_setopt($curl, CURLOPT_CAINFO, $cacert);
    }

    $response = curl_exec($curl);
    curl_close($curl);

    return $response !== false ? $response : null;
}
    private static function fetchKabum(string $productName): ?array
{
    $slug = str_replace(' ', '-', trim($productName));
    $url = 'https://www.kabum.com.br/busca/' . rawurlencode($slug);

    $html = self::httpGet($url);
    if ($html === null) {
        return null;
    }

    preg_match('/<script id="__NEXT_DATA__"[^>]*>(.*?)<\/script>/s', $html, $matches);
    if (!isset($matches[1])) {
        return null;
    }

    $data = json_decode($matches[1], true);
    $produtos = $data['props']['pageProps']['data']['catalogServer']['data'] ?? [];

    if (empty($produtos) || !is_array($produtos[0])) {
        return null;
    }

    $item = $produtos[0];
    $preco = $item['priceWithDiscount'] ?? $item['price'] ?? null;
    if (!$preco) {
        return null;
    }

    $code = $item['code'] ?? '';
    $friendlyName = $item['friendlyName'] ?? '';
    $link = $code ? "https://www.kabum.com.br/produto/{$code}/{$friendlyName}" : '';

    return [
        'store' => 'Kabum',
        'value' => (float) $preco,
        'url' => $link,
    ];
}
}