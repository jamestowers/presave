import Vuex from 'vuex';
import Vue from 'vue';
import * as actions from './actions';
import errors from './modules/errors';
import user from './modules/user';
import app from './modules/app';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

const store = new Vuex.Store({
    actions,
    modules: {
        app,
        errors,
        user
    },
    strict: debug
});

export default store;