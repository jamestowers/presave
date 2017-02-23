import * as types from './mutation-types';

/* ERRORS */
export const setErrors = ({ commit }, errors) => {
    
    commit(types.SET_ERRORS, { errors: errors })
};

export const clearErrors = ({ commit }) => {
    
    commit(types.CLEAR_ERRORS)
};



/* USER */
export const setUser = ({ commit }, user) => {
    commit(types.SET_USER, { user: user })
};

export const clearUser = ({ commit }) => {
    commit(types.CLEAR_USER)
};

export const setSpotifyToken = ({ commit }, data) => {
    //console.log('[actions.js] ' + data.token);
    commit(types.SET_SPOTIFY_TOKEN, { token: data.token })
};