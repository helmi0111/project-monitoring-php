import "./App.css";
import NavigationBar from "./components/NavigationBar";
import Pokemon from "./components/Pokemon";
import "./styles/Navbar.css";

function App() {
  return (
    <div className="App">
      <div className="bg">
        <NavigationBar />
      </div>
      <div>
        <Pokemon />
      </div>
    </div>
  );
}

export default App;
