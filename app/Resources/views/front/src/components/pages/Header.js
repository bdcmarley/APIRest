import React, { Component } from 'react';

class Header extends Component {

  render () {
    return (
      <header className="App-header">
        <ul className="nav">
          <li className="nav-item">
            <a href="/" className="nav-link active" >Home</a>
          </li>
          <li className="nav-item">
            <a href="/form" className="nav-link active">Formulaire</a>
          </li>
        </ul>
        {/* <img src={logo} className="App-logo" alt="logo" /> */}
        <h1 className="App-title">ELLE FAIT TIEPPP</h1>
      </header>
    );
  }
}
export default Header;
