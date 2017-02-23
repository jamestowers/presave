import Vue from 'vue';
import { router } from './app';
import store from './vuex/store';

export default {
    user: {
        authenticated: false,
        profile: null
    },

    setUser(data, token = null){
        store.dispatch('setUser', {
            profile: data.data,
            token: Vue.cookie.get('session_token')
        })
        this.user.authenticated = true
        console.log('Logged in: ' + store.getters.user.name);
    },

    check() {
        if (Vue.cookie.get('session_token') !== null) {
            Vue.http.get('user').then(response => {
                if(response.data){
                    this.setUser(response.data)
                }else{
                    return false
                }
            })
        }
        return false;
    },

    register(context, name, email, password) {
        Vue.http.post('register',
            {
                name: name,
                email: email,
                password: password
            }
        ).then(response => {
            context.success = true
            router.push({
                name: 'login'
            })
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
            Vue.cookie.set('session_token', response.data.meta.token, { expires: '1M' })
            Vue.http.headers.common['Authorization'] = 'Bearer ' + response.data.meta.token

            this.setUser(response.data)

            let redirectTo = store.state.route.query.redirect || '/dashboard'
            router.push({
                path: redirectTo
            })
        }, response => {
            context.error = true
            store.dispatch('setErrors', [response.data.error])
        })
    },

    logout() {

        Vue.cookie.delete('session_token')
        store.dispatch('clearUser');

        router.push({
            path: '/'
        })
    }
}