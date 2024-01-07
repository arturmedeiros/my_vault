<template>
    <div>
        <q-header
            v-if="($q.screen.xs || $q.screen.sm)"
            class="bg-menu"
            elevated>
            <q-toolbar class="q-py-md q-px-md">
                <q-btn
                    flat
                    dense
                    round
                    @click="toggleLeftDrawer"
                    aria-label="Menu"
                    icon="menu"
                />
                <q-toolbar-title
                    @click="$router.push({ name: 'Home' })"
                    :class="($q.screen.xs || $q.screen.sm) ? 'text-white' : 'text-grey-9'"
                    class="flex cursor-default items-center">
                    <div class="flex cursor-pointer">
                        <img :src="($q.screen.xs || $q.screen.sm) ? logotipo : logotipo"
                             style="height: 30px; width: auto;"
                             class="">
                    </div>
                    <div class="q-pl-sm block cursor-pointer">
                        <div class="q-pl-xs"
                             style="font-size: 1.5rem;
             cursor: default;">
                            <span style="font-weight: 300;">My </span>
                            <span style="font-weight: 600;">Vault</span>
                        </div>
                    </div>
                </q-toolbar-title>
                <div class="q-gutter-sm row items-center no-wrap">
                    <q-btn round
                           dense
                           flat
                           @click="this.goToRoute('Account')"
                           :color="($q.screen.xs || $q.screen.sm) ? 'white' : 'grey-7'"
                           icon="account_circle">
                        <q-tooltip>Minha conta</q-tooltip>
                    </q-btn>
                    <q-btn round
                           dense
                           flat
                           @click="$store.dispatch('logoutUser', {app_url: this.app_config.app_url})"
                           :color="($q.screen.xs || $q.screen.sm) ? 'white' : 'grey-7'"
                           icon="logout">
                        <q-tooltip>Sair</q-tooltip>
                    </q-btn>
                </div>
            </q-toolbar>
        </q-header>

        <!-- Menu Esquerdo -->
        <q-drawer
            show-if-above
            elevated
            v-model="leftDrawerOpen"
            class="bg-menu text-white"
            :width="250"
        >
            <DrawerMenuLeft/>
        </q-drawer>
    </div>
</template>

<script>
import logotipo from "assets/images/logo_dark_shadow.png";
import DrawerMenuLeft from "layouts/DrawerMenuLeft";
import {ref} from "vue";

export default {
    name: 'HeaderDefault',
    components: {
        DrawerMenuLeft
    },
    data() {
        return {
            logotipo: logotipo,
        }
    },
    methods: {},
    setup() {
        const leftDrawerOpen = ref(false)

        function toggleLeftDrawer() {
            leftDrawerOpen.value = !leftDrawerOpen.value
        }

        return {
            leftDrawerOpen,
            toggleLeftDrawer
        }
    },
}
</script>
