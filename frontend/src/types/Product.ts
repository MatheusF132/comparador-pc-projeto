export interface Product {
  id: string;
  name: string;
  description?: string;
  imageUrl?: string;
  category?: string;
  prices: Price[];
}

export interface Price {
  id: string;
  storeId: string;
  storeName: string;
  value: number;
  url: string;
  updatedAt: string;
}

export interface Store {
  id: string;
  name: string;
  logoUrl?: string;
}
