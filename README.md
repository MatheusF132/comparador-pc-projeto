# Precinho — Comparador de Preços de Peças de PC

Site que busca peças de computador em várias lojas (tipo o Buscapé) e mostra
o menor preço encontrado.

## Estrutura

- `frontend/` — site em React + TypeScript
- `backend/` — API em PHP, com todas as classes dentro de `backend/classes/`
- `database/` — scripts do banco de dados

## Como rodar

**Frontend**
```bash
cd frontend
npm install
npm run dev
```

**Backend**
```bash
cd backend
composer install
php -S localhost:8000 -t public
```

## Como funciona

1. O usuário digita o nome da peça na busca.
2. O frontend chama `GET /api/products?search=nome`.
3. O `Router` chama `Product` para achar o produto no banco.
4. O `Router` chama `PriceFetcher`, que consulta a API de cada loja parceira
   (Kabum, Pichau, Terabyte...) e junta todos os preços.
5. O frontend mostra os preços do mais barato pro mais caro.
