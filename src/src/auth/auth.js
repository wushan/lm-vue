import request from 'superagent'
import Store from '../assets/vendor/store'
export default {
  check (name, islogin, cb) {
    request.post('//lymco.4webdemo.com/backend/api/frontapi/get_is_login')
    .type('form')
    .send({id: name})
    .send({is_login: islogin})
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
  save (data) {
    Store.set('lymco-auth', data)
  }
}
