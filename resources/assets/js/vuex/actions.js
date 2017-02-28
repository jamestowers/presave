import * as types from './mutation-types';

/************************************
ERRORS 
*************************************/
export const setErrors = ({ commit }, errors) => {
    
    commit(types.SET_ERRORS, { errors: errors })
};

export const clearErrors = ({ commit }) => {
    
    commit(types.CLEAR_ERRORS)
};



/************************************
USER 
*************************************/
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



/************************************
DIMENSIONS 
*************************************/

export const setDimensions = ({ commit }) => {
    
    let w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName('body')[0],
    x = w.innerWidth||e.clientWidth||g.clientWidth,
    y = w.innerHeight||e.clientHeight||g.clientHeight;

    let dimensions = {
        height: y,
        width: x,
        isMobile: x < 768
    }
    commit(types.SET_APP_DIMENSIONS, { dimensions: dimensions });
};