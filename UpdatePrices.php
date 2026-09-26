<?php
 require_once __DIR__ . '/includes/init.php';
 $produtos = Product::All();
    //pra cada produto devolve uma lista de preços
    foreach ($produtos as $produto) {
        $precos = PriceFetcher::fetch($produto['name']);

        foreach ($precos as $preco) {
            PriceHistory::save($produto['productId'], $preco);


            
        }



 }