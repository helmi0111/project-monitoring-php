import { useEffect, useState } from "react";
import { Container } from "react-bootstrap";
import "../App.css";
import PokemonThumb from "./PokemonThumnail";

const Pokemon = () => {
  const url = "https://pokeapi.co/api/v2/pokemon";
  const [allPokemons, setAllPokemons] = useState([]);
  const [loadMorePokemons, setLoadMorePokemons] = useState(url);

  const getPokemons = async () => {
    try {
      const response = await fetch(loadMorePokemons);
      const data = await response.json();

      setLoadMorePokemons(data.next);

      data.results.map(async (result) => {
        const response = await fetch(result.url);
        const data = await response.json();
        console.log(data);
        setAllPokemons((currentList) => [...currentList, data]);
        await allPokemons.sort((a, b) => a.id - b.id);
      });
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    getPokemons();
  }, []);

  return (
    <div>
      <Container className="app-container">
        <h1>Search your favorite pokemon</h1>
        <div className="pokemon-container">
          <Container className="all-container">
            {allPokemons.map((pokemonStats, index) => (
              <PokemonThumb
                key={index}
                id={pokemonStats.id}
                image={pokemonStats.sprites.other.dream_world.front_default}
                name={pokemonStats.name}
                type={pokemonStats.types[0].type.name}
              />
            ))}
          </Container>
          <button className="load-more" onClick={() => getPokemons()}>
            Load more
          </button>
        </div>
      </Container>
    </div>
  );
};

export default Pokemon;
