<template>
    <div>
        <!-- Loader -->
        <Loading v-show="configs.loading_table" height="300px"/>

        <!-- Content -->
        <div v-show="!configs.loading_table">

            <!-- Table -->
            <div v-if="passwords && passwords.data.total > 0">
                <q-markup-table class="border-radius-15" flat>
                    <thead>
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-center">Login</th>
                        <th class="text-center">Segurança</th>
                        <th class="text-center">Data de Criação</th>
                        <th v-if="true" class="text-center">Grupos</th>
                        <!-- Actions -->
                        <th v-if="true" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <template v-for="(item) in passwords.data.data" :key="item">
                            <tr class="cursor-pointer"
                                @click="setData(item)">
                                <td class="text-left">
                                    <q-item class="cursor-pointer q-pl-sm q-pr-none">
                                        <q-item-section class="q-pr-lg" avatar>
                                            <q-btn
                                                round
                                                unelevated
                                                text-color="white"
                                                class="bg-menu">
                                                <q-icon size="20px"
                                                        v-if="item.type && item.type.preferences && item.type.preferences.icon"
                                                        :name="item.type.preferences.icon"/>
                                                <q-tooltip v-if="!($q.screen.xs || $q.screen.sm) && item.type && item.type.preferences && item.type.preferences.icon"
                                                           class="bg-primary text-white">
                                                    {{ item.type.name }}
                                                </q-tooltip>
                                            </q-btn>
                                        </q-item-section>
                                        <q-item-section center>
                                            <q-item-label lines="1"
                                                          style="font-size: 1.1rem; font-weight: 500;"
                                                          class="text-weight-bold">
                                                {{ item.name }}
                                            </q-item-label>
                                            <q-item-label lines="1">
                                                {{ item.description }}
                                            </q-item-label>
                                        </q-item-section>
                                    </q-item>
                                </td>
                                <td class="text-center">
                                    <span v-if="item.login">{{ item.login }}</span>
                                    <q-icon v-else color="grey-5" size="18px" name="highlight_off"/>
                                </td>
                                <td class="text-center">
                                    <q-badge :color="checkLevel(item.pass_level).color" rounded>
                                        {{ checkLevel(item.pass_level).text }}
                                    </q-badge>
                                </td>
                                <td class="text-center">
                                    {{ item.created_date }} às {{ item.created_time }}
                                </td>
                                <td v-if="true" class="text-center">
                                    <div v-if="item.roles && item.roles.length > 0">
                                        <q-badge v-for="group in roleGroups(item.roles)"
                                                 :key="group"
                                                 color="primary"
                                                 bordered
                                                 rounded>
                                            {{ group }}
                                        </q-badge>
                                    </div>
                                    <div v-else>
                                        Nenhum
                                    </div>
                                </td>
                                <!-- Actions -->
                                <td v-if="true" class="text-center">
                                    <div>
                                        <div class="row justify-center">
                                            <q-list>
                                                <q-item class="q-pa-none">
                                                    <div class="text-grey-8 q-gutter-xs q-pr-none self-center">
                                                        <q-btn @click.stop="copyPass(item.pass_decrypt)"
                                                               v-if="true"
                                                               color="grey-7"
                                                               class=""
                                                               size="12px"
                                                               round
                                                               flat
                                                               icon="copy_all">
                                                            <q-tooltip v-if="!($q.screen.xs || $q.screen.sm)">
                                                                Copiar
                                                            </q-tooltip>
                                                        </q-btn>
                                                        <q-btn @click.stop="openUrl(item.preferences.link)"
                                                               v-if="item.preferences && item.preferences.link"
                                                               color="grey-7"
                                                               class=""
                                                               size="12px"
                                                               round
                                                               flat
                                                               icon="open_in_new">
                                                            <q-tooltip v-if="!($q.screen.xs || $q.screen.sm)">
                                                                Abrir link
                                                            </q-tooltip>
                                                        </q-btn>
                                                    </div>
                                                </q-item>
                                            </q-list>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </q-markup-table>

                <!-- Paginate -->
                <q-separator v-show="passwords.data && (passwords.data.total > passwords.data.per_page)" class=""/>
                <div v-show="passwords.data && (passwords.data.total > passwords.data.per_page)" class="row">
                    <div class="col-12 text-center q-py-sm q-px-md">
                        <Pagination :data="passwords.data" commit="SET_PASS_DATA"/>
                    </div>
                </div>
            </div>

            <!-- Empty -->
            <div v-if="!passwords || passwords.data.total === 0">
                <EmptyDefault/>
            </div>
        </div>

    </div>
</template>

<script>
import Pagination from "components/general/Pagination.vue";
import Loading from "components/general/Loading.vue";
import EmptyDefault from "components/general/EmptyDefault.vue";

export default {
    name: 'TablePasswords',
    components: {
        EmptyDefault,
        Loading,
        Pagination
    },
    data() {
        return {}
    },
    mounted() {},
    methods: {
        checkLevel(level) {
            if (level === 3 || level === '3') {
                return {
                    color: 'green',
                    text: 'High'
                }
            } else if (level === 2 || level === '2') {
                return {
                    color: 'amber-7',
                    text: 'Medium'
                }
            } else {
                return {
                    color: 'red',
                    text: 'Low'
                }
            }
        },
        roleGroups(roles) {
            if (roles.length > 0) {
                let list = []
                roles.forEach(role => {
                    list.push(role.name)
                })

                return list;
            } else {
                return [];
            }
        },
        setData(data) {
            this.$store.commit('SET_PASS', data)
            if (this.passwords.password) {
                this.setModal({ key: 'pass_modal', state: true })
            }
        }
    },
}
</script>

<style>
.q-table th, .q-table td {
    padding: 10px 20px;
}
</style>
