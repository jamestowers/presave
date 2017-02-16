import { SET_ERRORS, CLEAR_ERRORS } from '../mutation-types';

const state = {
  errors: []
}

const getters = {
    errors: (state) => state.errors
}

const mutations = {

  [SET_ERRORS](state, payload){
    console.log(payload.errors)
    state.errors = payload.errors;
  },

  [CLEAR_ERRORS](state, payload){
    state.errors = [];
  }

}

export default {
  state,
  getters,
  mutations
}