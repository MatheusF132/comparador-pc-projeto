<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/init.php';

$busca = trim($_GET['busca'] ?? '');
$produtos = $busca !== '' ? Product::search($busca) : Product::all();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($_ENV['APP_NAME']) ?></title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <header class="header">
    <a class="logo" href="index.php">Precinho</a>
  </header>

  <main class="home">
    <h1>Ache o menor preço em peças de PC</h1>

    <form class="search-bar" method="GET" action="index.php">
      <input type="text" name="busca" placeholder="Buscar peça de PC (ex: RTX 4070)" value="<?= htmlspecialchars($busca) ?>" />
      <button type="submit">Buscar</button>
    </form>
  </main>

  <div class="results">
    <?php foreach ($produtos as $produto): ?>
      <a class="product-card" href="produto.php?id=<?= (int) $produto['productId'] ?>">
        <h3><?= htmlspecialchars($produto['name']) ?></h3>
        <p class="price"><?= htmlspecialchars($produto['category'] ?? '') ?></p>
      </a>
    <?php endforeach; ?>

    <?php if (empty($produtos)): ?>
      <p>Nenhum produto encontrado.</p>
    <?php endif; ?>
  </div>

</body>
</html>