// schema
// import Home from './assets/schema/home.json'
// import About from './assets/schema/about.json'
// import NewsList from './assets/schema/news-list.json'
// import NewsSingle from './assets/schema/news-single.json'
// import Categories from './assets/schema/product-category.json'
// import Product from './assets/schema/product-single.json'
import Inventory from './assets/schema/inventory.json'
import Inquiry from './assets/schema/inquiry.json'
// import Dealer from './assets/schema/dealer.json'
import Machine from './assets/schema/machine.json'
import ErrorShooting from './assets/schema/errorshooting.json'
import request from 'superagent'
import Vue from 'vue'

export default {
  getPost (id, cb) {
    // Mount some real ajax calls
    Vue.http.get('https://jsonplaceholder.typicode.com/posts/' + id).then((response) => {
    // success callback
      if (response.data) {
        cb(null, response.data)
      }
    }, (response) => {
  // error callback
      cb(new Error(response.data))
    })
  },
  getHome (cb) {
    request
    .get('//lymco.4webdemo.com/backend/api/frontapi/get_homepage')
    .end(function (err, res) {
      if (err || !res.ok) {
        console.log(err)
      } else {
        cb(null, res.body)
      }
    })
    // setTimeout(() => {
    //   if (Home) {
    //     cb(null, Home)
    //   } else {
    //     cb(new Error('Data not found.'))
    //   }
    // }, 500)
  },
  getAbout (cb) {
    request
    .get('//lymco.4webdemo.com/backend/api/frontapi/get_about')
    .end(function (err, res) {
      if (err || !res.ok) {
        console.log(err)
      } else {
        cb(null, res.body)
      }
    })
  },
  getNewsHome (page, cb) {
    request
    .get('//lymco.4webdemo.com/backend/api/frontapi/get_news_list')
    .end(function (err, res) {
      if (err || !res.ok) {
        console.log(err)
      } else {
        console.log(res.body)
        cb(null, res.body)
      }
    })
  },
  getNewsSingle (id, cb) {
    request.post('//lymco.4webdemo.com/backend/api/frontapi/get_news_single')
    .type('form')
    .send({id: id})
    .end(function (err, res) {
      if (err || !res.ok) {
        console.log(err)
      } else {
        cb(null, res.body)
      }
    })
  },
  getCategories (cb) {
    request
    .get('//lymco.4webdemo.com/backend/api/frontapi/get_product_category')
    .end(function (err, res) {
      if (err || !res.ok) {
        console.log(err)
      } else {
        cb(null, res.body)
      }
    })
  },
  getProduct (id, cb) {
    request.post('//lymco.4webdemo.com/backend/api/frontapi/get_product_single')
    .type('form')
    .send({id: id})
    .end(function (err, res) {
      if (err || !res.ok) {
        cb(err)
      } else {
        console.log(res.body)
        cb(null, res.body)
      }
    })
  },
  getProducts (id, cb) {
    setTimeout(() => {
      if (Inquiry) {
        cb(null, Inquiry)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 500)
  },
  getInventory (cb) {
    setTimeout(() => {
      if (Inventory) {
        cb(null, Inventory)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 500)
  },
  getDealer (id, cb) {
    request.post('//lymco.4webdemo.com/backend/api/frontapi/get_dealer')
    .type('form')
    .send({id: id})
    .end(function (err, res) {
      if (err || !res.ok) {
        cb(new Error('Data not found.'))
      } else {
        // alert('yay got ' + JSON.stringify(res.body))
        console.log(res.body)
        cb(null, res.body)
      }
    })
  },
  getMachine (cb) {
    setTimeout(() => {
      if (Machine) {
        cb(null, Machine)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 500)
  },
  getSolution (id, code, cb) {
    setTimeout(() => {
      if (ErrorShooting) {
        cb(null, ErrorShooting)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 500)
  }
}
