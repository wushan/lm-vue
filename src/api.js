// schema
// import Home from './assets/schema/home.json'
import NewsList from './assets/schema/news-list.json'
import NewsSingle from './assets/schema/news-single.json'
import Categories from './assets/schema/product-category.json'
import Product from './assets/schema/product-single.json'
import Inventory from './assets/schema/inventory.json'
import Inquiry from './assets/schema/inquiry.json'

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
    // Mount some real ajax calls
    Vue.http.get('/backend/api/getHome').then((response) => {
    // success callback
      if (response.data) {
        cb(null, response.data)
        console.log(response)
      }
    }, (response) => {
    // error callback
      cb(new Error(response.data))
      console.log(response)
    })
  },
  getNewsHome (page, cb) {
    setTimeout(() => {
      if (NewsList) {
        cb(null, NewsList)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 100)
  },
  getNewsSingle (id, cb) {
    setTimeout(() => {
      if (NewsSingle) {
        cb(null, NewsSingle)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 100)
  },
  getCategories (cb) {
    setTimeout(() => {
      if (Categories) {
        cb(null, Categories)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 100)
  },
  getProduct (id, cb) {
    setTimeout(() => {
      if (Product) {
        cb(null, Product)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 100)
  },
  getProducts (id, cb) {
    setTimeout(() => {
      if (Inquiry) {
        cb(null, Inquiry)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 100)
  },
  getInventory (cb) {
    setTimeout(() => {
      if (Inventory) {
        cb(null, Inventory)
      } else {
        cb(new Error('Data not found.'))
      }
    }, 100)
  }
}
