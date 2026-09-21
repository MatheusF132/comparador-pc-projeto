import { useState } from "react";
import "./SearchBar.css";

interface Props {
  onSearch: (query: string) => void;
}

// Campo de busca reutilizado na Home e na página de resultados
export function SearchBar({ onSearch }: Props) {
  const [query, setQuery] = useState("");

  return (
    <form
      className="search-bar"
      onSubmit={(e) => {
        e.preventDefault();
        onSearch(query.trim());
      }}
    >
      <input
        value={query}
        onChange={(e) => setQuery(e.target.value)}
        placeholder="Buscar peça de PC (ex: RTX 4070)"
      />
      <button type="submit">Buscar</button>
    </form>
  );
}
