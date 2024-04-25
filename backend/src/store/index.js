import {createStore} from "vuex"; //importam functia "createStore" din vuex
import * as actions from './actions';
import * as mutations from './mutations';
import state from "@/store/state.js";

const store = createStore({ //creeam instanta store si proprietatile acesteia
    state,
    getters: {},
    actions,
    mutations,
})

export default store //exportam instanta pt a putea fi folosita si in alte module

