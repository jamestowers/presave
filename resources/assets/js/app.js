import Vue from 'vue';
import VueRouter from 'vue-router'

import store from './vuex/store';
import { sync } from 'vuex-router-sync'
import { mapActions } from 'vuex';
import { getErrors } from './vuex/actions';
//require('./bootstrap');

import Errors from './components/Errors.vue';
import Home from './components/Home.vue'
import Dashboard from './components/Dashboard.vue'
import CampaignEdit from './components/CampaignEdit.vue'

window._ = require('lodash');
window.Vue = require('vue');

require('vue-resource');


const is_production_env = process.env.NODE_ENV == 'production';
Vue.config.devtools = !is_production_env;
Vue.config.debug = is_production_env;
Vue.config.silent = is_production_env;
Vue.http.options.root = is_production_env ? 'http://presaver.com/api' : 'https://presaver.dev/api';
Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
Vue.http.headers.common['Accept'] = 'application/json';

Vue.use(VueRouter);

const routes = [
    {
        path: '/', 
        name: 'home',
        component: Home,
    },
    {
        path: '/dashboard', 
        component: Dashboard,
        children: [
            { 
                path: '', 
                name: 'campaigns',
                component: CampaignEdit 
            },
            { 
                path: 'create', 
                name: 'campaigns-create',
                component: CampaignEdit 
            }
        ]
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for routes: routes
})

const app = new Vue({
    el: '#app',

    created(){
        console.log('[App] App is ready');
        store.dispatch('getUser');
    },

    router,

    store,

    components: {
        Errors,
        CampaignEdit
    }
});
