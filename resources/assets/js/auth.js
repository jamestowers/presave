import Vue from 'vue';
import { router } from './app.js';
import store from './vuex/store';

export default {
    user: {
        authenticated: false,
        profile: null
    },
    check() {
        if (localStorage.getItem('id_token') !== null) {
            Vue.http.get('user').then(response => {
                store.dispatch('setUser', {
                    authenticated: true,
                    profile: response.data.data
                });
            })
        }
    },
    register(context, name, email, password) {
        Vue.http.post(
            'register',
            {
                name: name,
                email: email,
                password: password
            }
        ).then(response => {
            context.success = true
        }, response => {
            context.response = response.data
            context.error = true
            store.dispatch('setErrors', [response.data.error])
        })
    },
    login(context, email, password) {
        Vue.http.post(
            'login',
            {
                email: email,
                password: password
            }
        ).then(response => {
            context.error = false
            localStorage.setItem('id_token', response.data.meta.token)
            Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token')

            store.dispatch('setUser', {
                authenticated: true,
                profile: response.data.data
            })

            router.push({
                name: 'campaigns'
            })
        }, response => {
            context.error = true
            store.dispatch('setErrors', [response.data.error])
        })
    },
    logout() {
        localStorage.removeItem('id_token')
        this.user.authenticated = false
        this.user.profile = null
        store.dispatch('clearUser', this.user);

        router.push({
            name: '/'
        })
    }
}