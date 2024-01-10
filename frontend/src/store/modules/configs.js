import {api} from "boot/axios";

const configs = {
    state: {
        app_version: '0.0.1',
        loaded: false,
        loading: false,
        scroll_position: 0,
        scroll_breakpoint: 285,
        scroll_breakpoint_desk: 355,
        menus: {
            left_default: false,
        },
        modals: {
            login: false,
            maximizedToggle: true,
            vault_modal: false,
            alert: false,
            pass_search: false,
            pass_modal: false,
        },
        modal_content: {
            alert: {
                title: "",
                content: "",
            }
        },
    },
    getters: {},
    mutations: {
        SET_LOADING(state, payload) {
            state.loading = payload
        },

        SET_LOADED(state, payload) {
            state.loaded = payload
        },

        SET_SCROLL_POSITION(state, context) {
            state.scroll_position = context;
        },

        SET_MODAL(state, modalKey) {
            state.modals[`${modalKey.key}`] = modalKey.state
            //console.log('SET_MODAL', modalKey)
        },

        SET_MENU_SIDEBAR_LEFT(state, payload) {
            state.menus.left_default = payload
        },
    },
    actions: {
        setLoader(context, payload) {
            context.commit("SET_LOADING", payload)
        },
        setLoadDataApi(context) {
            context.commit("SET_LOADING", true)
            this.dispatch('getMe', {app_url: window.localStorage.getItem('app_url')})
            this.dispatch('getPasswordsData')
            this.dispatch('setRolesData')
            this.dispatch('setRolesUsersData')
            this.dispatch('setUsersData')
            this.dispatch('setTypesData')
        }
    },
}

export default configs;
