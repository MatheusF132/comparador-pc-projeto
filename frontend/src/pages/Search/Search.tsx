import { useEffect, useState } from "react";
import { useSearchParams } from "react-router-dom";
import { SearchBar } from "../../components/SearchBar/SearchBar";
import { ProductCard } from "../../components/ProductCard/ProductCard";
import { searchProducts } from "../../api";
import type { Product } from "../../types";
import "./Search.css";

// Página de resultados da busca
export function Search() {
  const [params, setParams] = useSearchParams();
  const query = params.get("q") || "";
  const [products, setProducts] = useState<Product[]>([]);

  useEffect(() => {
    if (query) searchProducts(query).then(setProducts);
  }, [query]);

  return (
    <main className="search">
      <SearchBar onSearch={(q) => setParams({ q })} />
      <div className="results">
        {products.map((p) => (
          <ProductCard key={p.id} product={p} />
        ))}
      </div>
    </main>
  );
}
