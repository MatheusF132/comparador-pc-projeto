<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/init.php';

$id = (int) ($_GET['id'] ?? 0);
$produto = Product::find($id);
$precoSalvo = $produto ? PriceHistory::latestFor($produto['productId']) : null;
$precos = $precoSalvo ? [$precoSalvo] : []; 

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $produto ? htmlspecialchars($produto['name']) : 'Produto não encontrado' ?></title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <header class="header">
    <a class="logo" href="index.php">Precinho</a>
  </header>

  <main class="product">
    <?php if (!$produto): ?>
      <p>Produto não encontrado.</p>
    <?php else: ?>
      <h1><?= htmlspecialchars($produto['name']) ?></h1>

      <ul>
        <?php foreach ($precos as $preco): ?>
          <li>
            <a href="<?= htmlspecialchars($preco['url']) ?>" target="_blank" rel="noreferrer">
              <?= htmlspecialchars($preco['store']) ?> — R$ <?= number_format($preco['value'], 2, ',', '.') ?>
            </a>
          </li>
        <?php endforeach; ?>

        <?php if (empty($precos)): ?>
          <li>Nenhum preço encontrado no momento.</li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
  </main>

</body>
</html>