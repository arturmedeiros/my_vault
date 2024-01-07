<template>
    <q-layout ref="layout" view="lHh Lpr lFf">
        <q-page-container style="padding-top: 0!important; padding-bottom: 0!important;">
            <q-page :class="($q.screen.xs || $q.screen.sm) ? 'bg-white' : 'bg-menu'"
                    class="text-white text-center flex flex-center">
                <div
                    :style="($q.screen.xs || $q.screen.sm) ? 'padding-bottom: 20px;' : 'padding-top: 60px; padding-bottom: 60px;'">
                    <q-card class="animated fadeInUp"
                            :class="($q.screen.xs || $q.screen.sm) ? 'shadow-0' : ''"
                            :style="($q.screen.xs || $q.screen.sm) ?
                          'width: 500px; max-width: 100vw; border-radius: 0;' :
                           'width: 500px; max-width: 80vw; border-radius: 20px;'"
                            style="">
                        <q-card-section>
                            <div style="">
                                <div style="">
                                    <transition
                                        appear
                                        enter-active-class="animated fadeIn"
                                        leave-active-class="animated fadeOut">
                                        <!--Conteúdo-->
                                        <div style="">
                                            <q-card style=""
                                                    class="shadow-0 q-pt-none text-grey-8">
                                                <!--Loading-->
                                                <Loading v-if="configs.loading"/>

                                                <!--Login-->
                                                <div class="animated fadeIn" v-if="!configs.loading && step === 1">
                                                    <q-card-section class="q-pt-md q-pb-none shadow-0" v-if="true">
                                                        <q-card class="q-pa-xs q-pt-md text-center shadow-0">
                                                            <div class="row">
                                                                <div class="col-12 text-center">
                                                                    <img :src="logotipo"
                                                                         style="height: 145px; width: auto;"
                                                                         class="q-pt-xs">
                                                                </div>
                                                                <div v-if="false"
                                                                     class="col-12 q-pt-lg q-pb-md q-px-lg text-center text-grey-8"
                                                                     style="font-size: 1.3rem; font-weight: 500;">
                                                                    <span class="text-grey-9" style="font-weight: 600;">Vault</span>
                                                                </div>
                                                            </div>
                                                        </q-card>
                                                    </q-card-section>
                                                    <q-card-section class="q-pt-none">
                                                        <q-card class="shadow-0 q-px-xs">
                                                            <q-form
                                                                @keypress.enter="user.email && user.password ? login() : null">
                                                                <q-list v-if="true" class="bg-white">
                                                                    <div class="">
                                                                        <div class="row q-px-xs justify-between"
                                                                             :style="($q.screen.xs || $q.screen.sm) ? '' : ''">
                                                                            <div
                                                                                class="col-md-12 col-sm-12 col-xs-12 cursor-default">
                                                                                <q-input
                                                                                    label="E-mail"
                                                                                    type="email"
                                                                                    style="font-size: 16px;"
                                                                                    color="primary"
                                                                                    v-model="user.email"
                                                                                    class="q-px-xs q-pb-md">
                                                                                </q-input>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-12 col-sm-12 col-xs-12 cursor-default">
                                                                                <q-input
                                                                                    label="Senha"
                                                                                    style="font-size: 16px;"
                                                                                    :type="hide_pass ? 'password' : 'text'"
                                                                                    v-model="user.password"
                                                                                    color="primary"
                                                                                    class="q-px-xs q-pb-md">
                                                                                    <template v-slot:append>
                                                                                        <q-icon
                                                                                            @click="hide_pass = !hide_pass"
                                                                                            :name="hide_pass ? 'visibility' : 'visibility_off'"
                                                                                            size="xs"
                                                                                            class="q-pr-sm cursor-pointer"></q-icon>
                                                                                    </template>
                                                                                </q-input>
                                                                            </div>
                                                                            <div v-if="me.error_login"
                                                                                 class="animated fadeInUp col-md-12 col-sm-12 col-xs-12 q-pt-sm q-pb-xs cursor-default">
                                                                                <q-banner dense inline-actions
                                                                                          style="border-radius: 50px;"
                                                                                          class="text-white bg-red-5">
                                                                                    {{ me.error_login }}
                                                                                    <template v-slot:action>
                                                                                        <q-btn flat
                                                                                               @click="closeError()"
                                                                                               round color="white"
                                                                                               icon="close"/>
                                                                                    </template>
                                                                                </q-banner>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-12 col-sm-12 col-xs-12 q-pt-lg q-pb-lg q-px-xs">
                                                                                <q-btn unelevated
                                                                                       @click="user.email && user.password ? login() : null"
                                                                                       :disable="!validateEmail((user.email)) || !user.password"
                                                                                       color="primary"
                                                                                       class="full-width"
                                                                                       rounded>
                                                                                    <q-item-label class="q-py-md flex">
                                                                                        <q-icon name="loging"
                                                                                                class="q-pr-sm"
                                                                                                style="font-size: 16px;"></q-icon>
                                                                                        Entrar
                                                                                    </q-item-label>
                                                                                </q-btn>
                                                                            </div>

                                                                            <div v-if="false"
                                                                                 class="col-md-12 col-sm-12 col-xs-12 q-pt-md q-px-xs">
                                                                                <q-btn unelevated
                                                                                       outline
                                                                                       @click="step = 2"
                                                                                       color="grey-8"
                                                                                       class="full-width"
                                                                                       rounded>
                                                                                    <q-item-label class="q-py-sm flex">
                                                                                        <q-icon name="person_add"
                                                                                                class="q-pr-md"
                                                                                                style="font-size: 16px;"></q-icon>
                                                                                        <div class="">Esqueci a senha
                                                                                        </div>
                                                                                    </q-item-label>
                                                                                </q-btn>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </q-list>
                                                            </q-form>
                                                        </q-card>
                                                    </q-card-section>
                                                </div>
                                            </q-card>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </q-card-section>
                    </q-card>
                </div>
            </q-page>
        </q-page-container>
    </q-layout>


</template>

<script>
import Loading from "components/general/Loading";
import logotipo from "assets/images/logo_color.png";

export default {
    name: "Login",
    components: {
        Loading
    },
    data() {
        return {
            logotipo: logotipo,
            step: 1,
            hide_pass: true,
            user: {
                url: null,
                email: null,
                password: null,
            },
            error_valid_mail: null,
            valid_mail: null
        }
    },
    created() {
        setTimeout(() => {
            this.$store.commit('SET_LOADING', false)
        }, 1200)
        if (window.localStorage.getItem('access_token')) {
            this.$router.push({name: 'Home'})
        }
    },
    watch: {},
    methods: {
        closeError() {
            this.$store.commit('SET_ERROR', null)
        },
        async login() {
            this.user.app_key = this.app_config.app_key;
            await this.$store.dispatch("loginUser", this.user);
        },
        validateEmail(email) {
            let re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    }
}
</script>

<style scoped>
</style>
