import React from "react";
import "../App.css";

const PokemonThumb = ({ id, image, name, type }) => {
  const style = type + " thumb-container";
  return (
    <div className={style}>
      <div className="number">
        <small>#0{id}</small>
      </div>
      <img src={image} alt={name} />
      <div className="detail-wrapper">
        <h3>{name}</h3>
        <small>Type: {type}</small>
      </div>
    </div>
  );
};

export default PokemonThumb;
