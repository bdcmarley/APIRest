import React, { Component } from 'react';
import $ from 'jquery';
import '../Asset/App.css';

class Homepage extends Component {

  constructor(props) {
    super(props);
    this.handleLoad = this.handleLoad.bind(this);

    this.state = {
      articles: []
    }
  }

 handleLoad() {
     $("#img1").addClass("active");
     $("#elem1").addClass("active");
 }

  componentDidMount() {
          window.addEventListener('load', this.handleLoad);
          let self = this;
          fetch('http://localhost:8000/articl', {
              method: 'GET'
          }).then(function(response) {
              if (response.status >= 400) {
                  throw new Error("Bad response from server");
              }
              return response.json();
          }).then(function(data) {
              self.setState({articles: data});
              // console.log(self.state.articles[0].img[0].path);
          }).catch(err => {
              console.log('caught it!',err);
          })
      }

      rendu(article)
      {
        // console.log(article.img);
        return (
          <div key={article.id} id="body2">
            <h1>{article.title}</h1>
            <p>{article.content}</p>
            <div id="carouselExampleIndicators" className="carousel slide" data-ride="carousel">
              <ol className="carousel-indicators">
                {article.img.map(mg =>
                <li key={mg.id}
                  data-target="#carouselExampleIndicators" data-slide-to={mg.id - 1} id={"elem" + mg.id} className="fix">
                </li>
                )}
              </ol>
              <div className="carousel-inner">
            {article.img.map(mg =>
              <div key={mg.id} className="carousel-item" id={"img" + mg.id} >
                  <img src={mg.path} alt="" className="d-block w-100"/>
              </div>
            )}
          </div>
            <a className="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span className="carousel-control-prev-icon" aria-hidden="true"></span>
              <span className="sr-only">Previous</span>
            </a>
            <a className="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span className="carousel-control-next-icon" aria-hidden="true"></span>
              <span className="sr-only">Next</span>
            </a>
          </div>
            <a href="article/1">le lien ici</a>
          </div>
        )

      }

      render () {
          return (
              <div className="zbeub">
                  <div className="App">
                      <a href="/articles/new">formulaire</a>
                  </div>
                  <p className="App-intro">Articles</p>
                  {this.state.articles.map(article =>
                    this.rendu(article)
                  )}
              </div>
          );
      }
    }

    // $(document).load(function (event) {
    //   // event.preventDefault();
    //     $("#img1").addClass("active");
    //   // $("#elem1").addClass("active");
    // });


export default Homepage;
