import {api} from "boot/axios";

const users = {
    state: {
        data: [],
        user: {},
        loaded: false
    },
    getters: {},
    mutations: {
        SET_USERS_DATA(state, payload) {
            state.data = payload
        },
        SET_USER(state, payload) {
            state.user = payload;
        },
        SET_USERS_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        setUsersData(context) {
            context.commit("SET_USERS_LOADED", false)
            api.get(`/vault/pass`).then(response => {
                context.commit("SET_USERS_DATA", response.data)
                context.commit("SET_USERS_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        setUser(context, payload) {
            context.commit("SET_USERS_LOADED", false)
            api.put(`/v1/users/${payload.key}`, payload).then(response => {
                context.commit("SET_USER", response.data)
                context.commit("SET_USERS_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
    }
}

export default users;
