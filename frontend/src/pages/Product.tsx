import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { getProduct } from "../api";
import type { Product as ProductType } from "../types";

// Página de um produto: mostra todos os preços encontrados, ordenados
export function Product() {
  const { id } = useParams();
  const [product, setProduct] = useState<ProductType | null>(null);

  useEffect(() => {
    if (id) getProduct(id).then(setProduct);
  }, [id]);

  if (!product) return <p>Carregando...</p>;

  return (
    <main className="product">
      <h1>{product.name}</h1>
      <ul>
        {product.prices.map((price) => (
          <li key={price.store}>
            <a href={price.url} target="_blank" rel="noreferrer">
              {price.store} — R$ {price.value.toFixed(2)}
            </a>
          </li>
        ))}
      </ul>
    </main>
  );
}
