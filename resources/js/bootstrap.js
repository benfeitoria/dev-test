window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    global.$ = global.jQuery = require('jquery');

    require('bootstrap');
    require('admin-lte');
} catch (e) {}


window.axios = require('axios');

/* seta o filtro de ajax no axios */
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.baseURL = "http://localhost/blog-teste/public/";
