import {api} from "boot/axios";

const types = {
    state: {
        data: [],
        type: {},
        loaded: false,
    },
    getters: {},
    mutations: {
        SET_TYPES_DATA(state, payload) {
            state.data = payload
        },
        SET_TYPE(state, payload) {
            state.type = payload;
        },
        SET_TYPES_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        setTypesData(context) {
            context.commit("SET_TYPES_LOADED", false)
            api.get(`/vault/types`).then(response => {
                context.commit("SET_TYPES_DATA", response.data)
                context.commit("SET_TYPES_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        setType(context, payload) {
            api.put(`/vault/types/${payload.key}`, payload).then(response => {
                context.commit("SET_TYPE", response.data)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        }
    }
}

export default types;
