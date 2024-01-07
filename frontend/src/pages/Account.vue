<template>
    <q-page class="bg-grey-2"
            :class="($q.screen.xs || $q.screen.sm) ? 'q-pt-md' : 'q-pt-md'">
        <!-- Breadcrumbs -->
        <div :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-px-sm q-pt-none'
                    : 'q-px-md q-pt-sm'">
            <Breadcrumbs :cta="false"/>
        </div>

        <div class="animated fadeInUp q-pb-md"
             :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-px-none q-pt-none'
                    : 'q-px-md q-pt-md'">
            <div class="row q-pb-md"
                 :class="($q.screen.xs || $q.screen.sm)
                        ? 'q-px-none'
                        : 'q-px-md'">
                <div class="col-12">
                    <q-separator v-if="($q.screen.xs || $q.screen.sm)"/>
                    <q-card flat
                            :bordered="!($q.screen.xs || $q.screen.sm)"
                            :class="($q.screen.xs || $q.screen.sm)
                                    ? ''
                                    : 'border-radius-15'">
                        <!--Corpo do Card-->
                        <q-card-section class="bg-white q-pr-sm">
                            <div class="q-py-sm q-px-none">
                                <div v-if="true">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 cursor-default">
                                            <q-input rounded
                                                     v-model="myUser.name"
                                                     color="black"
                                                     class="bg-white q-px-md q-pb-md"
                                                     placeholder="Digite seu nome completo..."
                                                     label="Nome completo"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 q-pb-sm cursor-default">
                                            <q-input rounded
                                                     disable
                                                     v-model="me.user.email"
                                                     color="black"
                                                     class="bg-white q-px-md q-pb-md"
                                                     placeholder="Digite seu e-mail..."
                                                     label="E-mail"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 q-pb-sm cursor-default">
                                            <q-input rounded
                                                     v-model="myUser.phone"
                                                     color="black"
                                                     class="bg-white q-px-md q-pb-md"
                                                     placeholder="Digite seu telefone..."
                                                     label="Telefone"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 q-pb-sm cursor-default">
                                            <q-input rounded
                                                     v-model="pass"
                                                     color="black"
                                                     class="bg-white q-px-md q-pb-md"
                                                     placeholder="Digite uma senha..."
                                                     :type="hide_pass ? 'password' : 'text'"
                                                     hint="Deixe em branco se não quiser alterar"
                                                     label="Senha">
                                                <template v-slot:append>
                                                    <q-icon @click="hide_pass = !hide_pass"
                                                            :name="hide_pass ? 'visibility' : 'visibility_off'"
                                                            size="xs"
                                                            class="q-pr-sm cursor-pointer"></q-icon>
                                                </template>
                                            </q-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </q-card-section>

                        <q-separator class="q-px-sm" v-if="true" color="grey-3"/>

                        <q-card-section class="bg-white text-right">
                            <div class="q-py-sm q-px-md">
                                <q-btn rounded
                                       @click.stop="update()"
                                       unelevated
                                       class="shadow-0 text-white bg-primary q-py-sm"
                                       style="border-radius: 50px; text-transform: initial;">
                                    <q-item-label class="q-px-md" style="">Salvar</q-item-label>
                                </q-btn>
                            </div>
                        </q-card-section>
                    </q-card>
                    <q-separator v-if="($q.screen.xs || $q.screen.sm)"/>
                </div>
            </div>
        </div>
    </q-page>
</template>

<script>

import Breadcrumbs from "components/general/Breadcrumbs.vue";

export default {
    name: 'Account',
    components: {
        Breadcrumbs
    },
    data() {
        return {
            hide_pass: true,
            pass: null,
            myUser: {}
        }
    },
    watch: {},
    mounted() {
        this.myUser = this.xeroxHelper(this.me.user)
    },
    methods: {
        update() {
            const user = {
                key: this.me.user.key,
                email: this.me.user.email,
                name: this.myUser.name,
                phone: this.myUser.phone,
            }

            if (this.pass && this.pass !== '' && this.pass !== undefined) {
                user.password = this.xeroxHelper(this.pass)
            }

            user.app_url = this.app_config.app_url;
            this.$store.dispatch('updateUser', this.xeroxHelper(user))

            this.$q.notify({
                message: `Seus dados foram editados!`,
                color: 'white',
                textColor: 'grey-9',
                position: 'bottom-right',
                icon: 'announcement',
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
        }
    }
}
</script>

<style scoped>

</style>
