import React from "react";
import { Navbar, Nav, Container } from "react-bootstrap";

const NavigationBar = () => {
  return (
    <div>
      <Navbar>
        <Container>
          <Navbar.Brand className="text-white">
            <img
              src="https://cdn-icons-png.flaticon.com/512/188/188940.png"
              alt="pokedex"
              style={{ width: 40 }}
            />
            Pokedex
          </Navbar.Brand>
          <Nav>
            <img
              src="https://www.freepnglogos.com/uploads/pokemon-logo-text-png-7.png"
              style={{ width: 100 }}
              alt="pokemon"
            />
          </Nav>
        </Container>
      </Navbar>
    </div>
  );
};

export default NavigationBar;
