window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
   
    window.$ = window.jQuery = require('jquery');

    require("jquery-validation");
    require('select2');
    require('overlayscrollbars');
    require('../../vendor/almasaeed2010/adminlte/dist/js/adminlte');
   
    
     
    // require('admin-lte');
} catch (e) {}
    require('bootstrap');
    require( '../../public/vendor/jquery/jquery.min.js' );
    require( '../../public/vendor/bootstrap/js/bootstrap.bundle.min.js' );
    require( '../../public/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js' );
    require( '../../public/vendor/adminlte/dist/js/adminlte.min.js' );
    require( '../../node_modules/select2/dist/js/select2.full.js' );
    require( '../../node_modules/select2/dist/js/select2.js' );
    require('datatables');
    window.bootstrapToggle = require('bootstrap-toggle');
    require("vuejs-datatable");

     /**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
