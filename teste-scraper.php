<?php

$url = 'https://www.kabum.com.br/busca/rtx-4070';

$curl = curl_init($url);

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_CAINFO         => 'C:/php/cacert.pem',
]);

$html = curl_exec($curl);
curl_close($curl);

if ($html === false) {
    die('ERRO no cURL');
}

preg_match('/<script id="__NEXT_DATA__"[^>]*>(.*?)<\/script>/s', $html, $matches);

if (!isset($matches[1])) {
    die("Tag __NEXT_DATA__ não encontrada." . PHP_EOL);
}

$data = json_decode($matches[1], true);
$produtos = $data['props']['pageProps']['data']['catalogServer']['data'] ?? [];

echo "Total de produtos encontrados: " . count($produtos) . PHP_EOL . PHP_EOL;

foreach ($produtos as $item) {
    if (!is_array($item)) continue;

    $nome = $item['name'] ?? 'Sem nome';
    $precoAvista = $item['priceWithDiscount'] ?? $item['price'] ?? 0;
    $precoParcelado = $item['price'] ?? 0;
    
    $code = $item['code'] ?? '';
    $friendlyName = $item['friendlyName'] ?? '';
    $imagem = $item['image'] ?? '';
    
    $link = $code ? "https://www.kabum.com.br/produto/{$code}/{$friendlyName}" : "N/A";

    echo "Produto: " . $nome . PHP_EOL;
    echo "Preço à vista (PIX): R$ " . number_format((float)$precoAvista, 2, ',', '.') . PHP_EOL;
    echo "Preço parcelado: R$ " . number_format((float)$precoParcelado, 2, ',', '.') . PHP_EOL;
    echo "Link: " . $link . PHP_EOL;
    echo "--------------------------------------------------" . PHP_EOL;
}