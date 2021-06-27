window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
// window.axios.defaults.headers.common['Access-Control-Allow-Methods'] = 'GET, POST, PATCH, PUT, DELETE, OPTIONS';
// window.axios.defaults.headers.common['Access-Control-Allow-Headers'] = 'Origin, X-Requested-With,Authorization, Content-Type, Accept';

import Echo from "laravel-echo";

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

require('./Echo');