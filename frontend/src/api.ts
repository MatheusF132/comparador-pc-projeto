import type { Product } from "./types";

// Endereço da nossa API PHP (backend)
const API_URL = import.meta.env.VITE_API_URL || "http://localhost:8000/api";

// Busca produtos pelo nome digitado
export async function searchProducts(query: string): Promise<Product[]> {
  const res = await fetch(`${API_URL}/products?search=${encodeURIComponent(query)}`);
  return res.json();
}

// Pega um produto específico, já com os preços das lojas
export async function getProduct(id: string): Promise<Product> {
  const res = await fetch(`${API_URL}/products/${id}`);
  return res.json();
}
