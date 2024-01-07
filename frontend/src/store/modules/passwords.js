import {api} from "boot/axios";

const passwords = {
    state: {
        data: [],
        password: {},
        loaded: false
    },
    getters: {},
    mutations: {
        SET_PASS_DATA(state, payload) {
            state.data = payload
        },
        SET_PASS(state, payload) {
            state.password = payload;
        },
        SET_PASS_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        setPasswordsData(context) {
            context.commit("SET_PASS_LOADED", false)
            api.get(`/vault/pass`).then(response => {
                context.commit("SET_PASS_DATA", response.data)
                context.commit("SET_PASS_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        setPassword(context, payload) {
            api.get(`/vault/pass/${payload.key}`).then(response => {
                context.commit("SET_PASS", response.data)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
    }
}

export default passwords;
