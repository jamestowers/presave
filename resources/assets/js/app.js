import Vue from 'vue';
import VueRouter from 'vue-router'

import store from './vuex/store';
import { sync } from 'vuex-router-sync'
import { mapActions } from 'vuex';
//import { getErrors } from './vuex/actions';
//require('./bootstrap');
import { checkUserIsLogin } from './vuex/actions';

import Errors from './components/Errors.vue';
import Home from './components/Home.vue'
import Campaign from './components/Campaign.vue'
import Dashboard from './components/Dashboard.vue'
import LoginBtn from './components/LoginBtn.vue'
import CampaignEdit from './components/CampaignEdit.vue'

window._ = require('lodash');
window.Vue = require('vue');

require('vue-resource');


const is_production_env = process.env.NODE_ENV == 'production';
Vue.config.devtools = !is_production_env;
Vue.config.debug = is_production_env;
Vue.config.silent = is_production_env;
Vue.http.options.root = is_production_env ? 'http://presaver.com/api' : '/api';
Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
Vue.http.headers.common['Accept'] = 'application/json';

Vue.use(VueRouter);

let reg = new RegExp('www|presaver')
let parts = window.location.host.split('.')
let homeComponent = reg.test(parts[0]) ? Home : Campaign

//console.log(homeComponent);
const routes = [
    {
        path: '/', 
        name: 'campaign',
        component: homeComponent
    },
    {
        path: '/login', 
        name: 'login',
        component: LoginBtn
    },
    {
        path: '/dashboard', 
        component: Dashboard,
        meta: { requiresAuth: true },
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

router.beforeEach((to, from, next) => {
    //console.log(to, from, next);
    if(to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        let authed = router.app.$store.getters.authed;
        console.log(authed);
        if (!authed) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
});

sync(store, router)

const app = new Vue({
    el: '#app',

    created(){
        //console.log('[App] App is ready');
        store.dispatch('getUser');
    },

    router,

    store,

    components: {
        Errors,
        CampaignEdit
    },

    methods: {
        /*...mapActions([
            'checkUserIsLogin',
        ])*/
    }
});
