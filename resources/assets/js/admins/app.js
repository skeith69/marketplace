
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue';
import Vuex from 'vuex';
import router from './router';
import VueRouter from 'vue-router';
import App from './views/App';
import VueSelect from 'vue-select';

window.Broadcast = new Vue();

Vue.use(VueRouter);
Vue.use(Vuex);

// Source of Truth
const store = new Vuex.Store({
    state: {
        user: null,
        roles: [],
        permissions: []
    },
    getters: {
        //
    },
    mutations: {
        //
    },
    actions: {
        //
    },
    modules: {
        //
    }
});

window.Store = store;

//select filtering
Vue.component('vue-select-component', VueSelect);

// Layouts
Vue.component('navbar-component', require('./components/NavbarComponent.vue'));
Vue.component('sidebar-component', require('./components/SidebarComponent.vue'));

// OAuth2
/*Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));*/

const app = new Vue({
    el: '#app',
    store,
    components: { 'app': App },
    router
});

