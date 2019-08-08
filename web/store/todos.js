export const state = () => ({
  message: 'Hello from Vuex',
  counter: 0
});

export const mutations = {
  increment(state, counter) {
      state.counter+=payload
  },
  less(state, counter) {
    state.counter-=payload
  },
  assign(state, counter) {
      state.counter = counter
  }
};

export const actions = () => ({
  increments(state, payload) {
    state.counter.commit('increment', payload)
  }
})

export const getters = {
  message(state) {
    return state.message + ' Getters';
  },
  counter(state) {
    return state.counter;
  }
}