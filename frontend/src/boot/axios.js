import {boot} from 'quasar/wrappers'
import axios from 'axios'

const UserToken = window.localStorage.getItem("access_token")
const AuthStr = `Bearer ${UserToken}`;
const api = axios.create({
    baseURL: `${window.localStorage.getItem('app_url')}/`,
    headers: {
        'Authorization': AuthStr,
        'Accept': 'application/json',
        'Access-Control-Allow-Origin': '*',
    },
})

export default boot(({app}) => {
    app.config.globalProperties.$axios = axios
    app.config.globalProperties.$api = api
})

export {api}
