import type { Product } from "../types/Product";

const API_BASE_URL = import.meta.env.VITE_API_URL || "http://localhost:8000/api";

async function request<T>(path: string, options?: RequestInit): Promise<T> {
  const response = await fetch(`${API_BASE_URL}${path}`, {
    headers: { "Content-Type": "application/json" },
    ...options,
  });

  if (!response.ok) {
    throw new Error(`Erro na requisição: ${response.status}`);
  }

  return response.json() as Promise<T>;
}

export const api = {
  searchProducts: (query: string) =>
    request<Product[]>(`/products?search=${encodeURIComponent(query)}`),

  getProductById: (id: string) => request<Product>(`/products/${id}`),

  getAllProducts: () => request<Product[]>("/products"),
};
