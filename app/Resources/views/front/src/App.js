import React, { Component } from 'react';
import {
  BrowserRouter as Router,
  Route,
} from 'react-router-dom';

import Form from './components/pages/Form';
import Homepage from './components/pages/Homepage';
import Header from './components/pages/Header';
// import Image from './components/pages/Img';
import Article from './components/pages/Article';

class App extends Component {

  // constructor(props)
  // {
  //   super(props);
  // }

  render() {
    return (
      <Router>
      <div className="App">
        <Header />
        <Route exact path='/' component={Homepage} />
        <Route exact path="/form" component={Form} />
        {/* <Route exact path="/img" component={Image} /> */}
        <Route exact path={"/article/" + this.props} component={Article} />
        <p className="App-intro">
          Ca, ca ne bougera pas.
        </p>
      </div>
    </Router>
    );
  }
}
export default App;
