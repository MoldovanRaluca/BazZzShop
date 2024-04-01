import {createStore} from "vuex"; //importam functia createStore din vuex

const store = createStore({ //creeam instanta store si proprietatile acesteia
    state: {
        test: '1234'
    },
    getters: {},
    actions: {},
    mutations: {},
})

export default store //exportam instanta pt a putea fi folosita si in alte module
