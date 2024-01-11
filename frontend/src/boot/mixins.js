// Vuex
import {mapActions, mapGetters, mapState} from 'vuex'
import no_pic from "assets/images/no-pic.png"
import no_pic_user from "assets/images/no-pic-user.png"
import {copyToClipboard, useQuasar} from 'quasar'

const BaseUrl = process.env.BASE_URL ? process.env.BASE_URL : 'localhost'
//console.log('BaseUrl', process.env.BASE_URL);

const PROD = ![
    '192.168.15',
    '192.168.15.5',
    '192.168.15.4',
    '127.0.0.1',
    'localhost'
].includes(window.location.hostname);

export default async ({app}) => {
    app.mixin({
        computed: {
            ...mapState([
                'configs',
                'me',
                'passwords',
                'roles',
                'roles_users',
                'types',
                'users',
            ]),
            ...mapGetters([]),
            endLoading() {
                if (this.me.loaded &&
                    this.passwords.loaded &&
                    this.roles.loaded &&
                    this.roles_users.loaded &&
                    this.users.loaded &&
                    this.types.loaded) {
                    return true
                }
                else {
                    return false
                }
            },
            getTypesList() {
                let types_list = []

                if (this.types && this.types.data.length > 0) {
                    this.types.data.forEach(type => {
                        types_list.push({
                            "value": type.key,
                            "name": type.name,
                            "icon": type.preferences && type.preferences.icon,
                        })
                    })
                }

                return types_list;
            }
        },
        data() {
            return {
                no_pic: no_pic,
                no_pic_user: no_pic_user,
                toTop: 0,
                app_config: {
                    app_url: PROD
                        ? `${BaseUrl}/api/v1`
                        : `${BaseUrl}/api/v1`
                },
                drawer: true,
            }
        },
        setup() {
            const $q = useQuasar()
            $q.dialog({}) // returns Object

            return {}
        },
        mounted() {
            // Verifica tema ao montar aplicação
            this.checkTheme()
            if (this.app_config.app_url) {
                window.localStorage.removeItem('app_url')
                window.localStorage.setItem('app_url', this.app_config.app_url)
            }
        },
        methods: {
            removeBindHelper(payload) {
                return JSON.parse(JSON.stringify(payload))
            },
            refresh() {
                window.location.reload()
            },
            checkTheme() {
                this.$q.dark.isActive = !!window.localStorage.getItem('dark');
            },
            scrollHandler(position) {
                this.$store.commit('SET_SCROLL_POSITION', parseInt(position.position.top))
            },
            openUrl(link) {
                window.open(link, "_blank")
            },
            setLoaded() {
                setTimeout(() => {
                    this.$store.commit('SET_LOADED', false)
                    setTimeout(() => {
                        this.$store.commit("SET_LOADED", true);
                    }, 1000);
                }, 200)
            },
            setModal(modalKey) {
                // console.log(modalKey)
                if (modalKey) {
                    this.$store.commit('SET_MODAL', modalKey)
                }
            },
            copyPass(text) {
                copyToClipboard(text)
                    .then(() => {
                        this.$q.notify({
                            message: `Senha copiada!`,
                            color: 'white',
                            textColor: 'grey-9',
                            position: 'bottom-right',
                            icon: 'task_alt',
                            iconColor: 'green-8',
                            classes: 'border-radius-15',
                            actions: [
                                {
                                    icon: 'close',
                                    size: 'xs',
                                    color: 'grey-9',
                                    /*handler: () => {}*/
                                }
                            ]
                        })
                    })
                    .catch(() => {
                        // fail
                    })
            },
            premiumUser() {
                return this.isAdmin();
            },
            isAdmin() {
                return Boolean(
                    this.me.user.email === 'admin@mail.com'
                )
            },
            goToRoute(routeName) {
                this.$router.push({name: routeName})
            },
            generateSecPassword(size = 12) {
                const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
                let pass = "";

                for (let i = 0; i < size; i++) {
                    const indices = Math.floor(Math.random() * characters.length);
                    pass += characters.charAt(indices);
                }

                return pass;
            }
        },
        watch: {
            // Observa mudança de tema
            '$q.dark.isActive': function () {
                if (this.$q.dark.isActive) {
                    window.localStorage.setItem('dark', true);
                } else {
                    window.localStorage.removeItem('dark');
                }
            },
            // Observa mudança de rota
            '$route.name': function () {
                //
            },
            'endLoading': function () {
                if (this.endLoading) {
                    this.$store.commit("SET_LOADING", false)
                }
            }
        },
    })
}
