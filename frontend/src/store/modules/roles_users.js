import {api} from "boot/axios";

const roles_users = {
    state: {
        data: [],
        role_user: {},
        loaded: false
    },
    getters: {},
    mutations: {
        SET_ROLES_USERS_DATA(state, payload) {
            state.data = payload
        },
        SET_ROLE_USER(state, payload) {
            state.role_user = payload;
        },
        SET_ROLES_USERS_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        setRolesUsersData(context) {
            context.commit("SET_ROLES_USERS_LOADED", false)
            api.get(`/admin/roles_users`).then(response => {
                context.commit("SET_ROLES_USERS_DATA", response.data)
                context.commit("SET_ROLES_USERS_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        setUserRole(context, payload) {
            api.put(`/admin/roles_users/${payload.key}`, payload).then(response => {
                this.dispatch('setRolesUsersData');
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
    }
}

export default roles_users;
