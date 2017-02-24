import Vue from 'vue';
import VueRouter from 'vue-router'
import VueCookie from 'vue-cookie';

import store from './vuex/store';
import { sync } from 'vuex-router-sync'
import { mapActions } from 'vuex';
import auth from './auth.js'
//import { getErrors } from './vuex/actions';
//require('./bootstrap');
//import { checkUserIsLogin } from './vuex/actions';

import Errors from './components/Errors.vue';
import Home from './components/Home.vue'
import Campaign from './components/Campaign.vue'
import Dashboard from './components/Dashboard.vue'
import LoginBtn from './components/LoginBtn.vue'
import Register from './components/Auth/Register.vue'
import Login from './components/Auth/Login.vue'
import CampaignEdit from './components/CampaignEdit.vue'

window._ = require('lodash');
window.Vue = require('vue');

require('vue-resource');

Vue.use(VueCookie);
Vue.use(VueRouter);

/*localStorage.removeItem('id_token')
localStorage.removeItem('user')*/

const is_production_env = process.env.NODE_ENV == 'production';
Vue.config.devtools = !is_production_env;
Vue.config.debug = is_production_env;
Vue.config.silent = is_production_env;
Vue.http.options.root = is_production_env ? 'https://presave.tracks2.com/api' : '/api';
Vue.http.options.credentials = true;
Vue.http.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application/json'
    //'Authorization': 'Bearer ' + Vue.cookie.get('session_token')
};


let reg = new RegExp('www|presaver|presave')
let parts = window.location.host.split('.')
let homeComponent = reg.test(parts[0]) ? Dashboard : Campaign


const routes = [
    {
        path: '/', 
        name: 'campaign',
        component: homeComponent
    },
    {
        path: '/login', 
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
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

export const router = new VueRouter({
    mode: 'history',
    routes // short for routes: routes
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        let authed = (Vue.cookie.get('session_token') !== null)
        //console.log('Logged in: ' + authed);
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

    data(){
        return{
            //
        }
    },
    created(){
        //console.log('[App] App is ready');
        //store.dispatch('getUser');
    },

    mounted: function () {
        this.$nextTick(function () {
            if(this.$cookie.get('session_token')){
                Vue.http.headers.common['Authorization'] = 'Bearer ' + this.$cookie.get('session_token')
                auth.check()
            }

            if(this.$cookie.get('spotify_token')){
                this.$store.dispatch('setSpotifyToken', {
                    token: this.$cookie.get('spotify_token')
                });
                Vue.http.headers.common['Authorization'] = 'Bearer ' + this.$cookie.get('spotify_token')
            }

        })

    },

    router,

    store,

    components: {
        Errors
    }

});
