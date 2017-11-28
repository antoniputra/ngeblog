// setup lodash
window._ = require('lodash');


// setup jquery
try {
    // window.$ = window.jQuery = require('jquery');
} catch (e) {}


// setup axios
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// setup token
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


require('./link-method.js')
