import * as types from './mutation-types';

/* ERRORS */
export const setErrors = ({ commit }, errors) => {
    
    commit(types.SET_ERRORS, { errors: errors });
};

export const clearErrors = ({ commit }) => {
    
    commit(types.CLEAR_ERRORS);
};



/* USER */
export const getUser = ({ commit }, user) => {
    Vue.http.get('/user')
        .then(function(response){
            if(response.data.user){
                commit(types.SET_USER, { user: response.data.user });
            }
        }, 
        function(error){
            console.error(error);
        });
};