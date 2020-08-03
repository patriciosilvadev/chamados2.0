window._ = require("lodash");

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    require("material-dashboard/assets/js/core/bootstrap-material-design.min.js");
    // require("bootstrap");
} catch (e) {}

/**
 * Material Dashboard
 */
require("material-dashboard/assets/js/plugins/bootstrap-notify.js");
window.Chartist = require("material-dashboard/assets/js/plugins/chartist.min.js");
window.PerfectScrollbar = require("material-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js");
require("material-dashboard/assets/js/material-dashboard.js");

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Content-Type"] = "multipart/form-data";

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});
