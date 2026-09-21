import { Routes, Route } from "react-router-dom";
import { Header } from "./components/Header/Header";
import { Home } from "./pages/Home/Home";
import { Search } from "./pages/Search/Search";
import { Product } from "./pages/Product/Product";

// Define as 3 telas do site
export function App() {
  return (
    <>
      <Header />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/busca" element={<Search />} />
        <Route path="/produto/:id" element={<Product />} />
      </Routes>
    </>
  );
}

export default App;
