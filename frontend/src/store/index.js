import {store} from 'quasar/wrappers'
import {createStore} from 'vuex'

import configs from './modules/configs'
import me from './modules/me'
import passwords from './modules/passwords'
import roles from './modules/roles'
import roles_users from "src/store/modules/roles_users";
import types from './modules/types'
import users from './modules/users'

export default store(function (/* { ssrContext } */) {
    const Store = createStore({
        modules: {
            configs,
            me,
            passwords,
            roles,
            roles_users,
            types,
            users,
        },

        strict: process.env.DEBUGGING
    })

    return Store
})
