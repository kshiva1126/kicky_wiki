window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// window.axios.interceptors.request.use(config => {
//   config.headers['X-XSRF-TOKEN'] = getCookieValue('XSRF-TOKEN');

//   return config;
// });
