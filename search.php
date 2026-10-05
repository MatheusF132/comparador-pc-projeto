<?php
require_once __DIR__ . '/includes/init.php';
$busca = trim($_GET['busca'] ?? '');
$produtos = product::search($busca);
?>

<?php foreach ($produtos as $produto): ?>
  <?php $preco = PriceHistory::latestFor($produto['productId']); ?>
  <a class="product-card" href="produto.php?id=<?= (int) $produto['productId'] ?>">
    <h3><?= htmlspecialchars($produto['name']) ?></h3>
    <?php if ($preco): ?>
      <p class="price">R$ <?= number_format((float) $preco['value'], 2, ',', '.') ?></p>
    <?php else: ?>
      <p class="price"><?= htmlspecialchars($produto['category'] ?? '') ?></p>
    <?php endif; ?>
  </a>
<?php endforeach; ?>

<?php if (empty($produtos)): ?>
  <p>Nenhum produto encontrado.</p>
<?php endif; ?>
