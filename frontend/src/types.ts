// Um preço encontrado em uma loja
export interface Price {
  store: string;
  value: number;
  url: string;
}

// Um produto (peça de PC) com os preços encontrados em cada loja
export interface Product {
  id: string;
  name: string;
  imageUrl?: string;
  prices: Price[]; // já vem ordenado do mais barato pro mais caro
}
