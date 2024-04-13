import {createStore} from "vuex"; //importam functia "createStore" din vuex
import * as actions from './actions';
import * as mutations from './mutations';

const store = createStore({ //creeam instanta store si proprietatile acesteia
    state: {
        user: {
            token: sessionStorage.getItem('TOKEN'),
            data: {}
        }
    },
    getters: {},
    actions,
    mutations,
})

export default store //exportam instanta pt a putea fi folosita si in alte module
