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
            state.password = {
                name       : payload.name,
                pass       : payload.pass_decrypt,
                description: payload.description ? payload.description : null,
                login      : payload.login ? payload.login : null,
                link       : payload.preferences && payload.preferences.link ? payload.preferences.link : null,
                type_key   : payload.type_key,
                type       : {
                    value: payload.type.key,
                    name : payload.type.name,
                    icon : payload.type.preferences && payload.type.preferences.icon,
                },
            };
            if (payload.key) {
                state.password.key = payload.key
            }
        },
        SET_PASS_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        getPasswordsData(context) {
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
        getPassword(context, payload) {
            api.get(`/vault/pass/${payload.key}`).then(response => {
                context.commit("SET_PASS", response.data)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        storePassword(context, payload) {
            api.post(`/vault/pass`, payload).then(response => {
                this.dispatch("getPasswordsData");
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        putPassword(context, payload) {
            api.put(`/vault/pass/${payload.key}`, payload).then(response => {
                this.dispatch("getPasswordsData");
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
    }
}

export default passwords;
