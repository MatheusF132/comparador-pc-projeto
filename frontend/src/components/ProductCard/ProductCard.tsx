import type { Product } from "../../types";
import "./ProductCard.css";

// Card que mostra um produto e o menor preço encontrado
export function ProductCard({ product }: { product: Product }) {
  const cheapest = product.prices[0];

  return (
    <a className="product-card" href={`/produto/${product.id}`}>
      {product.imageUrl && <img src={product.imageUrl} alt={product.name} />}
      <h3>{product.name}</h3>
      {cheapest && (
        <p className="price">
          R$ {cheapest.value.toFixed(2)} <span>na {cheapest.store}</span>
        </p>
      )}
    </a>
  );
}
