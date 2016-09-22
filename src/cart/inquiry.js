import Store from '../assets/vendor/store'
export default {
  getLength () {
    if (Store.get('inquiry')) {
      return Store.get('inquiry').length
    }
  },
  add (id) {
    // If inquiry Exist
    if (Store.get('inquiry')) {
      let newRecord = id
      let newArray = Array.from(Store.get('inquiry'))
      if (newArray.includes(newRecord)) {
        console.log('!Prevent Same Record')
      } else {
        newArray.push(newRecord)
      }
      Store.set('inquiry', newArray)
    } else {
      // Set One record directly
      let inquiryArr = Array.of()
      let newRecord = id
      inquiryArr.push(newRecord)
      Store.set('inquiry', inquiryArr)
    }
    // window.localStorage.setItem('product', id)
    return console.log(window.localStorage)
  },
  remove (id) {
    if (Store.get('inquiry')) {
      // Find Index
      let currentArray = Array.from(Store.get('inquiry'))
      console.log(currentArray)
      let productIndex = currentArray.findIndex((x) => x === id)
      console.log(productIndex)
      // Splice
      // if (productIndex)
      currentArray.splice(productIndex, 1)
      // Push back
      Store.set('inquiry', currentArray)
    }
    return console.log(window.localStorage)
  },
  getAll (key) {
    return Store.get(key)
  }
}

