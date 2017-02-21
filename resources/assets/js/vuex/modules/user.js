import { SET_USER, CLEAR_USER } from '../mutation-types';

const state = {
    user: []
}

const getters = {
    user: (state) => state.user
}

const mutations = {

  [SET_USER](state, payload){
    state.user = payload.user;
  },

  [CLEAR_USER](state){
    state.user = [];
  }

}

export default {
  state,
  getters,
  mutations
}