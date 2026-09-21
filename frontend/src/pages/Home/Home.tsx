import { useNavigate } from "react-router-dom";
import { SearchBar } from "../../components/SearchBar/SearchBar";
import "./Home.css";

// Página inicial: só um título e a busca
export function Home() {
  const navigate = useNavigate();

  return (
    <main className="home">
      <h1>Ache o menor preço em peças de PC</h1>
      <SearchBar onSearch={(q) => navigate(`/busca?q=${encodeURIComponent(q)}`)} />
    </main>
  );
}
