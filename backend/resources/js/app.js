require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import { dom, library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon, FontAwesomeLayers, FontAwesomeLayersText } from '@fortawesome/vue-fontawesome'
import { routes } from './routes';
import App from './views/App';

Vue.use(VueRouter)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('font-awesome-layers', FontAwesomeLayers)
Vue.component('font-awesome-layers-text', FontAwesomeLayersText)

library.add(fas, fab, far);
dom.watch();

Vue.config.productionTip = false;

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
