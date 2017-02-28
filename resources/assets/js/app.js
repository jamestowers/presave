import Vue from 'vue';
import VueRouter from 'vue-router'
import VueCookie from 'vue-cookie';

import store from './vuex/store';
import { sync } from 'vuex-router-sync'
import auth from './auth.js'

import Errors from './components/Errors.vue';

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
let homeComponent = reg.test(parts[0]) ? 'Dashboard' : 'Campaign'


const routes = [
    {
        path: '/', 
        name: 'home',
        component: resolve => require(['./components/'+ homeComponent +'.vue'], resolve)
    },
    {
        path: '/campaigns/:id', 
        name: 'campaign',
        component: resolve => require(['./components/Campaign.vue'], resolve)
        
    },
    {
        path: '/dashboard', 
        component: resolve => require(['./components/Dashboard.vue'], resolve),
        meta: { requiresAuth: true },
        children: [
            { 
                path: '', 
                name: 'campaigns',
                component: resolve => require(['./components/Campaigns.vue'], resolve)
                
            },
            { 
                path: 'campaigns/create', 
                name: 'campaigns-create',
                component: resolve => require(['./components/CampaignEdit.vue'], resolve)
                
            },
            { 
                path: 'campaigns/edit/:campaignId', 
                name: 'campaigns-edit',
                component: resolve => require(['./components/CampaignEdit.vue'], resolve)
                
            }
        ]
    },
    {
        path: '/dashboard/login', 
        name: 'login',
        component: resolve => require(['./components/Auth/Login.vue'], resolve)
    },
    {
        path: '/dashboard/register',
        name: 'register',
        component: resolve => require(['./components/Auth/Register.vue'], resolve)
        
    },
    {
        path: '*',
        name: 'campaign-by-slug',
        component: resolve => require(['./components/Campaign.vue'], resolve)
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
                name: 'login',
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
            domain: window.Laravel.domain
        }
    },
    created(){
        //console.log('[App] App is ready');
        //store.dispatch('getUser');
    },

    mounted: function () {
        let self = this
        this.$nextTick(function () {
            if(this.$cookie.get('session_token')){
                //console.log(this.$cookie.get('session_token'));
                Vue.http.headers.common['Authorization'] = 'Bearer ' + this.$cookie.get('session_token')
                
                auth.check().then(function(response) {
                  console.log("Logged in: ", response.data.name);
                }, function(error) {
                  console.error("Not logged in: ", error);
                  self.$router.push('login')
                });

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
