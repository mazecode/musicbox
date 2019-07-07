require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { routes } from './routes';
import App from './views/App';

Vue.use(VueRouter)
Vue.component('font-awesome-icon', FontAwesomeIcon)

library.add(faUserSecret)

Vue.config.productionTip = false;

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
