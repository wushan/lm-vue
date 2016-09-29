//
// filters.js
//
function filterBy (list, value, field) {
  // console.log(list)
  return list.filter(function (item) {
    let filtera = item[field[0]].indexOf(value[0]) > -1
    let filterb = item[field[1]].indexOf(value[1]) > -1
    // temp = item[field[1]].indexOf(value[1]) > -1
    return filtera && filterb
  })
}

function findBy (list, value) {
  return list.filter(function (item) {
    return item === value
  })
}

function reverse (value) {
  return value.split('').reverse().join('')
}

export {filterBy, reverse, findBy}
