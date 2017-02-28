import { SET_APP_DIMENSIONS, CLEAR_APP_DIMENSIONS } from '../mutation-types';

const state = {
  dimensions: []
}

const getters = {
    dimensions: (state) => state.dimensions,
    isMobile: (state) => state.dimensions.isMobile,
    screenSize: (state) => {
      if(state.dimensions.width <= 800){
        return 'small'
      } else if (state.dimensions.width <= 1400){
        return 'medium'
      }else if (state.dimensions.width <= 1400){
        return 'large'
      } else {
        return 'xlarge'
      }
    }
}

const mutations = {

  [SET_APP_DIMENSIONS](state, payload){
    //console.log(payload.dimensions)
    state.dimensions = payload.dimensions;
  }

}

export default {
  state,
  getters,
  mutations
}