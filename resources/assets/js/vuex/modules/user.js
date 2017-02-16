import { SET_USER } from '../mutation-types';

const state = {
    authed: false,
    user: []
}

const getters = {
    user: (state) => state.user,
    authed: (state) => state.authed
}

const mutations = {

  [SET_USER](state, payload){
    state.user = payload.user;
    state.authed = true;
  }

}

export default {
  state,
  getters,
  mutations
}