import {api} from "boot/axios";

const roles = {
    state: {
        data: [],
        role: {},
        loaded: false
    },
    getters: {},
    mutations: {
        SET_ROLES_DATA(state, payload) {
            state.data = payload
        },
        SET_ROLE(state, payload) {
            state.role = payload;
        },
        SET_ROLES_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        setRolesData(context) {
            context.commit("SET_ROLES_LOADED", false)
            api.get(`/admin/roles`).then(response => {
                context.commit("SET_ROLES_DATA", response.data)
                context.commit("SET_ROLES_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        setRole(context, payload) {
            api.put(`/admin/roles/${payload.key}`, payload).then(response => {
                this.dispatch('setRolesData');
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
    }
}

export default roles;
