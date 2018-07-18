import React, { Component } from 'react';
import $ from 'jquery';


class Form extends Component {

    constructor() {
      super();
      this.handleSubmit = this.handleSubmit.bind(this);
        this.state = {path: ""};
    }

    handleSubmit(event) {
      event.preventDefault();
        let doc = {
          title: this.refs.title.value,
          content: this.refs.content.value,
          categoryid: this.refs.category.value,
          number: this.refs.number.value,
          price: this.refs.price.value,
          markid: this.refs.mark.value,
        }
        var chaineJSON = JSON.stringify(doc);

        $.ajax({
          url: 'http://localhost:8000/articles',
          data: chaineJSON,
          method: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          success: (data) => {
            console.log(data);
            console.log('Work');
            callback(this, data);
          },
          error: function(err) {
            console.log(err);
            console.log('not work');
          }
        });

        function callback(self, id) {
          console.log(id);
          var $file = $('input[type=file]');
          var file = $file[0].files;
          var formData = new FormData();
          for(var i = 0; i <= file.length; i++) {
              formData.append('file' + i, file[i]);
          }
          formData.append('article_id', id);

          $.ajax({
            url: 'http://localhost:8000/img',
            data: formData,
            method: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
              console.log(data);
              console.log('Work');
            },
            error: function(err) {
              console.log(err);
              console.log('not work');
            }
          })
        }
        }


    render() {
      return (
        <div>
          <form id="form" name="form" onSubmit={this.handleSubmit}>
            <div className="form-row">
              <div className="form-group col-md-6">
                <label htmlFor="title">Enter title</label>
                <input ref="title" className="form-control" id="title" name="title" type="text" />
              </div>

              <div className="form-group col-md-4">
                <label htmlFor="category">Choose or create a category</label>
                <select id="category" name="category" className="form-control" ref="category">
                  <option value="valeur1">Valeur 1</option>
                  <option value="valeur2" defaultValue>Valeur 2</option>
                  <option value="valeur3">Valeur 3</option>
                </select>
              </div>

              <div className="form-group col-md-2">
                <label htmlFor="number">Number of product</label>
                <input ref="number" id="number" className="form-control" name="number" type="number" />
              </div>

              <div className="form-group col-md-2">
                <label htmlFor="price">Enter price</label>
                <input ref="price" id="price" className="form-control" name="price" type="number" />
              </div>

              <div className="form-group col-md-4">
                <label htmlFor="mark">Choose or add a mark</label>
                <select id="mark" name="mark" className="form-control" ref="mark">
                  <option value="valeur1">Valeur 1</option>
                  <option value="valeur2" defaultValue>Valeur 2</option>
                  <option value="valeur3">Valeur 3</option>
                </select>
              </div>

              <div className="form-group col-md-6">
                <label htmlFor="content">Enter content</label>
                <input ref="content" id="content" className="form-control" name="content" type="content" />
              </div>

              <div className="form-group">
                <label htmlFor="img">Enter picture</label>
                <input ref="img" id="img" name="img[]" className="form-control" type="file" multiple />
              </div>
            </div>
            <button className="btn btn-primary">Send data!</button>
          </form>
        </div>
      );
    }
  }
export default Form;
