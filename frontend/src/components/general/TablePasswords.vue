<template>
    <div>
        <!-- Loader -->
        <Loading v-show="configs.loading" height="300px"/>

        <!-- Content -->
        <div v-show="!configs.loading">

            <!-- Table -->
            <div v-if="passwords && passwords.data.total > 0">
                <q-markup-table class="border-radius-15" flat>
                    <thead>
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-center">Login</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Segurança</th>
                        <th class="text-center">Data de Criação</th>
                        <th v-if="false" class="text-center">Grupos</th>
                        <!-- Actions -->
                        <th v-if="false" class="text-center">Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="cursor-pointer" v-for="item in passwords.data.data" :key="item">
                        <td class="text-left">
                            {{ item.name }}
                        </td>
                        <td class="text-center">
                            {{ item.login }}
                        </td>
                        <td class="text-center">
                            {{ item.description }}
                        </td>
                        <td class="text-center">
                            <q-badge :color="checkLevel(item.pass_level).color" rounded>
                                {{ checkLevel(item.pass_level).text }}
                            </q-badge>
                        </td>
                        <td class="text-center">
                            {{ item.created_date }} às {{ item.created_time }}
                        </td>
                        <td v-if="false" class="text-center">
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
                        <td v-if="false" class="text-center">
                            <div>
                                <div class="row justify-center">
                                    <q-list>
                                        <q-item class="q-pa-none">
                                            <div class="text-grey-8 q-gutter-xs q-pr-none self-center">
                                                <q-btn @click.stop
                                                       v-if="true"
                                                       color="grey-7"
                                                       class=""
                                                       size="12px"
                                                       round
                                                       flat
                                                       icon="edit">
                                                    <q-tooltip>Editar</q-tooltip>
                                                </q-btn>
                                                <q-btn color="grey-7"
                                                       class=""
                                                       size="12px"
                                                       round
                                                       flat
                                                       icon="delete">
                                                    <q-tooltip>Excluir</q-tooltip>
                                                </q-btn>
                                            </div>
                                        </q-item>
                                    </q-list>
                                </div>
                            </div>
                        </td>
                    </tr>
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
    mounted() {
        this.loadResources()
    },
    methods: {
        loadResources() {
            //this.$store.dispatch('setPasswordsData')
        },
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
        }
    },
}
</script>

<style>
.q-table th, .q-table td {
    padding: 10px 20px;
}
</style>
