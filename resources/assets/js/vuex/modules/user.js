import { SET_USER, CLEAR_USER, SET_SPOTIFY_TOKEN } from '../mutation-types';

const state = {
    profile: {},
    sessionToken: null,
    spotifyToken: null
}

const getters = {
    authenticated: (state) => Object.keys(state.profile).length > 0,
    user: (state) => state.profile,
    spotifyToken: (state) => state.spotifyToken
}

const mutations = {

  [SET_USER](state, payload){
    //console.log(payload.user);
    state.profile = payload.user.profile;
    state.sessionToken = payload.user.token;
  },

  [CLEAR_USER](state){
    state.profile = {};
    state.sessionToken = null;
  },

  [SET_SPOTIFY_TOKEN](state, payload){
    state.spotifyToken = payload.token;
  },

}

export default {
  state,
  getters,
  mutations
}