<template>
    <q-list class="text-white">
        <!-- TOP -->
        <q-item style="height: 85px;">
            <q-item-section style="min-width: 42px; width: 40px;" avatar>
                <img :src="logotipo"
                     style="height: 32px; width: 32px;"
                     class="">
            </q-item-section>
            <q-item-section>
                <q-item-label style="font-size: 1.4rem; cursor: default;">
                    <span style="font-weight: 300;">My </span>
                    <span style="font-weight: 600;">Vault</span>
                </q-item-label>
            </q-item-section>
        </q-item>

        <!-- LINKS  -->
        <q-item @click="this.goToRoute('Home')"
                :exact="this.$route.name === 'Home'"
                :class="this.$route.name === 'Home' ? 'active' : ''"
                clickable v-ripple>
            <q-item-section style="min-width: 45px;" v-if="true" avatar>
                <q-icon name="window"/>
            </q-item-section>
            <q-item-section>
                <q-item-label>
                    Dashboard
                </q-item-label>
            </q-item-section>
            <q-item-section v-if="false" avatar>
                <q-badge rounded text-color="black" color="white" label="1"/>
            </q-item-section>
        </q-item>

        <q-item @click="this.goToRoute('Passwords')"
                :exact="this.$route.name === 'Passwords'"
                :class="this.$route.name === 'Passwords' ? 'active' : ''"
                clickable v-ripple>
            <q-item-section style="min-width: 45px;" v-if="true" avatar>
                <q-icon name="password"/>
            </q-item-section>
            <q-item-section>
                <q-item-label>Passwords</q-item-label>
            </q-item-section>
            <q-item-section v-if="true" avatar>
                <q-badge rounded text-color="black"
                         color="white"
                         :label="passwords.data && passwords.data.total ? passwords.data.total : 0"/>
            </q-item-section>
        </q-item>

        <q-item @click="this.goToRoute('Users')"
                :exact="this.$route.name === 'Users'"
                :class="this.$route.name === 'Users' ? 'active' : ''"
                clickable v-ripple>
            <q-item-section style="min-width: 45px;" v-if="true" avatar>
                <q-icon name="manage_accounts"/>
            </q-item-section>
            <q-item-section>
                <q-item-label>Users</q-item-label>
            </q-item-section>
            <q-item-section v-if="true" avatar>
                <q-badge rounded text-color="black" color="white" label="25"/>
            </q-item-section>
        </q-item>

        <q-item @click="this.goToRoute('Groups')"
                :exact="this.$route.name === 'Groups'"
                :class="this.$route.name === 'Groups' ? 'active' : ''"
                active-class="active"
                clickable v-ripple>
            <q-item-section style="min-width: 45px;" v-if="true" avatar>
                <q-icon name="supervisor_account"/>
            </q-item-section>
            <q-item-section>
                <q-item-label>Groups</q-item-label>
            </q-item-section>
            <q-item-section v-if="true" avatar>
                <q-badge rounded text-color="black" color="white" label="25"/>
            </q-item-section>
        </q-item>

        <q-item @click="this.goToRoute('Settings')"
                :exact="this.$route.name === 'Settings'"
                :class="this.$route.name === 'Settings' ? 'active' : ''"
                active-class="active"
                clickable v-ripple>
            <q-item-section style="min-width: 45px;" v-if="true" avatar>
                <q-icon name="settings"/>
            </q-item-section>
            <q-item-section>
                <q-item-label>Settings</q-item-label>
            </q-item-section>
        </q-item>

        <q-separator color="#022b3c" v-show="false" inset class="q-my-none"/>

        <q-item @click="this.$store.dispatch('logoutUser')"
                :exact="this.$route.name === 'Logout'"
                :class="this.$route.name === 'Logout' ? 'active' : ''"
                active-class="active"
                clickable v-ripple>
            <q-item-section style="min-width: 45px;" v-if="true" avatar>
                <q-icon name="logout"/>
            </q-item-section>
            <q-item-section>
                <q-item-label>Sair</q-item-label>
            </q-item-section>
        </q-item>
    </q-list>

    <div style="position: fixed;
                bottom: 0;
                width: 100%;"
         class="q-my-sm">
        <q-item @click="this.goToRoute('Account')"
                class="text-white" clickable v-ripple>
            <q-item-section side>
                <q-avatar round size="40px">
                    <img :src="me && me.user.avatar ? me.user.avatar : no_pic"/>
                </q-avatar>
            </q-item-section>
            <q-item-section>
                <q-item-label style="font-weight: 600;" class="text-white">
                    {{ me.user && me.user.name ? me.user.name : '' }}
                </q-item-label>
                <q-item-label class="text-grey-6" caption>
                    {{ me && me.user.email ? me.user.email : '' }}
                </q-item-label>
            </q-item-section>
            <q-item-section v-if="true" avatar>
                <q-icon size="12px" name="arrow_forward_ios"/>
            </q-item-section>
        </q-item>
    </div>
</template>

<script>

import {defineComponent} from "vue";
import logotipo from "assets/images/logo_dark_shadow.png";
import no_pic from "assets/images/no-pic-user.png";

export default defineComponent({
    name: 'DrawerMenuLeft',
    data() {
        return {
            logotipo: logotipo,
            no_pic: no_pic
        }
    },
    props: [],
    computed: {}
})
</script>

<style scoped>
.active {
    color: white;
    /*background: #213241;*/
    background: #012737;
}
</style>
