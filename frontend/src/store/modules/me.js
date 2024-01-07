import {api} from "boot/axios";

const me = {
    state: {
        user: {},
        error_login: null,
        loaded: false,
    },
    getters: {},
    mutations: {
        SET_ERROR(state, payload) {
            state.error_login = payload
        },
        SET_ME(state, payload) {
            state.user = payload;
        },
        SET_ME_LOADED(state, payload) {
            state.loaded = payload;
        },
    },
    actions: {
        getMe(context) {
            context.commit("SET_ME_LOADED", false)
            api.post(`${window.localStorage.getItem('app_url')}/auth/me`).then(response => {
                context.commit("SET_ME", response.data)
                context.commit("SET_ME_LOADED", true)
            }).catch(error => {
                if (error.response && error.response.status === 401) {
                    this.dispatch('logoutUser');
                }
            });
        },
        setMe(context, payload) {
            this.dispatch('setUser', payload);
            this.dispatch('getMe');
        },
        loginUser(context, payload) {
            api.post(`${window.localStorage.getItem('app_url')}/auth/login`, payload).then(response => {
                window.localStorage.access_token = response.data.access_token
                setTimeout(() => {
                    window.location = "/";
                    context.commit("SET_ERROR", null)
                }, 300)
            }).catch(error => {
                window.localStorage.clear()
                context.commit("SET_ME", {})
                if (error.response && error.response.status === 401 || error.response && error.response.status === 500) {
                    context.commit("SET_ERROR", 'Credenciais inválidas! Confira os dados informados.')
                }
                if (error.response && error.response.status === 404) {
                    context.commit("SET_ERROR", 'Ops! Algo deu errado... Tente novamente.')
                }
            }).finally(() => {
            });
        },
        logoutUser(context, payload) {
            let tempEmail = window.localStorage.getItem('user_email') ?? null

            api.post(`${window.localStorage.getItem('app_url')}/auth/logout`, payload).then(response => {
                window.localStorage.clear()
                context.commit("SET_ME", {})
                window.location = "/login";

                if (tempEmail) {
                    window.localStorage.setItem('user_email', tempEmail)
                }
            }).catch(error => {
                window.localStorage.clear()
                context.commit("SET_ME", {})
                window.location = "/login";
                if (tempEmail) {
                    window.localStorage.setItem('user_email', tempEmail)
                }
            });
        },
    }
}

export default me;
